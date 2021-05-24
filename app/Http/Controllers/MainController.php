<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    public function index()
    {
        $bebidasLogo = Estampa::where('id', 157)->pluck('imagem_url')->first();
        $coolLogo = Estampa::where('id', 35)->pluck('imagem_url')->first();
        $abstratosLogo = Estampa::where('id', 22)->pluck('imagem_url')->first();
        $desportosLogo = Estampa::where('id', 205)->pluck('imagem_url')->first();
        $engracadasLogo = Estampa::where('id', 36)->pluck('imagem_url')->first();
        $filmesLogo = Estampa::where('id', 11)->pluck('imagem_url')->first();
        $frasesLogo = Estampa::where('id', 254)->pluck('imagem_url')->first();
        return view('front_pages.index', compact('bebidasLogo', 'coolLogo', 'abstratosLogo', 'desportosLogo', 'engracadasLogo', 'filmesLogo', 'frasesLogo'));
    }

    public function checkout()
    {
        return view('front_pages.checkout');
    }

    public function contact()
    {
        return view('front_pages.contact');
    }

    public function shopdetails()
    {
        return view('front_pages.shop-details');
    }

    public function shoppingcart()
    {
        return view('front_pages.shoping-cart');
    }

    public function search(Request $request)
    {
        $key = trim($request->get('estampa'));
        $estampas = Estampa::query()
            ->where('nome', 'like', "%{$key}%")
            ->orWhere('descricao', 'like', "%{$key}%")
            ->paginate(15);
        $estampasCount = Estampa::query()
        ->where('nome', 'like', "%{$key}%")
        ->orWhere('descricao', 'like', "%{$key}%")
        ->count();
        return view('front_pages.shop-grid', compact('estampas','estampasCount'));
    }
}
