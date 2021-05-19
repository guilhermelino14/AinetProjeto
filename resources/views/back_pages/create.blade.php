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
                            <form method="POST" action="{{route('users.store')}}" class="form-group">
                                @csrf
                                <div class="form-group">
                                    <label for="inputNome">Nome</label>
                                    <input type="text" class="form-control" name="name" id="inputNome" {{-- value="{{old('name', $user->name)}}" --}} >
                                    @error('name')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" class="form-control" name="email" id="inputEmail" {{-- value="{{old('email', $user->email)}}" --}} >
                                    @error('email')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="text" class="form-control" name="password" id="inputPassword" {{-- value="{{old('password', $user->password)}}" --}} >
                                    @error('email')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputTipo">Tipo</label>
                                    <!-- Inserir Dropdown -->
                                    @error('tipo')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div>Bloqueado</div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="inputSim" name="bloqueado" {{-- value="1" {{old('bloqueado',  $user->bloqueado) == '1' ? 'checked' : ''}} --}} >
                                        <label class="form-check-label" for="inputSim"> Sim </label>
                                        <input type="radio" class="form-check-input ml-4" id="inputNao" name="bloqueado" {{-- value="0" {{old('bloqueado',  $user->bloqueado) == '0' ? 'checked' : ''}} --}} >
                                        <label class="form-check-label" for="inputNao"> Não </label>
                                    </div>
                                    @error('bloqueado')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputFoto">Foto</label>
                                    <input type="file" class="form-control" name="foto_url" id="inputFoto" {{-- value="{{old('password', $user->cliente->foto_url)}}" --}} >
                                    @error('tipo')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputNif">NIF</label>
                                    <input type="text" class="form-control" name="nif" id="inputNif" {{-- value="{{old('nif', $user->cliente->nif)}}" --}} >
                                    @error('nif')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEndereco">Endereço</label>
                                    <input type="text" class="form-control" name="endereco" id="inputEndereco" {{-- value="{{old('endereco', $user->cliente->endereco)}}" --}} >
                                    @error('endereco')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                                        <a href="{{route('users.create')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
