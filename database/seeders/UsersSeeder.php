<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    private $photoPath = 'public/fotos';

    private $typesOfUsers =  ['A', 'F', 'C'];
    private $numberOfUsers = [6, 15, 500];
    private $numberOfSoftDeletedUsers = [1, 3, 45];
    private $numberOfBloqueado = [1, 3, 30];
    private $files_M = [];
    private $files_F = [];
    private $used_emails = [];
    private $generos = [];

    public static $allUsers = [];
    public static $allClientes = [];


    public function run()
    {
        $this->command->table(['Users table seeder notice'], [
            ['As fotos serão armazenadas na path ' . storage_path('app/' . $this->photoPath)]
        ]);

        $this->limparFicheirosFotos();
        $this->preencherNomesFicheirosFotos();

        $faker = \Faker\Factory::create('pt_PT');

        $variosUsers = [];
        $totalGuardados = 0;
        $totalParaGuardar = 0;
        foreach ($this->typesOfUsers as $idxTipo => $tipoUser) {
            $totalParaGuardar += $this->numberOfUsers[$idxTipo];
        }
        foreach ($this->typesOfUsers as $idxTipo => $tipoUser) {
            $totalUsers = $this->numberOfUsers[$idxTipo];
            for ($i = 0; $i < $totalUsers; $i++) {
                $newUser = $this->newFakerUser($faker, $tipoUser);
                $variosUsers[] = $newUser;
                if (count($variosUsers) >= 50) {
                    $totalGuardados += count($variosUsers);
                    $this->command->info("Guardados $totalGuardados/$totalParaGuardar users na base de dados");
                    DB::table('users')->insert($variosUsers);
                    $variosUsers = [];
                }
            }
        }
        if (count($variosUsers) > 0) {
            $totalGuardados += count($variosUsers);
            $this->command->info("Guardados $totalGuardados/$totalParaGuardar users na base de dados");
            DB::table('users')->insert($variosUsers);
        }
        UsersSeeder::$allUsers['A'] = DB::table('users')->where('tipo', 'A')->pluck('email', 'id');
        UsersSeeder::$allUsers['F'] = DB::table('users')->where('tipo', 'F')->pluck('email', 'id');
        UsersSeeder::$allUsers['C'] = DB::table('users')->where('tipo', 'C')->pluck('email', 'id');

        $this->fillGenders(UsersSeeder::$allUsers['A']);
        $this->fillGenders(UsersSeeder::$allUsers['F']);
        $this->fillGenders(UsersSeeder::$allUsers['C']);

        shuffle($this->files_M);
        shuffle($this->files_F);

        UsersSeeder::$allUsers['A'] = UsersSeeder::$allUsers['A']->shuffle();
        UsersSeeder::$allUsers['F'] = UsersSeeder::$allUsers['F']->shuffle();
        UsersSeeder::$allUsers['C'] = UsersSeeder::$allUsers['C']->shuffle();

        $this->copiarFotos(UsersSeeder::$allUsers['A']);
        $this->copiarFotos(UsersSeeder::$allUsers['F']);
        $this->copiarFotos(UsersSeeder::$allUsers['C']);

        $idsToBlock = [];
        $idsToDelete = [];
        foreach ($this->typesOfUsers as $idxTipo => $tipoUser) {
            $usersToBlock = $this->numberOfBloqueado[$idxTipo];
            $usersToDelete = $this->numberOfSoftDeletedUsers[$idxTipo];
            foreach (UsersSeeder::$allUsers[$tipoUser] as $user) {
                if ($usersToBlock > 0) {
                    $idsToBlock[] = $user['id'];
                    $usersToBlock--;
                } elseif (($usersToBlock == 0) && ($usersToDelete > 0)) {
                    $idsToDelete[] = $user['id'];
                    $usersToDelete--;
                }
                if (($usersToBlock == 0) && ($usersToDelete == 0)) {
                    continue;
                }
            }
        }

        if (count($idsToBlock) > 0) {
            $this->command->info("Bloquear " . count($idsToBlock) . " users na base de dados");
            DB::table('users')->whereIn('id', $idsToBlock)->update(['bloqueado' => 1]);
        }
        if (count($idsToDelete) > 0) {
            $this->command->info("Soft Delete " . count($idsToDelete) . " users na base de dados");
            DB::table('users')->whereNotIn('id', $idsToDelete)->update(['deleted_at' => null]);
        }


        UsersSeeder::$allClientes = DB::table('users')->where('tipo', 'C')->pluck('id');

        $totalGuardados = 0;
        $totalParaGuardar = UsersSeeder::$allClientes->count();
        $array_clientes = [];
        foreach (UsersSeeder::$allClientes as $id_cliente) {
            $array_clientes[] = $this->newFakerCliente($faker, $id_cliente);
            if (count($array_clientes) >= 50) {
                $totalGuardados += count($array_clientes);
                $this->command->info("Guardados $totalGuardados/$totalParaGuardar clientes na base de dados");
                DB::table('clientes')->insert($array_clientes);
                $array_clientes = [];
            }
        }
        if (count($array_clientes) > 0) {
            $totalGuardados += count($array_clientes);
            $this->command->info("Guardados $totalGuardados/$totalParaGuardar clientes na base de dados");
            DB::table('users')->insert($array_clientes);
        }

        $this->command->info("Atualizar timestamps dos clientes");
        DB::update("update clientes as c inner join (
                        select id, created_at, updated_at, deleted_at
                        from users
                        ) as u on c.id = u.id
                    set c.created_at = u.created_at, c.updated_at = u.updated_at, c.deleted_at = u.deleted_at");

        $this->command->info("Atualizar referencias de pagamento do Paypal");
        DB::update("update clientes as c
                    inner join (
                        select id, email
                        from users
                        ) as u on c.id = u.id
                    set c.ref_pagamento = u.email
                    where c.tipo_pagamento = 'PAYPAL'");
    }

    private function fillGenders($users_array)
    {
        foreach ($users_array as $key => $value) {
            $users_array[$key] = [
                "id" => $key,
                "email" => $value,
                "genero" => $this->generos[$value]
            ];
        }
    }

    private function limparFicheirosFotos()
    {
        Storage::deleteDirectory($this->photoPath);
        Storage::makeDirectory($this->photoPath);
    }

    private function preencherNomesFicheirosFotos()
    {
        // LARAVEL 7:
        // $allFiles = collect(File::files(database_path('seeds/fotos')));
        // LARAVEL 8:
        $allFiles = collect(File::files(database_path('seeders/fotos')));
        foreach ($allFiles as $f) {
            if (strpos($f->getPathname(), 'M_')) {
                $this->files_M[] = $f->getPathname();
            } else {
                $this->files_F[] = $f->getPathname();
            }
        }
    }

    private function copiarFotos($arrayUsers)
    {
        foreach ($arrayUsers as $user) {
            if ((count($this->files_M) == 0) && (count($this->files_F) == 0)) {
                break;
            }
            $file = $user['genero'] == 'M' ? array_shift($this->files_M) : array_shift($this->files_F);
            if ($file) {
                $this->savePhotoOfUser($user['id'], $file);
            }
        }
    }

    private function savePhotoOfUser($id, $file)
    {
        $targetDir = storage_path('app/' . $this->photoPath);
        $newfilename = $id . "_" . uniqid() . '.jpg';
        File::copy($file, $targetDir . '/' . $newfilename);
        DB::table('users')->where('id', $id)->update(['foto_url' => $newfilename]);
        $this->command->info("Atualizada foto do user $id. Nome do ficheiro copiado = $newfilename");
    }

    private function stripAccents($stripAccents)
    {
        $from = 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ';
        $to =   'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($stripAccents, $mapping);
    }

    private function strtr_utf8($str, $from, $to)
    {
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($str, $mapping);
    }
    private function randomName($faker, &$gender, &$fullname, &$email)
    {
        $gender = $faker->randomElement(['male', 'female']);
        $firstname = $faker->firstName($gender);
        $lastname = $faker->lastName();
        $secondname = $faker->numberBetween(1, 3) == 2 ? "" : " " . $faker->firstName($gender);
        $number_middlenames = $faker->numberBetween(1, 6);
        $number_middlenames = $number_middlenames == 1 ? 0 : ($number_middlenames >= 5 ? $number_middlenames - 3 : 1);
        $middlenames = "";
        for ($i = 0; $i < $number_middlenames; $i++) {
            $middlenames .= " " . $faker->lastName();
        }
        $fullname = $firstname . $secondname . $middlenames . " " . $lastname;
        $email = strtolower($this->stripAccents($firstname) . "." . $this->stripAccents($lastname) . "@mail.pt");
        $i = 2;
        while (in_array($email, $this->used_emails)) {
            $email = strtolower($this->stripAccents($firstname) . "." . $this->stripAccents($lastname) . "." . $i . "@mail.pt");
            $i++;
        }
        $this->used_emails[] = $email;
        $gender = $gender == 'male' ? 'M' : 'F';
    }

    private function newFakerUser($faker, $tipo)
    {
        $fullname = "";
        $email = "";
        $gender = "";
        $this->randomName($faker, $gender, $fullname, $email);
        $createdAt = $faker->dateTimeBetween('-10 years', '-3 months');
        $email_verified_at = $faker->dateTimeBetween($createdAt, '-2 months');
        $updatedAt = $faker->dateTimeBetween($email_verified_at, '-1 months');
        $deletedAt = $faker->dateTimeBetween($updatedAt);
        $this->generos[$email] = $gender;
        return [
            'name' => $fullname,
            'email' => $email,
            'email_verified_at' => $email_verified_at,
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'tipo' => $tipo,
            'bloqueado' => 0,
            'deleted_at' => $deletedAt,
        ];
    }


    private function newFakerCliente($faker, $id)
    {
        return [
            'id' => $id,
            'nif' => $faker->randomNumber($nbDigits = 9, $strict = true),
            'endereco' => $faker->address,
            'tipo_pagamento' => $faker->randomElement(['VISA', 'MC', 'PAYPAL']),
            'ref_pagamento' => $faker->randomNumber($nbDigits = 8, $strict = true) . $faker->randomNumber($nbDigits = 8, $strict = true),
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null
        ];
    }
}
