<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;

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
        return view('back_pages.encomenda_create', compact('encomenda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validated();
        $newEncomenda = new Encomenda();
        $newEncomenda->estado = "pendente";
        $newEncomenda->cliente->client_id = $validated_data['client_id'];
        $newEncomenda->preco_total = $validated_data['preco_total'];
        $newEncomenda->notas = $validated_data['notas'];
        $newEncomenda->nif = $newEncomenda->cliente->nif;
        $newEncomenda->endereco = $newEncomenda->cliente->endereco;
        $newEncomenda->tipo_pagamento = $newEncomenda->cliente->tipo_pagamento;
        $newEncomenda->save();
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
        return view('back_pages.encomenda_show', compact('encomenda'));
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
        return view('back_pages.encomenda_create', compact('encomenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
