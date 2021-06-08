@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Categorias</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('categorias.create') }}"><button type="button" class="btn btn-success" style="position: relative;margin-bottom: 17px;"> Criar Categoria</button></a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nome</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Nome</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($categorias as $categoria)
                                            <tr>
                                                <td>{{$categoria->id}}</td>
                                                <td>{{$categoria->nome}}</td>
                                                <td >
                                                    <a href="{{route('categorias.edit', ['categoria' => $categoria->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                </td>
                                                <td >
                                                        <form action="{{route('categorias.destroy', ['categoria' => $categoria->id])}}" method="POST">
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
                                {{ $categorias->links() }}
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
