<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Estampa;
use App\Models\Preco;
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
        $estampas = Estampa::whereNull('cliente_id')->inRandomOrder()->limit(8)->get();
        $preco = Preco::find(1);
        return view('front_pages.index', compact('estampas', 'bebidasLogo', 'coolLogo', 'abstratosLogo', 'desportosLogo', 'engracadasLogo', 'filmesLogo', 'frasesLogo', 'preco'));
    }

    public function contact()
    {
        return view('front_pages.contact');
    }

    public function shopdetails($id)
    {
        $estampa = Estampa::findOrFail($id);
        $preco = Preco::find(1);
        $estampasRelated = Estampa::whereNull('cliente_id')->inRandomOrder()->where('categoria_id', $estampa->categoria_id)->limit(4)->get();
        $cores = Cor::all();
        return view('front_pages.shop-details', compact('estampa', 'estampasRelated', 'preco','cores'));
    }

    public function search(Request $request)
    {
        $key = trim($request->get('estampa'));
        $estampas = Estampa::query()
            ->whereNull('cliente_id')
            ->where('nome', 'like', "%{$key}%")
            ->orWhere('descricao', 'like', "%{$key}%")
            ->paginate(15);
        $estampasCount = Estampa::query()
        ->whereNull('cliente_id')
        ->where('nome', 'like', "%{$key}%")
        ->orWhere('descricao', 'like', "%{$key}%")
        ->count();
        $preco = Preco::find(1);
        $categorias = Categoria::all();
        return view('front_pages.shop-grid', compact('estampas','estampasCount', 'preco', 'categorias'));
    }
}
