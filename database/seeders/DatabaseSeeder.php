<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("-----------------------------------------------");
        $this->command->info("START of database seeder");
        $this->command->info("-----------------------------------------------");

        DB::statement("SET foreign_key_checks=0");

        DB::table('users')->delete();
        DB::table('clientes')->delete();
        DB::table('estampas')->delete();
        DB::table('cores')->delete();
        DB::table('categorias')->delete();
        DB::table('precos')->delete();
        DB::table('encomendas')->delete();
        DB::table('tshirts')->delete();

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE estampas AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE categorias AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE precos AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE encomendas AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE tshirts AUTO_INCREMENT = 0');

        DB::statement("SET foreign_key_checks=1");


        $this->call(PrecosSeeder::class);
        $this->call(CoresSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(EstampasSeeder::class);
        $this->call(EncomendasSeeder::class);

        $this->command->info("-----------------------------------------------");
        $this->command->info("END of database seeder");
        $this->command->info("-----------------------------------------------");
    }
}
