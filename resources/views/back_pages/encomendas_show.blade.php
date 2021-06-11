@extends('back_layouts.template')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dados da Encomenda</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Numero de encomenda</label>
                    <input type="text" value="{{ $encomenda->id }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <input type="text" value="{{ $encomenda->estado }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Data de encomenda</label>
                    <input type="text" value="{{ $encomenda->data }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Valor da encomenda</label>
                    <input type="text" value="{{ $encomenda->preco_total }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    @if ($encomenda->notas == null)
                        <input type="text" value="Sem descrição" class="form-control" disabled>
                    @else
                        <input type="text" value="{{ $encomenda->notas }}" class="form-control" disabled>
                    @endif
                </div>
                <div class="form-group">
                    <label>Número de cliente</label>
                    <input type="text" value="{{ $encomenda->cliente_id }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Nome do cliente</label>
                    <input type="text" value="{{ $encomenda->cliente->user->name }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Número de Identificação Fiscal</label>
                    <input type="text" value="{{ $encomenda->nif }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Endereço de envio</label>
                    <input type="text" value="{{ $encomenda->endereco }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Tipo de pagamento</label>
                    <input type="text" value="{{ $encomenda->tipo_pagamento }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Referência para pagamento</label>
                    <input type="text" value="{{ $encomenda->ref_pagamento }}" class="form-control" disabled>
                </div>
                <div class="row">
                    <div class="card-body">
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
                                    @foreach ($encomenda->tshirt as $tshirt)
                                    @php($estampa = App\Models\Estampa::where('id', $tshirt->estampa_id)->first())
                                    @php($cor = App\Models\Cor::where('codigo', $tshirt->cor_codigo)->first())
                                    <tr>
                                        <td><img @if ($estampa->cliente_id == null)
                                            src="{{ asset("storage/estampas/".$estampa->imagem_url) }}"
                                            @else
                                            src="{{ route("estampas.privadas", $estampa->imagem_url) }}"
                                            @endif alt="" width="100px">
                                        </td>
                                        <td>
                                            {{$estampa->nome}}
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
                <div class="row">
                @switch($encomenda->estado)
                    @case("pendente")
                        <div class="col-6">
                            <div class="form-group text-left">
                                <label>Marcar a encomenda como</label>
                                <a href="{{ route('encomendas.changeEncomendaEstado', [$encomenda, 1]) }}" class="btn btn-primary form-control">Pagar Encomenda</a>
                            </div>
                        </div>
                        
                    @break

                    @case("paga")
                        <div class="col-6">
                            <div class="form-group text-left">
                                <label>Marcar a encomenda como</label>
                                <a href="{{ route('encomendas.changeEncomendaEstado', [$encomenda, 2]) }}" class="btn btn-primary form-control">Fechar Encomenda</a>
                            </div>
                        </div>
                        
                    @break
                    @default
                        
                @endswitch
                    @if ($encomenda->estado != "anulada" && Auth::User()->tipo != 'F')
                        <div class="col-6" style="top: 8px;">
                            <div class="form-group text-right">
                                <label></label>
                                <a href="{{ route('encomendas.changeEncomendaEstado', [$encomenda, 3]) }}" class="btn btn-danger form-control">Anular Encomenda</a>
                            </div>
                        </div>
                    @endif
                    
                </div>
                <div class="form-group text-right">
                    <a href="{{ route('encomendas.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
