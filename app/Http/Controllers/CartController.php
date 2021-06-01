<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $cart->add($estampa, $estampa->id, $request->qty);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function removeFromCart(Request $request, $id){
        $estampa = Estampa::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($estampa, $estampa->id);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function editItemFromCart(Request $request, $id, $operator){
        $estampa = Estampa::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->editQuantity($estampa, $estampa->id, $operator);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
}
