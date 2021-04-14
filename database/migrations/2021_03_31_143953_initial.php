<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cliente, Funcionario ou Administrador
            $table->enum('tipo', ['C', 'F', 'A']);

            // Acesso do utilizador bloqueado
            $table->boolean('bloqueado')->default(false);

            // Fotografia/Avatar do utilizador
            $table->string('foto_url')->nullable();

            // Utilizadores podem ser apagados com "soft deletes"
            $table->softDeletes();
        });

        Schema::create('clientes', function (Blueprint $table) {
            // Chave primário dos clientes é a mesma que a chave primária dos users
            // (Clientes é uma subclasse de Users)
            $table->bigInteger('id')->unsigned()->primary();
            $table->foreign('id')->references('id')->on('users');

            $table->string('nif', 9)->nullable();
            $table->text('endereco')->nullable();

            // VISA - Visa
            // MC - Master Card
            // PAYPAL - Paypal
            $table->enum('tipo_pagamento', ['VISA', 'MC', 'PAYPAL'])->nullable();
            // Referência de pagamento varia consoante o tipo de pagamento
            // VISA e MC -> Nº de cartão com 16 digitos
            // PAYPAL -> email
            $table->string('ref_pagamento')->nullable();

            $table->timestamps();
            // Clientes podem ser apagados com "soft deletes"
            $table->softDeletes();
        });

        // configuração precos - só deverá ter uma linha que corresponde à configuração atual
        Schema::create('precos', function (Blueprint $table) {
            $table->id();
            $table->decimal('preco_un_catalogo', 8, 2);
            $table->decimal('preco_un_proprio', 8, 2);
            $table->decimal('preco_un_catalogo_desconto', 8, 2);
            $table->decimal('preco_un_proprio_desconto', 8, 2);
            // Quantidade a partir da qual irá ser aplicado o desconto (inclusive)
            $table->integer('quantidade_desconto');
        });

        // categorias das estampas - para organizar as estampas dentro do catálogo
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            // Categorias de Estampas podem ser apagados com "soft deletes"
            $table->softDeletes();
        });

        // cores das t-shirts
        Schema::create('cores', function (Blueprint $table) {
            // Código da cor corresponde a um código de cor em CSS
            $table->string('codigo', 50)->primary();
            $table->string('nome');

            // Cores das tshirts podem ser apagados com "soft deletes"
            $table->softDeletes();
        });

        Schema::create('estampas', function (Blueprint $table) {
            $table->id();
            // Se cliente_id = null, então estampa faz parte do catálogo da loja
            // caso contrário, é uma estampa própria do cliente - para usar exclusivamente nas suas t-shirts
            $table->bigInteger('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            // A estampa pode ou não pertencer a uma categoria.
            // Só as estampas do catálogo da loja têm uma categoria
            // Se é uma estampa própria de um cliente, então não tem categoria
            $table->bigInteger('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('imagem_url');
            $table->json('informacao_extra')->nullable();
            $table->timestamps();
            // Estampas podem ser apagados com "soft deletes"
            $table->softDeletes();
        });


        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['pendente', 'paga', 'fechada', 'anulada']);
            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->date('data');
            $table->decimal('preco_total', 8, 2);
            $table->text('notas')->nullable();

            $table->string('nif', 9);
            $table->text('endereco');
            // VISA - Visa
            // MC - Master Card
            // PAYPAL - Paypal
            $table->enum('tipo_pagamento', ['VISA', 'MC', 'PAYPAL']);
            // Referência de pagamento varia consoante o tipo de pagamento
            // VISA e MC -> Nº de cartão com 16 digitos
            // PAYPAL -> email
            $table->string('ref_pagamento');

            $table->string('recibo_url')->nullable();

            $table->timestamps();
        });

        Schema::create('tshirts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('encomenda_id')->unsigned();
            $table->foreign('encomenda_id')->references('id')->on('encomendas');
            $table->bigInteger('estampa_id')->unsigned();
            $table->foreign('estampa_id')->references('id')->on('estampas');
            $table->string('cor_codigo', 50);
            $table->foreign('cor_codigo')->references('codigo')->on('cores');
            $table->enum('tamanho', ['XS', 'S', 'M', 'L', 'XL']);
            $table->integer('quantidade');
            $table->decimal('preco_un', 8, 2);
            $table->decimal('subtotal', 8, 2);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
