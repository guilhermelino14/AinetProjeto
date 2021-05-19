@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Bloqueado</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Bloqueado</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->tipo}}</td>
                                                <td>{{$user->bloqueado}}</td>
                                                <td>
                                                    <a href="#"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                    </td>
                                                    <td>
                                                        <form action="#" method="POST">
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
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection