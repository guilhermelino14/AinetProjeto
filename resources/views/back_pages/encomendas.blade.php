@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Encomendas</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('encomendas.create') }}"><button type="button" class="btn btn-success" style="position: relative;margin-bottom: 17px;"> Criar Encomenda</button></a>
                            <form form action="{{ route('encomendas.index') }}" method="GET" role="search"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                        <select name="tipo" id="tipo" >
                                            <option value="*")>Todos</option>
                                            <option value="pendente" {{ old('tipo', $tipo) == "pendente" ? 'selected' : '' }}>Pendente</option>
                                            <option value="paga" {{ old('tipo', $tipo) == "paga" ? 'selected' : '' }}>Paga</option>
                                            @if (Auth::User()->tipo != 'F')
                                                <option value="fechada" {{ old('tipo', $tipo) == "fechada" ? 'selected' : '' }}>Fechada</option>
                                                <option value="anulada" {{ old('tipo', $tipo) == "anulada" ? 'selected' : '' }}>Anulada</option>
                                            @endif
                                        </select>
                                        @if (Auth::User()->tipo == 'A')
                                            <select name="data" id="data" >
                                            @foreach(range(date('Y')-3, date('Y')) as $y)
                                                <option value="{{$y}}" @if ($data == $y)
                                                    selected
                                                @endif)>{{$y}}</option>
                                            @endforeach
                                            </select>
                                        @endif
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Numero de Encomenda</th>
                                            <th>Data</th>
                                            <th>Ref</th>
                                            <th>Preço</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numero de Encomenda</th>
                                            <th>Data</th>
                                            <th>Ref</th>
                                            <th>Preço</th>
                                            <th>Estado</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($encomendas as $encomenda)
                                            <tr>
                                                <td>{{$encomenda->id}}</td>
                                                <td>{{$encomenda->data}}</td>
                                                <td>{{$encomenda->ref_pagamento}}</td>
                                                <td>{{$encomenda->preco_total}}</td>
                                                <td>{{$encomenda->estado}}</td>
                                                <td style="vertical-align: middle;">
                                                    <a href="{{route('encomendas.show', ['encomenda' => $encomenda->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Ver</a>
                                                </td>
                                                <td >
                                                    <a href="{{route('encomendas.edit', ['encomenda' => $encomenda->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                </td>
                                                <td >
                                                        <form action="{{route('encomendas.destroy', ['encomenda' => $encomenda->id])}}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                                                        </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                                {{ $encomendas->appends(request()->query())->links() }}
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
