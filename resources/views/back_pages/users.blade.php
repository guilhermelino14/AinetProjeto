@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Utilizadores</h6>
                        </div>

                        <div class="card-body">
                            <a href="{{ route('users.create') }}"><button type="button" class="btn btn-success" style="position: relative;margin-bottom: 17px;"> Criar Utilizador</button></a>
                            <!-- Topbar Search -->
                            <form form action="{{ route('users.index') }}" method="GET" role="search"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" id="user" name="user" class="form-control bg-light border-0 small" placeholder="Pesquisar"
                                        aria-label="Search" aria-describedby="basic-addon2"value="{{ old('user', $key) }}">
                                        <select name="tipo" id="tipo" >
                                            <option value="*")>Todos</option>
                                            <option value="A" {{ old('tipo', $tipo) == "A" ? 'selected' : '' }}>Administrador</option>
                                            <option value="C" {{ old('tipo', $tipo) == "C" ? 'selected' : '' }}>Cliente</option>
                                            <option value="F" {{ old('tipo', $tipo) == "F" ? 'selected' : '' }}>Funcionário</option>
                                        </select>
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
                                                    @if ($user->tipo != 'C')
                                                        <a href="{{route('users.edit', ['user' => $user->id])}}"
                                                            class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->tipo == 'C' && $user->bloqueado == '1')
                                                        <a href="{{route('client_state', ['id' => $user->id])}}" method="POST"
                                                            class="btn btn-success btn-sm" role="button" aria-pressed="true">Desbloquear</a>
                                                    @elseif ($user->tipo == 'C' && $user->bloqueado == '0')
                                                        <a href="{{route('client_state', ['id' => $user->id])}}" method="POST"
                                                            class="btn btn-warning btn-sm" role="button" aria-pressed="true">Bloquear</a>
                                                    @endif
                                                </td>
                                                    <td >
                                                        <form action="{{route('users.destroy', ['user' => $user->id])}}" method="POST">
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
