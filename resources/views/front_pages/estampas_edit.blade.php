@extends('front_layouts.template')

@section('content')

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">

                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Estampa</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('estampas.privadas.update', ["estampa"=>$estampa])}}" class="form-group">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        @foreach ($categorias as $categoria )
                                        <option @if($estampa->categoria_id == $categoria->id) selected @endif value="{{ $categoria->id}}">{{$categoria->nome}}</option>
                                        @endforeach
                                    </select>
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
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                                    <a href="{{route('minhasEstampas')}}" class="btn btn-primary">Voltar</a>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->




@endsection
