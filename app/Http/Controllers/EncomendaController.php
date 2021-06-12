<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaCriarPostRequest;
use App\Mail\MailEncomendaFechada;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Tshirt;
use App\Models\User;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Facades\DB;

class EncomendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipo = $request->tipo ?? '';
        $data = $request->data ?? '';
        
        $user = Auth::User();
        if($user->tipo == 'F'){
            if($tipo == "pendente" || $tipo == "paga"){
                $encomendas = Encomenda::where('estado',$tipo)->paginate(15);
            }else{
                $encomendas = Encomenda::where('estado','pendente')->orwhere('estado','paga')->paginate(15);
            }
            
        }elseif($user->tipo == 'A'){
            if($tipo != "*" && $data != ''){
                $encomendas = Encomenda::where('estado',$tipo)->where(DB::raw("DATE_FORMAT(created_at,'%Y')"), $data)->paginate(15);
                
            }else{
                if($data == ''){
                    $encomendas = Encomenda::paginate(15);
                }else{
                    $encomendas = Encomenda::where(DB::raw("DATE_FORMAT(created_at,'%Y')"), $data)->paginate(15);
                }
            }
        }
        
        return view('back_pages.encomendas', compact('encomendas', 'tipo', 'data'));
    }
    public function index_front()
    {
        $user = Auth::user();
        $encomendas = Encomenda::where('cliente_id', $user->id)->paginate(15);
        return view('front_pages.minhasEncomendas', compact('encomendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encomenda = new Encomenda();
        return view('back_pages.encomendas_create', compact('encomenda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncomendaCriarPostRequest $request)
    {
        $validated_data = $request->validated();
        $cliente = Cliente::find($validated_data['numero']);
        if($cliente == null){
            return redirect()->back();
        }
        $newEncomenda = new Encomenda;
        $newEncomenda->estado = "pendente";
        $newEncomenda->cliente_id = $validated_data['numero'];
        $newEncomenda->preco_total = $validated_data['preco'];
        if($validated_data['notas'] != null){
            $newEncomenda->notas = $validated_data['notas'];
        }
        $newEncomenda->data = Carbon::now()->toDateTimeString();
        $newEncomenda->nif = $cliente->nif;
        $newEncomenda->endereco = $cliente->endereco;
        $newEncomenda->tipo_pagamento = $cliente->tipo_pagamento;
        $newEncomenda->ref_pagamento = $cliente->ref_pagamento;
        $newEncomenda->save();
        return redirect()->back()->with('success','Encomenda criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encomenda = Encomenda::findOrFail($id);
        return view('back_pages.encomendas_show', compact('encomenda'));
    }
    public function show_front($id)
    {
        $encomenda = Encomenda::findOrFail($id);
        $tshirts = Tshirt::where('encomenda_id', $id)->get();
        return view('front_pages.minhasEncomendasDetalhes', compact('encomenda','tshirts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $encomenda = Encomenda::findOrFail($id);
        return view('back_pages.encomendas_edit', compact('encomenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encomenda $encomenda)
    {
        if ($request->estado != null){
            $encomenda->estado = $request->estado;
        }
        if ($request->valor != null){
            $encomenda->preco_total = $request->valor;
        }
        if ($request->notas != null){
            $encomenda->notas = $request->notas;
        }
        if ($request->endereco != null){
            $encomenda->endereco = $request->endereco;
        }
        if ($request->tipo != null){
            $encomenda->tipo_pagamento = $request->tipo;
        }
        if ($request->ref != null){
            $encomenda->ref_pagamento = $request->ref;
        }
        $encomenda->save();
        return redirect()->back()->with('success','Encomenda alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encomenda = Encomenda::findOrFail($id); //If Encomenda exists
        $encomenda->delete(); //Remove Encomenda

        return Redirect()->back()->with('success','Encomenda removida com sucesso');
    }

    public function show_front_pdf($id)
    {
        $encomenda = Encomenda::findOrFail($id);
        $tshirts = Tshirt::where('encomenda_id', $id)->get();
        $pdf = PDF::loadView('pdf.minhasEncomendasDetalhes', compact('encomenda','tshirts'));
        return $pdf->download("teste.pdf");
        //return response()->file(storage_path().'/app/pdf_recibos/'.$encomenda->recibo_url);
    }

    public function changeEncomendaEstado($encomenda,$estado)
    {
        $encomenda = Encomenda::find($encomenda);
        switch ($estado) {
            case 1:
                $encomenda->estado = "paga";
                $encomenda->save();
                break;
            case 2:
                $encomenda->estado = "fechada";
                $tshirts = Tshirt::where('encomenda_id', $encomenda->id)->get();
                $pdf = PDF::loadView('pdf.minhasEncomendasDetalhes', compact('encomenda','tshirts'));
                $content = $pdf->download()->getOriginalContent();
                Storage::put('pdf_recibos/'.$encomenda->id.'.pdf',$content) ;
                $encomenda->recibo_url = $encomenda->id.'.pdf';
                $encomenda->save();
                $user = User::find($encomenda->cliente_id);
                Mail::to($user->email)->send(new MailEncomendaFechada($encomenda));
                break;

            case 3:
                $encomenda->estado = "anulada";
                $encomenda->save();
                break;
        }
        return redirect()->back()->with('success', 'Estado da encomenda alterado com sucesso');
    }
}
