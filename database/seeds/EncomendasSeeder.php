<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;


class EncomendasSeeder extends Seeder
{
    private $numberOfDays = 1000;
    private $avgOrdersDay = [10, 5, 7, 9, 12, 6, 20]; // Domingo, Segunda, terça, ...
    private $quantidades = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 4, 4, 5, 6, 7, 8, 9, 10];
    private $num_tshirts = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6,  6,  6, 7, 7, 7, 8, 8, 9, 9, 10, 10, 11];
    private $estados = ['fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'fechada', 'anulada'];
    private $tamanhos = ['XS', 'S', 'S', 'M', 'M', 'M', 'M', 'M', 'L', 'L', 'XL'];
    private $clientes = [];
    private $clientesComEstampasProprias = [];
    private $estampas_catalogo = [];
    private $cores = [];

    public function run()
    {
        $faker = \Faker\Factory::create('pt_PT');
        $this->command->info("Encomendas");
        $this->criarPastaRecibos();
        $this->fillClientes();
        $this->fillEstampas();
        $this->fillCores();
        $today = Carbon::today();
        $this->start_date = $today->copy();
        $this->start_date->subDays($this->numberOfDays);
        $d = $this->start_date->copy();
        $i = 0;
        $precoDelta = 3;
        while ($d->lessThanOrEqualTo($today)) {
            if ($i % 10 == 0) { /// 10 em 10 dias escreve no log e faz o shuffle dos clientes
                $this->command->info("Encomendas para o dia " . $d->format('d-m-Y'));
                $this->shuffleClientes();
            }
            if ($i % 100 == 0) { /// 100 em 100 dias negócio cresce (ou diminui)
                for ($j = 0; $j < count($this->avgOrdersDay); $j++) {
                    $fatorCrescimento = rand(-3, 5);
                    $this->avgOrdersDay[$j] += $this->avgOrdersDay[$j] * $fatorCrescimento / 100;
                }
            }

            if ($i % 300 == 0) { /// 300 em 300 dias preço cresce
                $precoDelta--;
            }

            $totalOrdersDay = intval($this->avgOrdersDay[$d->dayOfWeek] + $this->avgOrdersDay[$d->dayOfWeek] * rand(-100, 50) / 100);
            $totalOrdersDay = $totalOrdersDay < 0 ? 0 : $totalOrdersDay;
            $ordersDay = [];
            for ($num = 0; $num < $totalOrdersDay; $num++) {
                $ordersDay[] = $this->createEncomendaArray($faker, $d);
            }


            DB::table('encomendas')->insert($ordersDay);

            $encomendasDoDia = DB::table('encomendas')->where('data', $d->format('Y-m-d'))->get();

            foreach ($encomendasDoDia as $encomenda) {
                $allTShirts = $this->createTShirtsEncomendas($faker, $encomenda, $precoDelta);
                DB::table('tshirts')->insert($allTShirts);
                //DB::update('update orders set total_price = ? where id = ?', [$total, $id]);
            }
            $i++;
            $d->addDays(1);
        }
        $this->command->info("Atualizar os preços totais das encomendas");
        DB::update('update encomendas set preco_total = (select sum(subtotal) from tshirts where tshirts.encomenda_id = encomendas.id)');

        $this->command->info("Todas as Encomendas foram criadas");
        $this->command->info("---- END ----");


        // // Para verificar possiveis erros de estampas próprias usadas nas encomendas de outros,
        // // Usar o seguinte SQL - se devolver alguma linha, é porque algo está mal:
        // select distinct t.encomenda_id, e.cliente_id, t.estampa_id, e.cliente_id from tshirts as t inner join estampas as e on e.id = t.estampa_id
        // inner join encomendas as enc on enc.id = t.encomenda_id
        // where t.estampa_id in (select id from estampas where cliente_id is not null)
        // AND (e.cliente_id <> e.cliente_id)
    }

    private function fillClientes()
    {
        $this->clientes = DB::table('clientes')->select(DB::raw('id, nif, endereco, tipo_pagamento, ref_pagamento'))->get()->toArray();
        $this->clientesComEstampasProprias = DB::table('estampas')->whereNotNull('cliente_id')->select('cliente_id')->distinct()->pluck('cliente_id', 'cliente_id')->toArray();
        foreach ($this->clientesComEstampasProprias as $cliente_id => $valor) {
            $this->clientesComEstampasProprias[$cliente_id] = [];
        }
    }

    private function fillEstampas()
    {
        $this->estampas_catalogo = DB::table('estampas')->whereNull('cliente_id')->select('id')->pluck('id')->toArray();
        $estampas_cliente = DB::table('estampas')->whereNotNull('cliente_id')->select('cliente_id', 'id')->get()->toArray();
        foreach ($estampas_cliente as $estampa) {
            $this->clientesComEstampasProprias[$estampa->cliente_id][] = $estampa->id;
        }
    }

    private function fillCores()
    {
        $this->cores = DB::table('cores')->select('codigo')->pluck('codigo')->toArray();
    }

    private function shuffleClientes()
    {
        $this->clientes = Arr::shuffle($this->clientes);
    }

    private function createEncomendaArray($faker, $data)
    {
        $cliente = $faker->randomElement($this->clientes);
        $inicio = $data->copy()->addSeconds(rand(39600, 78000));
        $fim = $inicio->copy()->addSeconds(rand(60, 300000));
        return [
            'estado' => $faker->randomElement($this->estados),
            'cliente_id' => $cliente->id,
            'data' => $data->format('Y-m-d'),
            'preco_total' => 0,
            'notas' => rand(0, 20) == 1 ? $faker->realText(100) : null,
            'nif' => $cliente->nif,
            'endereco' => $cliente->endereco,
            'tipo_pagamento' => $cliente->tipo_pagamento,
            'ref_pagamento' => $cliente->ref_pagamento,
            'recibo_url' => null,
            'created_at' => $inicio,
            'updated_at' => $fim,
        ];
    }

    private function createTShirtsEncomendas($faker, $encomenda, $precoDelta = 0)
    {
        $allItems = [];
        $precoDelta = $precoDelta < 0 ? 0 : $precoDelta;
        $totalItems = $faker->randomElement($this->quantidades);
        $cliente_id = $encomenda->cliente_id;
        $temProprio = array_key_exists($cliente_id, $this->clientesComEstampasProprias);
        $estampasProprias = $temProprio ? $this->clientesComEstampasProprias[$cliente_id] : [];
        for ($i = 0; $i < $totalItems; $i++) {
            $usaPropria = $temProprio ? rand(1, 2) == 2 : false;
            $id_estampa = $usaPropria ? $faker->randomElement($estampasProprias) : $faker->randomElement($this->estampas_catalogo);
            $qty = $faker->randomElement($this->num_tshirts);
            $tamanho = $faker->randomElement($this->tamanhos);
            $cor = $faker->randomElement($this->cores);
            $preco_un = $usaPropria ? 15 : 10;
            if ($qty >= 5) {
                $preco_un = $usaPropria ? 12 : 8.5;
            }
            $preco_un -= $precoDelta;
            $subTotal = $qty * $preco_un;
            $allItems[] = [
                'encomenda_id' => $encomenda->id,
                'estampa_id' => $id_estampa,
                'cor_codigo' => $cor,
                'tamanho' => $tamanho,
                'quantidade' => $qty,
                'preco_un' => $preco_un,
                'subtotal' => $subTotal
            ];
        }
        return $allItems;
    }

    private function criarPastaRecibos()
    {
        Storage::deleteDirectory('pdf_recibos');
        Storage::makeDirectory('pdf_recibos');
    }
}
