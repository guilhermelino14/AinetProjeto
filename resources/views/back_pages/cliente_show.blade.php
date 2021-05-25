@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cliente</h6>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" value="{{$cliente->user->name}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" value="{{$cliente->user->email}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Tipo</label>
                                    @if ($cliente->user->tipo == 'A')
                                        <input type="text" value="Administrador" class="form-control" disabled>
                                        @else
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Bloqueado</label>
                                    @if ($cliente->user->bloqueado == '0')
                                        <input type="text" value="Não" class="form-control" disabled>
                                        @else
                                        <input type="text" value="Sim" class="form-control" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                </div>
                                @if ($cliente->user->foto_url != null)
                                    <img width="100px" height="100px" src="{{ asset("storage/fotos/".$cliente->user->foto_url) }}"/>
                                    @else
                                    <img width="100px" height="100px" src="{{ asset("admin_pub/img/undraw_profile.svg") }}"/>
                                @endif
                                <div><br></div>
                                <div class="form-group">
                                    <label>NIF</label>
                                    <input type="text" value="{{$cliente->nif}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" value="{{$cliente->endereco}}" class="form-control" disabled >
                                </div>
                                <div class="form-group">
                                <div class="form-group text-right">
                                        <a href="{{route('clientes.index')}}" class="btn btn-primary">Voltar</a>
                                </div>
                        </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
