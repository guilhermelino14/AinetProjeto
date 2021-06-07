<?php

namespace App\Http\Controllers;

use App\Http\Requests\criarEstampaPostRequest;
use App\Models\Categoria;
use App\Models\Estampa;
use App\Models\Preco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EstampasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estampas = Estampa::paginate(15);
        return view('back_pages.estampas', compact('estampas'));
    }
    public function index_front()
    {
        $estampas = Estampa::whereNull('cliente_id')->paginate(15);
        $estampasCount = Estampa::whereNull('cliente_id')->count();
        $preco = Preco::find(1);
        $categorias = Categoria::all();
        return view('front_pages.shop-grid', compact('estampas','estampasCount', 'preco', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::get();
        return view('front_pages.criarEstampa', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(criarEstampaPostRequest $request, Estampa $estampa)
    {
        $validated_data = $request->validated();
        if(!isset($validated_data['imagem_url'])){
            return redirect()->back();
        }
        $user = Auth::user();
        $estampa->cliente_id = $user->id;
        $estampa->categoria_id = (int)$validated_data['categoria'];
        $estampa->nome = $validated_data['nome'];
        $estampa->descricao = $validated_data['descricao'];
        $file = $request->file('imagem_url');
        $file_name = $user->id.'_'.time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('estampas_privadas',$file_name);
        $estampa->imagem_url = $file_name;
        $estampa->save();
        return Redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function show_front($id){
        $estampas = Estampa::where('categoria_id', $id)->whereNull('cliente_id')->paginate(15); //If user exists
        $estampasCount = Estampa::where('categoria_id', $id)->whereNull('cliente_id')->count();
        $preco = Preco::find(1);
        $categorias = Categoria::all();
        return view('front_pages.shop-grid', compact('estampas','estampasCount', 'preco', 'categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estampa = Estampa::findOrFail($id);
        return view('back_pages.estampas_edit', compact('estampa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estampa $estampa)
    {
        $validated_data = $request->validated();
        $user = Auth::user();
        $estampa->categoria_id = (int)$validated_data['categoria'];
        $estampa->nome = $validated_data['nome'];
        $estampa->descricao = $validated_data['descricao'];
        $file = $request->file('imagem_url');
        $file_name = $user->id.'_'.time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('estampas_privadas',$file_name);
        $estampa->imagem_url = $file_name;
        $estampa->informacao_extra = $validated_data['informacao_extra'];
        $estampa->save();
        return Redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estampa = Estampa::findOrFail($id); //If Estampa exists
        $estampa->delete(); //Remove Estampa

        return Redirect()->back();
    }

    public function minhasEstampas(){
        $user = Auth::user();
        $estampas = Estampa::where("cliente_id", $user->id)->paginate(15);
        return view('front_pages.minhasEstampas', compact('estampas'));
    }
}
