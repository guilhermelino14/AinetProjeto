
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Encomenda Numero: {{$encomenda->id}}</title>

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

    @yield('head')
</head>

<body>

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                
                <div class="container-fluid">
                    <img style="position: absolute;float: right;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logoAi.png'))) }}" width="200px">
                    <h1>MagicShirts</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">Minha Encomenda</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6 ">
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Nome do Cliente:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->cliente->user->name}}</span>
                                    </div>
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Numero da Encomenda:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->id}}</span>
                                    </div>
    
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Estado da Encomenda:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->estado}}</span>
                                    </div>
    
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Data da Encomenda:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->data}}</span>
                                    </div>
    
                                    
                                </div>
                                <div class="col-12 col-lg-6 ">
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>NIF de Fatura????o:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->nif}}</span>
                                    </div>
    
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Endere??o de Fatura????o:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->endereco}}</span>
                                    </div>
    
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Metodo de Pagamento:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->tipo_pagamento}}</span>
                                    </div>
    
                                    <div style="padding-bottom: 10px;">
                                        <span class="font-weight-bold mb-3"><strong>Referencia de Pagamento:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->ref_pagamento}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <h3 class="font-weight-bold mb-3">Encomenda:</h3>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="    border: 1px solid #dee2e6;">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;">Nome Da Estampa</th>
                                                <th style="vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;">Cor</th>
                                                <th style="vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;">Tamanho</th>
                                                <th style="vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;">Quantidade</th>
                                                <th style="vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;">Pre??o por Unidade</th>
                                                <th style="vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;">Pre??o Total</th>
                                            </tr>
                                        </thead>
                                        <tbody style="display: table-row-group;vertical-align: middle;border-color: inherit;">
                                                @foreach ($tshirts as $tshirt)
                                                @php($estampa = App\Models\Estampa::where('id', $tshirt->estampa_id)->first())
                                                @php($cor = App\Models\Cor::where('codigo', $tshirt->cor_codigo)->first())
                                                <tr style="    display: table-row;vertical-align: inherit;border-color: inherit;">
                                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;border: 1px solid #dee2e6;text-align: center;">
                                                        @if ($estampa != null)
                                                        {{$estampa->nome}}
                                                        @endif
                                                    </td>
                                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;border: 1px solid #dee2e6;text-align: center;">
                                                        @if ($cor != null)
                                                            {{$cor->nome}}
                                                        @endif
                                                    </td>
                                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;border: 1px solid #dee2e6;text-align: center;">
                                                        {{$tshirt->tamanho}}                                                        
                                                    </td>
                                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;border: 1px solid #dee2e6;text-align: center;">
                                                        {{$tshirt->quantidade}}     
                                                    </td>
                                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;border: 1px solid #dee2e6;text-align: center;">
                                                        {{$tshirt->preco_un}}???
                                                    </td>
                                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;border: 1px solid #dee2e6;text-align: center;">
                                                        {{$tshirt->subtotal}}???  
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                    <div style="position: absolute; right: 54px;">
                                        <span class="font-weight-bold mb-3"><strong>Total:</strong></span>
                                        <span class="font-weight-normal">{{$encomenda->preco_total}}???</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{ asset('js/mixitup.min.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>
