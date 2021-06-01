@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Estampa</h6>
                        </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('estampas.store')}}" class="form-group">
                                    @csrf
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <input type="text" name="categoria" value="{{$estampa->categoria_id}}" class="form-control" >
                                    </div>
                                    @error('categoria')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" name="nome" value="{{$estampa->nome}}" class="form-control" >
                                    </div>
                                    @error('nome')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <input type="text" name="descricao" value="{{$estampa->descricao}}" class="form-control" >
                                    </div>
                                    @error('descricao')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="inputImagem">Padrão</label>
                                        <input type="file" class="form-control" name="imagem_url" id="inputImagem"  value="{{old('imagem_url', $estampa->imagem_url)}}" >
                                        @error('imagem_url')
                                            <div class="small text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    @if (isset($user->foto_url))
                                        <img src="{{ asset("storage/estampas/$estampa->imagem_url") }}" />
                                    @endif
                                    <div class="form-group">
                                        <label>Informação extra</label>
                                        @if ($estampa->informacao_extra == null)
                                            <input type="text" name="info" value="Sem descrição" class="form-control" >
                                            @else
                                            <input type="text" name="info" value="{{$estampa->informacao_extra}}" class="form-control" disabled>
                                        @endif
                                    </div>
                                    @error('info')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                                        <a href="{{route('estampas.index')}}" class="btn btn-primary">Voltar</a>
                                    </div>
                                </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
