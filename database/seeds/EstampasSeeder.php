<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class EstampasSeeder extends Seeder
{
    private $imagens_estampas_set1 = [
        ["filme", "set1/filme/pngwing11.png", "Lucky one"],
        ["filme", "set1/filme/pngwing13.png", "Bad bones"],
        ["filme", "set1/filme/pngwing19.png", "Route 66"],
        ["filme", "set1/filme/pngwing26.png", "El gato negro"],
        ["filme", "set1/filme/pngwing34.png", "Lords of vengeance"],
        ["filme", "set1/filme/pngwing42.png", "Hulk"],
        ["filme", "set1/filme/pngwing60.png", "The last king"],
        ["filme", "set1/filme/pngwing70.png", "American choppers"],
        ["filme", "set1/filme/pngwing74.png", "Night fever"],
        ["filme", "set1/filme/pngwing87.png", "Bad monkey"],
        ["filme", "set1/filme/pngwing89.png", "Superman"],
        ["filme", "set1/filme/pngwing108.png", "Zombie"],
        ["filme", "set1/filme/pngwing128.png", "Superman"],
        ["filme", "set1/filme/pngwing131.png", "My religion"],
        ["filme", "set1/filme/pngwing136.png", "Death from above"],
        ["filme", "set1/filme/pngwing140.png", "Incredible"],
        ["filme", "set1/filme/pngwing150.png", "Saloon"],
        ["abst", "set1/abst/pngwing9.png", "Cat with flowers"],
        ["abst", "set1/abst/pngwing21.png", "Death"],
        ["abst", "set1/abst/pngwing25.png", "Blue woman"],
        ["abst", "set1/abst/pngwing29.png", "Colour cat"],
        ["abst", "set1/abst/pngwing48.png", "Colours"],
        ["abst", "set1/abst/pngwing66.png", "Man on fire"],
        ["abst", "set1/abst/pngwing73.png", "Heretic"],
        ["abst", "set1/abst/pngwing100.png", "Brown trail"],
        ["abst", "set1/abst/pngwing116.png", "Montains"],
        ["abst", "set1/abst/pngwing117.png", "Rose woman"],
        ["abst", "set1/abst/pngwing138.png", "Skull with one eye"],
        ["abst", "set1/abst/pngwing149.png", "Blue bird"],
        ["abst", "set1/abst/pngwing151.png", "Blue skulls"],
        ["cool", "set1/cool/pngwing4.png", "That is cool"],
        ["cool", "set1/cool/pngwing6.png", "Woman with a rose"],
        ["cool", "set1/cool/pngwing22.png", "Go scoot"],
        ["cool", "set1/cool/pngwing76.png", "Ice skrull scratcher"],
        ["cool", "set1/cool/pngwing78.png", "Home run monkey"],
        ["fun", "set1/fun/pngwing54.png", "Wave I am comming"],
        ["fun", "set1/fun/pngwing55.png", "Funny gesture"],
        ["fun", "set1/fun/pngwing69.png", "Smoking man"],
        ["fun", "set1/fun/pngwing72.png", "Scoot 66"],
        ["fun", "set1/fun/pngwing81.png", "Burn the road"],
        ["fun", "set1/fun/pngwing98.png", "Schedule for murder"],
        ["fun", "set1/fun/pngwing101.png", "Funny tongue"],
        ["fun", "set1/fun/pngwing106.png", "Bone to rock"],
        ["fun", "set1/fun/pngwing113.png", "Throw dice"],
        ["fun", "set1/fun/pngwing114.png", "Funny skate"],
        ["fun", "set1/fun/pngwing115.png", "Stand"],
        ["insp", "set1/insp/pngwing15.png", "Rider"],
        ["insp", "set1/insp/pngwing17.png", "Blue rider"],
        ["insp", "set1/insp/pngwing31.png", "Ride or die"],
        ["insp", "set1/insp/pngwing77.png", "Enjoy the ride"],
        ["insp", "set1/insp/pngwing80.png", "Live fast"],
        ["insp", "set1/insp/pngwing84.png", "Birds in love"],
        ["insp", "set1/insp/pngwing103.png", "Christ"],
        ["insp", "set1/insp/pngwing148.png", "Pink life"],
        ["memes", "set1/memes/pngwing3.png", "I love to ride"],
        ["memes", "set1/memes/pngwing14.png", "Toxic summer"],
        ["memes", "set1/memes/pngwing20.png", "Catch you"],
        ["memes", "set1/memes/pngwing47.png", "Fear this"],
        ["memes", "set1/memes/pngwing83.png", "My gun is much bigger than yours"],
        ["memes", "set1/memes/pngwing130.png", "We can do it"],
        ["memes", "set1/memes/pngwing156.png", "Quiet"],
        ["music", "set1/music/pngwing24.png", "Sounds"],
        ["music", "set1/music/pngwing32.png", "Guitar"],
        ["music", "set1/music/pngwing33.png", "Clefs"],
        ["music", "set1/music/pngwing39.png", "Cool DJ"],
        ["music", "set1/music/pngwing41.png", "Rock and roll"],
        ["music", "set1/music/pngwing50.png", "Music sheet"],
        ["music", "set1/music/pngwing53.png", "Rock Accident"],
        ["music", "set1/music/pngwing59.png", "Flower clef"],
        ["music", "set1/music/pngwing65.png", "Snake guitar"],
        ["music", "set1/music/pngwing68.png", "Rainbow of clefs"],
        ["music", "set1/music/pngwing92.png", "Party sounds"],
        ["music", "set1/music/pngwing96.png", "Touch to play"],
        ["music", "set1/music/pngwing99.png", "Sing with the colours"],
        ["music", "set1/music/pngwing107.png", "Grab the microphone"],
        ["music", "set1/music/pngwing110.png", "Headphones"],
        ["music", "set1/music/pngwing133.png", "Piano and clef "],
        ["music", "set1/music/pngwing139.png", "Music is cool"],
        ["music", "set1/music/pngwing145.png", "It is a boy"],
        ["music", "set1/music/pngwing154.png", "Guitar sounds"],
        ["nosense", "set1/nosense/pngwing10.png", "Lucky dead"],
        ["nosense", "set1/nosense/pngwing16.png", "Hooligan"],
        ["nosense", "set1/nosense/pngwing36.png", "Militar style"],
        ["nosense", "set1/nosense/pngwing43.png", "Guns"],
        ["nosense", "set1/nosense/pngwing45.png", "Anarchy"],
        ["nosense", "set1/nosense/pngwing58.png", "Skull in nature"],
        ["nosense", "set1/nosense/pngwing67.png", "Osiris"],
        ["nosense", "set1/nosense/pngwing75.png", "Catch the skull"],
        ["nosense", "set1/nosense/pngwing79.png", "Nightmare"],
        ["nosense", "set1/nosense/pngwing90.png", "Muerte"],
        ["nosense", "set1/nosense/pngwing95.png", "Heretic"],
        ["nosense", "set1/nosense/pngwing122.png", "La muerte"],
        ["nosense", "set1/nosense/pngwing135.png", "The police"],
        ["null", "set1/null/pngwing1.png", "Woman with pink flowers"],
        ["null", "set1/null/pngwing8.png", "Red dragon"],
        ["null", "set1/null/pngwing18.png", "Hand with crucifix"],
        ["null", "set1/null/pngwing30.png", "Fenix"],
        ["null", "set1/null/pngwing35.png", "Chinese snake"],
        ["null", "set1/null/pngwing38.png", "Eighties"],
        ["null", "set1/null/pngwing40.png", "Family"],
        ["null", "set1/null/pngwing44.png", "Yellow sun"],
        ["null", "set1/null/pngwing49.png", "Love my family"],
        ["null", "set1/null/pngwing52.png", "Boom cloud"],
        ["null", "set1/null/pngwing56.png", "Anchor"],
        ["null", "set1/null/pngwing57.png", "Butterflies"],
        ["null", "set1/null/pngwing61.png", "Burning skull"],
        ["null", "set1/null/pngwing64.png", "Hindu god"],
        ["null", "set1/null/pngwing71.png", "Football"],
        ["null", "set1/null/pngwing88.png", "Astronaut"],
        ["null", "set1/null/pngwing104.png", "Cool cat"],
        ["null", "set1/null/pngwing109.png", "Skull with red roses"],
        ["null", "set1/null/pngwing118.png", "Red car"],
        ["null", "set1/null/pngwing126.png", "Pink moose"],
        ["null", "set1/null/pngwing129.png", "Dark flowers"],
        ["null", "set1/null/pngwing132.png", "Children playing football"],
        ["null", "set1/null/pngwing134.png", "Wolf"],
        ["null", "set1/null/pngwing143.png", "Lion"],
        ["null", "set1/null/pngwing146.png", "Woman in a bike"],
        ["null", "set1/null/pngwing153.png", "The king lion"],
        ["places", "set1/places/pngwing37.png", "Salut Paris"],
        ["places", "set1/places/pngwing62.png", "I love dance in Paris"],
        ["places", "set1/places/pngwing82.png", "Cuba libre"],
        ["places", "set1/places/pngwing86.png", "California"],
        ["places", "set1/places/pngwing94.png", "Purple liberty"],
        ["places", "set1/places/pngwing120.png", "Postcard"],
        ["places", "set1/places/pngwing152.png", "People in Paris"],
        ["plain", "set1/plain/pngwing23.png", "Happy birthday to you"],
        ["plain", "set1/plain/pngwing27.png", "Colour Happy birthday"],
        ["plain", "set1/plain/pngwing28.png", "Red Happy Birthday"],
        ["plain", "set1/plain/pngwing46.png", "I love you"],
        ["plain", "set1/plain/pngwing51.png", "Boom"],
        ["plain", "set1/plain/pngwing63.png", "Happy Halloween"],
        ["plain", "set1/plain/pngwing91.png", "Best Friends"],
        ["plain", "set1/plain/pngwing93.png", "Merry Christmas"],
        ["plain", "set1/plain/pngwing97.png", "Happy Halloween"],
        ["plain", "set1/plain/pngwing111.png", "OMG"],
        ["plain", "set1/plain/pngwing112.png", "Happy New Year"],
        ["plain", "set1/plain/pngwing121.png", "Hello Summer"],
        ["plain", "set1/plain/pngwing123.png", "Happy new year"],
        ["plain", "set1/plain/pngwing127.png", "Happy birthday with balloons"],
        ["plain", "set1/plain/pngwing137.png", "Boom"],
        ["plain", "set1/plain/pngwing144.png", "Funny happy birthday"],
        ["pub", "set1/pub/pngwing2.png", "Freestyler"],
        ["pub", "set1/pub/pngwing5.png", "Vintage classic car"],
        ["pub", "set1/pub/pngwing7.png", "Speedway grade"],
        ["pub", "set1/pub/pngwing12.png", "Vintage motorcycle"],
        ["pub", "set1/pub/pngwing105.png", "Dark shoe"],
        ["pub", "set1/pub/pngwing119.png", "Gazette Sport"],
        ["pub", "set1/pub/pngwing124.png", "Right Rider"],
        ["pub", "set1/pub/pngwing125.png", "Super truck"],
        ["pub", "set1/pub/pngwing141.png", "Car show"],
        ["pub", "set1/pub/pngwing142.png", "Nike"],
        ["pub", "set1/pub/pngwing147.png", "My shoe"],
        ["pub", "set1/pub/pngwing155.png", "River city Tigers"],
    ];

    private $estampasPublicPath = 'public/estampas';
    private $estampasClientesPath = 'estampas_privadas';

    public function run()
    {
        $this->command->info("Estampas do Catálogo");
        $faker = \Faker\Factory::create('pt_PT');
        $this->limparFicheirosEstampas();
        foreach ($this->imagens_estampas_set1 as $info_estampa) {
            $new_estampa = $this->newEstampa($faker, $info_estampa[0], $info_estampa[1], $info_estampa[2]);
            DB::table('estampas')->insert($new_estampa);
        }
        $imagens_estampas_set2 = $this->buildSet2();
        foreach ($imagens_estampas_set2 as $info_estampa) {
            $new_estampa = $this->newEstampa($faker, $info_estampa[0], $info_estampa[1], $info_estampa[2]);
            DB::table('estampas')->insert($new_estampa);
        }

        // A partir daqui, vamos tratar das estampas próprias:
        $this->command->info("Estampas Próprias");

        $IDsClientes = $this->getClientIDsWithProprias();
        $imagens_estampas_proprias = $this->buildSetProprias();
        foreach ($imagens_estampas_proprias as $info_estampa) {
            $idCliente = $faker->randomElement($IDsClientes);
            $new_estampa = $this->newEstampa($faker, $info_estampa[0], $info_estampa[1], $info_estampa[2], $idCliente);
            DB::table('estampas')->insert($new_estampa);
        }

        // A partir daqui, vamos copiar as imagens das estampas e limpar categorias
        $this->command->info("Copiar imagens das estampas");

        $imagens_estampas = DB::table('estampas')->get();
        foreach ($imagens_estampas as $estampa) {
            $this->saveEstampa($estampa->id, $estampa->imagem_url, !$estampa->cliente_id);
        }

        $this->estampasSoftDeleted();
        $this->softDeleteCategoriasNaoUsadas($faker);
    }

    private function newEstampa($faker, $abrCategoria, $file, $nome, $cliente_id = null)
    {
        $createdAt = $faker->dateTimeBetween('-3 years', '-3 months');
        $email_verified_at = $faker->dateTimeBetween($createdAt, '-2 months');
        $updatedAt = $faker->dateTimeBetween($email_verified_at, '-1 months');
        $deletedAt = $faker->dateTimeBetween($updatedAt);
        $abrCategoria = $abrCategoria ?? "null";
        $categoria = $abrCategoria == "null" ? null : CategoriasSeeder::$categorias[$abrCategoria];
        return [
            'cliente_id' => $cliente_id,
            'categoria_id' => $categoria,
            'nome' => $nome,
            'descricao' => $faker->realText(100),
            'imagem_url' => $file,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'deleted_at' => $deletedAt,
        ];
    }

    private function saveEstampa($id, $file, $publico = true)
    {
        $fileName = $publico ? database_path('seeders/estampas_catalogo') : database_path('seeders/estampas_proprias');
        $fileName .= '/' . $file;
        $targetDir = $publico ? storage_path('app/' . $this->estampasPublicPath) : storage_path('app/' . $this->estampasClientesPath);
        $newfilename = $id . "_" . uniqid() . '.png';
        File::copy($fileName, $targetDir . '/' . $newfilename);
        DB::table('estampas')->where('id', $id)->update(['imagem_url' => $newfilename]);
        $this->command->info("Atualizada imagem da estampa $id. Nome do ficheiro copiado = $newfilename");
    }

    private function limparFicheirosEstampas()
    {
        Storage::deleteDirectory($this->estampasPublicPath);
        Storage::makeDirectory($this->estampasPublicPath);
        Storage::deleteDirectory($this->estampasClientesPath);
        Storage::makeDirectory($this->estampasClientesPath);
    }

    private function softDeleteCategoriasNaoUsadas($faker)
    {
        $ids_nao_usados = DB::select("select id from categorias
                                        WHERE NOT EXISTS (select distinct categoria_id from estampas
                                        where estampas.categoria_id = categorias.id)");
        $ids_nao_usados = Arr::pluck($ids_nao_usados, 'id');
        $ids_nao_usados = Arr::shuffle($ids_nao_usados);
        $remove = intdiv(count($ids_nao_usados), 3);
        while ($remove) {
            array_shift($ids_nao_usados);
            $remove--;
        }
        foreach ($ids_nao_usados as $id) {
            $deletedAt = $faker->dateTimeBetween('-2 years', '-3 months');
            DB::table('categorias')
                ->where('id', $id)
                ->update(['deleted_at' => $deletedAt]);
        }
    }

    private function buildSet2()
    {
        $path = database_path('seeders/estampas_catalogo') . '/set2';
        $categories = array_map('basename', File::directories($path));

        $estampas = [];
        foreach ($categories as $category) {
            $path = database_path('seeders/estampas_catalogo') . '/set2/' . $category . '/';
            $files = File::files($path);
            foreach ($files as $file) {
                $estampas[] = [
                    $category,
                    "set2/" . $category . "/" . $file->getFilename(),
                    $this->getNomeFromFilename($file->getFilename())
                ];
            }
        }
        return $estampas;
    }

    private function getNomeFromFilename($filename)
    {
        $strNome = str_replace(".png", "", $filename);
        $strNome = str_replace("_", " ", $strNome);
        $strNome = str_replace("-", " ", $strNome);
        return ucfirst($strNome);
    }

    private function buildSetProprias()
    {
        $path = database_path('seeders/estampas_proprias');
        $estampas = [];
        $files = File::files($path);
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $estampas[] = [
                "null",
                $filename,
                $this->getNomeFromFilename($filename)
            ];
        }
        return $estampas;
    }

    private function getClientIDsWithProprias()
    {
        $arr = DB::table('clientes')->pluck('id')->toArray();
        $arr = Arr::shuffle($arr);
        $total = intdiv(count($arr), 2);
        return array_slice($arr, 0, $total < 50 ? $total : 50);
    }

    private function estampasSoftDeleted()
    {
        $idsToDelete = DB::table('estampas')->pluck('id')->toArray();
        $idsToDelete = Arr::shuffle($idsToDelete);
        $total = intdiv(count($idsToDelete), 10);
        $idsToDelete = array_slice($idsToDelete, 0, $total < 20 ? $total : 20);
        if (count($idsToDelete) > 0) {
            $this->command->info("Soft Delete " . count($idsToDelete) . " estampas na base de dados");
            DB::table('estampas')->whereNotIn('id', $idsToDelete)->update(['deleted_at' => null]);
        }
    }
}
