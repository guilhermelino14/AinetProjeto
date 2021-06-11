@extends('front_layouts.template')

@section('content')

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">

                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Minha Encomenda</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6 ">
                                    <div>
                                        <span class="font-weight-bold mb-3">Numero da Encomenda:</span>
                                        <p class="font-weight-normal">{{$encomenda->id}}</p>
                                    </div>
    
                                    <div>
                                        <span class="font-weight-bold mb-3">Estado da Encomenda:</span>
                                        <p class="font-weight-normal">{{$encomenda->estado}}</p>
                                    </div>
    
                                    <div>
                                        <span class="font-weight-bold mb-3">Data da Encomenda:</span>
                                        <p class="font-weight-normal">{{$encomenda->data}}</p>
                                    </div>
    
                                    <div>
                                        <span class="font-weight-bold mb-3">Preço Total da Encomenda:</span>
                                        <p class="font-weight-normal">{{$encomenda->preco_total}}€</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 ">
                                    <div>
                                        <span class="font-weight-bold mb-3">NIF de Faturação:</span>
                                        <p class="font-weight-normal">{{$encomenda->nif}}</p>
                                    </div>
    
                                    <div>
                                        <span class="font-weight-bold mb-3">Endereço de Faturação:</span>
                                        <p class="font-weight-normal">{{$encomenda->endereco}}</p>
                                    </div>
    
                                    <div>
                                        <span class="font-weight-bold mb-3">Metodo de Pagamento:</span>
                                        <p class="font-weight-normal">{{$encomenda->tipo_pagamento}}</p>
                                    </div>
    
                                    <div>
                                        <span class="font-weight-bold mb-3">Referencia de Pagamento:</span>
                                        <p class="font-weight-normal">{{$encomenda->ref_pagamento}}</p>
                                    </div>
                                    @if ($encomenda->estado == "fechada")
                                    <div>
                                        <span class="font-weight-bold mb-3">Recibo:</span>
                                        <p class="font-weight-normal"><a href="{{ route("minhasencomendas.show.pdf", $encomenda) }}">Clique aqui</a></p>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <span class="font-weight-bold mb-3">Encomenda:</span>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nome Da Estampa</th>
                                                <th>Cor</th>
                                                <th>Tamanho</th>
                                                <th>Quantidade</th>
                                                <th>Preço por Unidade</th>
                                                <th>Preço Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($tshirts as $tshirt)
                                                @php($estampa = App\Models\Estampa::where('id', $tshirt->estampa_id)->first())
                                                @php($cor = App\Models\Cor::where('codigo', $tshirt->cor_codigo)->first())
                                                <tr>
                                                    <td>@if ($estampa != null)
                                                        <img @if ($estampa->cliente_id == null)
                                                        src="{{ asset("storage/estampas/".$estampa->imagem_url) }}"
                                                        @else
                                                        src="{{ route("estampas.privadas", $estampa->imagem_url) }}"
                                                        @endif alt="" width="100px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($estampa != null)
                                                        {{$estampa->nome}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($cor != null)
                                                            {{$cor->nome}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$tshirt->tamanho}}                                                        
                                                    </td>
                                                    <td>
                                                        {{$tshirt->quantidade}}     
                                                    </td>
                                                    <td>
                                                        {{$tshirt->preco_un}}€
                                                    </td>
                                                    <td>
                                                        {{$tshirt->subtotal}}€  
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->




@endsection
