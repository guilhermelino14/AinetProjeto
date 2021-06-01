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
                                    <input type="text" class="form-control" name="name" id="inputNome"  value="{{old('name', $user->name)}}" >
                                    @error('name')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" class="form-control" name="email" id="inputEmail"  value="{{old('email', $user->email)}}" >
                                    @error('email')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="text" class="form-control" name="password" id="inputPassword"  >
                                    @error('password')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputTipo">Tipo de utilizador:</label>
                                    <select name="tipo" id="tipo" >
                                        <option value="A" {{old('tipo', $user->tipo)=="A" ? 'selected' : ''}}>Administrador</option>
                                        <option value="C" {{old('tipo', $user->tipo)=="C" ? 'selected' : ''}}>Cliente</option>
                                        <option value="F" {{old('tipo', $user->tipo)=="F" ? 'selected' : ''}}>Funcionário</option>
                                    </select>
                                    @error('tipo')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div>Bloqueado</div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="inputSim" name="bloqueado"  value="1" {{old('bloqueado',  $user->bloqueado) == '1' ? 'checked' : ''}} >
                                        <label class="form-check-label" for="inputSim"> Sim </label>
                                        <input type="radio" class="form-check-input ml-4" id="inputNao" name="bloqueado"  value="0" {{old('bloqueado',  $user->bloqueado) == '0' ? 'checked' : ''}} >
                                        <label class="form-check-label" for="inputNao"> Não </label>
                                    </div>
                                    @error('bloqueado')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputFoto">Foto</label>
                                    <input type="file" class="form-control" name="foto_url" id="inputFoto"  value="{{old('foto_url', $user->foto_url)}}" >
                                    @error('foto_url')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                @if (isset($user->foto_url))
                                    <img src="{{ asset("storage/fotos/$user->foto_url") }}" />
                                @endif
                                <div class="form-group">
                                <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                                        <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
