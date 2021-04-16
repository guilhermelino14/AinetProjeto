<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrecosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("Configuracação de preços");
        DB::table('precos')->insert([
            "preco_un_catalogo" => 10,
            "preco_un_proprio" => 15,
            "preco_un_catalogo_desconto" => 8.5,
            "preco_un_proprio_desconto" => 12,
            "quantidade_desconto" => 5,
        ]);
    }
}
