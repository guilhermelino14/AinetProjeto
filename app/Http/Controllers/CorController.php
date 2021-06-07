<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;

class CorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cores = Cor::paginate(15);
        return view('back_pages.cores', compact('cores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back_pages.cores_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->codigo != null && $request->nome != null){
            $newCor = new Cor;
            $newCor->codigo = $request->codigo;
            $newCor->nome = $request->nome;
            $newCor->timestamps = false;
            $newCor->save();
            return redirect('/admin/cores');
        }
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
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($codigo)
    {
        $cor = Cor::findOrFail($codigo);
        return view('back_pages.cores_edit', compact('cor'));
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
        $cor = Cor::find($id);
        if($request->nome != null){
            $cor->nome = $request->nome;
            $cor->timestamps = false;
            $cor->save(); 
        }
        return redirect('/admin/cores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cor = Cor::findOrFail($id); //If Encomenda exists
        $cor->timestamps = false;
        $cor->delete(); //Remove Encomenda

        return Redirect()->back();
    }
}
