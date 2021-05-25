<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
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
    public function index()
    {
        $users = User::paginate(15);
        return view('back_pages.users', compact('users'));
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
    public function store(Request $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->email = $validated_data['email'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->tipo = $validated_data['tipo'] ?? 'C';
        $newUser->bloqueado = 0;
        $newUser->foto_url = $validated_data['foto_url'];
        $newUser->save();
        $cliente = new Cliente;
        $cliente->user_id = $newUser->id;
        $cliente->nif = $validated_data['nif'];
        $cliente->endereco = $validated_data['endereco'];
        $cliente->tipo_pagamento = $validated_data['tipo_pagamento'];
        $cliente->ref_pagamento = $validated_data['ref_pagamento'];
        $cliente->save();
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
    public function update(Request $request, User $user)
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
    }

    public function update_front(UserPostRequest $request, User $user)
    {
        $cliente = $user->cliente;
        $validated_data = $request->validated();
        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $cliente->endereco = $validated_data['endereco'];
        $cliente->nif = $validated_data['nif'];
        if(isset($validated_data['img'])){
            Storage::delete('public/fotos/'.$user->foto_url);
            $path = $request->file('img')->store('public/fotos');
            $name = explode("/", $path);
            $user->foto_url = $name[2];
        }
        if($validated_data['password'] != null){
            $user->password = Hash::make($validated_data['password']);
        }
        $user->save();
        $cliente->save();
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
        $user = User::findOrFail($id); //If user exists
        $user->delete(); //Remove user

        return Redirect()->back(); //Redirect page to /admin/users
    }
}
