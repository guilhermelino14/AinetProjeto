<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Preco;
use Illuminate\Http\Request;

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
        $estampas = Estampa::paginate(15);
        $estampasCount = Estampa::count();
        $preco = Preco::find(1);
        return view('front_pages.shop-grid', compact('estampas','estampasCount', 'preco'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $estampas = Estampa::where('categoria_id', $id)->paginate(15); //If user exists
        $estampasCount = Estampa::where('categoria_id', $id)->count();
        $preco = Preco::find(1);
        return view('front_pages.shop-grid', compact('estampas','estampasCount', 'preco'));
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
        $estampa = Estampa::findOrFail($id); //If Estampa exists
        $estampa->delete(); //Remove Estampa

        return Redirect()->back();
    }
}
