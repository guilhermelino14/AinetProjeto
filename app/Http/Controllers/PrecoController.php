<?php

namespace App\Http\Controllers;

use App\Models\Preco;
use Illuminate\Http\Request;

class PrecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precos = Preco::paginate(15);
        return view('back_pages.preco',compact('precos'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preco = Preco::findOrFail(1);
        return view('back_pages.preco_edit', compact('preco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preco $preco)
    {
        if($request->preco_un_catalogo != null){
            $preco->preco_un_catalogo = $request->preco_un_catalogo;
        }
        if($request->preco_un_proprio != null){
            $preco->preco_un_proprio = $request->preco_un_proprio;
        }
        if($request->preco_un_catalogo_desconto != null){
            $preco->preco_un_catalogo_desconto = $request->preco_un_catalogo_desconto;
        }
        if($request->preco_un_proprio_desconto != null){
            $preco->preco_un_proprio_desconto = $request->preco_un_proprio_desconto;
        }
        if($request->quantidade_desconto != null){
            $preco->quantidade_desconto = $request->quantidade_desconto;
        }
        $preco->timestamps = false;
        $preco->save();
        return redirect('/admin/precos'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
