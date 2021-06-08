<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserCreatePostRequest;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = trim($request->get('user')) ?? '';
        $tipo = $request->tipo ?? '';

        $users = User::query();

        if($key != ""){
            $users = $users->where(function($qry) use ($key) {
                    $qry->where('name', 'like', "%$key%")
                        ->orWhere('email', 'like', "%$key%");
                });
        }

        if($tipo != '')
        {
            $users = $users->where('tipo', "$tipo");
        }

        $users = $users->paginate(15);

        return view('back_pages.users', compact(['users', 'tipo', 'key']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('back_pages.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreatePostRequest $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->email = $validated_data['email'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->tipo = $validated_data['tipo'];
        $newUser->bloqueado = $validated_data['bloqueado'];
        $newUser->foto_url = $validated_data['foto_url'];
        $newUser->save();
        return redirect('/admin/users')->with('success','Utilizador criado com sucesso');
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
        $user = User::findOrFail($id);
        return view('back_pages.create', compact('user'));
    }

    public function edit_front()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('front_pages.profile_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, User $user)
    {
        $validated_data = $request->validated();
        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $user->password = Hash::make($validated_data['password']);
        $user->tipo = $validated_data['tipo'] ?? 'C';
        $user->bloqueado = $validated_data['bloqueado'];
        $user->foto_url = $validated_data['foto_url'];
        $user->save();
        $user->cliente->nif = $validated_data['nif'];
        $user->endereco = $validated_data['endereco'];
        $user->tipo_pagamento = $validated_data['tipo_pagamento'];
        $user->ref_pagamento = $validated_data['ref_pagamento'];
        $user->save();
        return redirect('/admin/users')->with('success','Utilizador atualizado com sucesso');
    }

    public function update_front(UserPostRequest $request, User $user)
    {
        $cliente = $user->cliente;
        $validated_data = $request->validated();
        $user->name = $validated_data['name'];
        if($validated_data['endereco'] != null){
            $cliente->endereco = $validated_data['endereco'];
        }
        if($validated_data['nif'] != null){
            $cliente->nif = $validated_data['nif'];
        }

        if(isset($validated_data['img'])){
            Storage::delete('public/fotos/'.$user->foto_url);
            $file = $request->file('img');
            $file_name = $user->id.'_'.time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/fotos',$file_name);
            $user->foto_url = $file_name;

        }
        if($validated_data['password'] != null){
            $user->password = Hash::make($validated_data['password']);
        }
        $user->save();
        if($cliente != null){
            $cliente->save();
        }
        return Redirect()->back()->with('success','Utilizador atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect()->back()->with('success','Utilizador removido com sucesso');
    }

    public function update_state(Request $request){
        $user = User::find($request->id);
        $user->bloqueado = !$user->bloqueado;
        $user->timestamps = false;
        $user->save();
        return Redirect()->back()->with('success','Estado do utilizador atualizado com sucesso');
    }
}
