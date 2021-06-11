<?php

namespace App\Http\Controllers;

use App\Mail\MailEncomenda;
use App\Mail\MailRegisto;
use App\Models\Estampa;
use App\Models\Cart;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Tshirt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request){
        if(!Session::has('cart')){
            return view('front_pages.shoping-cart', ['items' =>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('front_pages.shoping-cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice()]);
    }

    public function checkout(Request $request){
        if(!Session::has('cart')){
            return view('front_pages.checkout', ['items' =>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('front_pages.checkout', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice()]);
    }

    public function addToCart(Request $request, $id){
        if($request->qty == null){
            $request->qty = 1;
        }
        $estampa = Estampa::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        
        $cart->add($estampa, $estampa->id, $request->qty,$request->tamanho,$request->cor);
        $request->session()->put('cart',$cart);
        
        return redirect()->back();
    }

    public function removeFromCart(Request $request, $index){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($index);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function editItemFromCart(Request $request, $index, $operator){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->editQuantity($index,$operator);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function checkoutCart(Request $request){

        //verificar se user é logado ou nao
        $user = Auth::User();
        $oldCart = Session::get('cart');
        $preco_total = Session::get('cart')->totalPrice();

        if($user == null){
            if($request->name == null || $request->email == null || $request->endereco1 == null || $request->endereco2 == null || $request->endereco3 == null || $request->nif == null || $request->ref_pagamento == null || $request->password == null ){
                return redirect()->back()->with('error', 'Tem de preencher todos os campos');
            }else{
                // criar o user / Cliente
                $newUser = new User();
                $newCliente = new Cliente();
                $newUser->name = $request->name;
                $newUser->email = $request->email;
                $newUser->password = Hash::make($request->password);
                $newUser->tipo = 'C';
                $newUser->bloqueado = 0;
                $newUser->save();
                $newCliente->id = $newUser->id;
                $newCliente->nif = $request->nif;
                $newCliente->endereco = $request->endereco1.", ". $request->endereco2.", ".$request->endereco3;
                $newCliente->ref_pagamento = $request->ref_pagamento;
                $newCliente->tipo_pagamento = $request->tipo_pagamento;
                
                $newCliente->save();
                $user = $newUser;
                Auth::login($user);
                Mail::to($user->email)->send(new MailRegisto($user));
            }
        }
        //gerar Econmenda
        $encomenda = new Encomenda();
        $encomenda->estado = "pendente";
        $encomenda->cliente_id = $user->id;
        $encomenda->data = Carbon::now()->toDateTimeString();
        $encomenda->preco_total = $preco_total;
        $encomenda->nif = $user->cliente->nif;
        $encomenda->endereco = $user->cliente->endereco;
        $encomenda->tipo_pagamento = $user->cliente->tipo_pagamento;
        $encomenda->ref_pagamento = $user->cliente->ref_pagamento;
        $encomenda->save();
        
        
        

        
        // Gerar TSHIRTS
         foreach($oldCart->items as $item){
            $tshirt = new Tshirt();
            $tshirt->encomenda_id = $encomenda->id;
            $tshirt->estampa_id = $item['id'];
            $tshirt->cor_codigo = $item['cor'];
            $tshirt->tamanho = $item['tamanho'];
            $tshirt->quantidade = $item['qty'];
            $tshirt->preco_un = $item['price'] / $item['qty'];
            $tshirt->subtotal = $item['price'];
            $tshirt->timestamps = false;
            $tshirt->save();
        }
        

        // Gerar PDF
        
        //apagar sessao
        Session::forget('cart');
        Mail::to($user->email)->send(new MailEncomenda($encomenda));
        
        return redirect()->route('minhasencomendas');
    }
}
