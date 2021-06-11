<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEstampasPrivadasEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $estampa = $request->route()->estampa;
        $user= Auth::User();
        if($user->id != $estampa->cliente_id){
            return redirect()->route('minhasEstampas')->with('error', 'Nao pode aceder a essa estampa');
        }else{
            return $next($request);
        }
        
    }
}
