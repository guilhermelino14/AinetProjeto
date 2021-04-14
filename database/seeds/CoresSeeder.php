<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CoresSeeder extends Seeder
{
    public static $cores = [
        "00a2f2" => "Azul marinho",
        "1e1e21" => "Preto",
        "201f30" => "",
        "284d9d" => "Azul",
        "4bd7ef" => "Azul cyan",
        "73336a" => "Roxo",
        "ac283b" => "Vermelho",
        "bceb97" => "Verde claro",
        "cfdcd8" => "",
        "e7e0ee" => "Branco sujo",
        "f0eff3" => "Cinza clara",
        "f9b014" => "Amarelo torrado",
        "fcabd2" => "Rosa clara",
        "fd4083" => "Rosa",
        "fef7db" => "Amarelo esbatido",
        "10534e" => "Verde escuro",
        "1fba8f" => "Verde",
        "282c48" => "Azul escuro",
        "49302c" => "Castanho",
        "684f2e" => "",
        "7f7277" => "",
        "b5c8eb" => "Azul bebé",
        "c7c6cf" => "Cinza",
        "dc192d" => "Vermelho vivo",
        "ecdb2e" => "Amarelo",
        "f3f46b" => "Amarelo claro",
        "fafafa" => "Branco",
        "fcfbff" => "",
        "fd890f" => "Laranja",
        "ffd2c3" => "Salmão",
    ];

    private $tshirt_basePath = 'public/tshirt_base';

    public function run()
    {
        $this->command->info("Cores e TShirts de base");
        $faker = \Faker\Factory::create('pt_PT');

        $sourceFolder = database_path('seeders/tshirt_base');
        $targetFolder = storage_path('app/' . $this->tshirt_basePath);
        $this->limparFicheirosTShirtBase();
        foreach (CoresSeeder::$cores as $codigo => $nome) {
            $file = $sourceFolder . '/' . $codigo . '.jpg';
            File::copy($file, $targetFolder . '/' . $codigo . '.jpg');
            if (trim($nome) != "") {
                DB::table('cores')->insert([
                    'codigo' => $codigo,
                    'nome' => $nome
                ]);
            }
        }
        $soft_deleted = ["4bd7ef", "f0eff3", "f9b014"];
        foreach ($soft_deleted as $codigo) {
            $deletedAt = $faker->dateTimeBetween('-2 years', '-3 months');
            DB::table('cores')
                ->where('codigo', $codigo)
                ->update(['deleted_at' => $deletedAt]);
        }
        $this->copia_tshirt_base_plain();
    }

    private function limparFicheirosTShirtBase()
    {
        Storage::deleteDirectory($this->tshirt_basePath);
        Storage::makeDirectory($this->tshirt_basePath);
    }

    private function copia_tshirt_base_plain()
    {
        $source = database_path('seeders/tshirt_base') . '/plain_white.png';
        $public_img_path = public_path('img');
        if (!File::isDirectory($public_img_path)) {
            File::makeDirectory($public_img_path);
        }
        File::copy($source, $public_img_path . '/plain_white.png');
        File::copy($source, storage_path('app/' . $this->tshirt_basePath) . '/plain_white.png');
    }
}
