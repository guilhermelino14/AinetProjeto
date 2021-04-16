<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriasSeeder extends Seeder
{
    // Categorias - usar esta tabela para associar aos seeds das estampas
    public static $categorias = [
        "fun" => "Engraçado",
        "geek" => "Geeks",
        "memes" => "Memes",
        "insp" => "Inspiração",
        "plain" => "Simples",
        "filme" => "Filmes",
        "music" => "Musica",
        "places" => "Locais",
        "logo" => "Logotipos",
        "pub" => "Publicidade e marcas",
        "abst" => "Desenhos Abstratos",
        "drinks" => "Bebidas",
        "nosense" => "Sem Sentido",
        "infantil" => "Infantil",
        "sports" => "Desporto",
        "summer" => "Verão",
        "surf" => "Surf",
        "tattoo" => "Tattoo",
        "vintage" => "Vintage",
        "cool" => "Cool",
        "words" => "Frases"
        //"null" => "Sem categoria definida"
    ];

    public function run()
    {
        $this->command->info("Categorias de estampas");
        foreach (CategoriasSeeder::$categorias as $key => $value) {
            $id = DB::table('categorias')->insertGetId(['nome' => $value]);
            CategoriasSeeder::$categorias[$key] = $id;
        }
    }
}
