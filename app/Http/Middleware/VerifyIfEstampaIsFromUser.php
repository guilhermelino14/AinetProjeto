<?php

namespace App\Http\Middleware;

use App\Models\Estampa;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyIfEstampaIsFromUser
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
        $user= Auth::User();
        $id = $request->route()->parameter('id');
        $estampa = Estampa::find($id);
        if($estampa == null){
            $id = $request->route()->parameter('estampa');
            $estampa = Estampa::find($id);
        }
        if($estampa->cliente_id !=null){
            if($user == null || $user->id !=$estampa->cliente_id){
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
