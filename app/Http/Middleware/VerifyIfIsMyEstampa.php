<?php

namespace App\Http\Middleware;

use App\Models\Encomenda;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyIfIsMyEstampa
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
        $encomenda = Encomenda::find($request->route()->encomenda);
        $user = Auth::User();
        if($user->tipo == 'A'){
            return $next($request);
        }else{
            if($encomenda->cliente_id == $user->id){
                return $next($request);
            }else{
                return redirect()->route('minhasencomendas');
            }
        }
        
    }
}
