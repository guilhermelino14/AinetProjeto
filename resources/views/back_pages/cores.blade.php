@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Cores</h6>
                        </div>
                        <div class="card-body">
                            @if (Auth::User()->tipo == 'A')
                                <a href="{{ route('cores.create') }}"><button type="button" class="btn btn-success" style="position: relative;margin-bottom: 17px;"> Adicionar Cor</button></a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Imagem da cor</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Imagem da cor</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($cores as $cor)
                                            <tr>
                                                <td style="vertical-align: middle;">{{$cor->nome}}</td>
                                                <td style="vertical-align: middle;">{{$cor->codigo}}</td>
                                                <td> <div style=" float: left; width: 60px; height: 60px; margin: 5px; border: 1px solid rgba(0, 0, 0, .2); background: #{{$cor->codigo}};"></div></td>
                                                @if (Auth::User()->tipo == 'A')
                                                <td >
                                                    <a href="{{route('cores.edit', ['core' => $cor->codigo])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                </td>
                                                <td >
                                                        <form action="{{route('cores.destroy', ['core' => $cor->codigo])}}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                                                        </form>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                                {{ $cores->links() }}
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
