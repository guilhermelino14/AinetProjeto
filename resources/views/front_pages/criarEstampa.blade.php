@extends('front_layouts.template')

@section('content')

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <form method="POST" action="{{ route('storeEstampa') }}" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="row gutters">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="nome">Nome da estampa</label>
                                            <input type="text" class="form-control" name="nome" id="nome"
                                                placeholder="Nome da Estampa">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="descricao">Descrição da Estampa</label>
                                            <input type="text" class="form-control" name="descricao" id="descricao"
                                                placeholder="Descrição da Estampa">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pb-3">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <select class="form-control" id="categoria" name="categoria">
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="imagem_url">Foto da Estampa</label>
                                            <input type="file" class="form-control" name="imagem_url" id="imagem_url"
                                                placeholder="Foto da Estampa">
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <button type="submit" id="submit" name="submit"
                                                class="btn btn-primary">Criar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->




@endsection
