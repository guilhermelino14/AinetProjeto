@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->

                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
                        </div>
                        <div class="card-body">
                            {{-- <a href="{{ route('clientes.create') }}"><button type="button" class="btn btn-success" style="position: relative;margin-bottom: 17px;"> Criar Cliente</button></a>  --}}
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Numero de Cliente</th>
                                            <th>Nome do Cliente</th>
                                            <th>Nif</th>
                                            <th>Endereço</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numero de Cliente</th>
                                            <th>Nome do Cliente</th>
                                            <th>Nif</th>
                                            <th>Endereço</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($clientes as $cliente)
                                            <tr>
                                                <td>{{$cliente->id}}</td>
                                                <td>{{$cliente->user->name}}</td>
                                                <td>{{$cliente->nif}}</td>
                                                <td>{{$cliente->endereco}}</td>
                                                <td style="vertical-align: middle;">
                                                    <a href="{{route('clientes.show', ['cliente' => $cliente->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Ver</a>
                                                </td>
                                                {{-- <td style="vertical-align: middle;">
                                                    <a href="{{route('clientes.edit', ['cliente' => $cliente->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                </td> --}}
                                                <td style="vertical-align: middle;">
                                                        <form action="{{route('clientes.destroy', ['cliente' => $cliente->id])}}" method="POST">
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
                                {{ $clientes->links() }}
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
