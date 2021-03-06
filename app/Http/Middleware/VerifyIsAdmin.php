<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyIsAdmin
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
        $user = Auth::user();
        if($user != null){
            if($user->tipo == 'A' || $user->tipo == 'F'){
                return $next($request);
            }else{
                return redirect()->route('homeT');
            }
        }else{
            return redirect()->route('homeT')->with('error', 'Nao tem permissao para aceder a essa pagina');
        }
        
    }
}
