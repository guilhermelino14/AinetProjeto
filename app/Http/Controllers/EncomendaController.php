<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncomendaCriarPostRequest;
use App\Models\Cliente;
use App\Models\Encomenda;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EncomendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encomendas = Encomenda::paginate(15);
        return view('back_pages.encomendas', compact('encomendas'));
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
        return redirect()->back();
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
        return redirect()->back();
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

        return Redirect()->back();
    }
}
