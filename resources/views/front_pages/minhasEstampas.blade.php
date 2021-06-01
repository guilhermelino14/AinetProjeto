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
                            <h6 class="m-0 font-weight-bold text-primary">Minhas Estampas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>foto</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>foto</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($estampas as $estampa)
                                            <tr>
                                                <td style="vertical-align: middle;">@if ($estampa->categorias != null)
                                                    {{$estampa->categorias->nome}}
                                                @endif</td>
                                                <td style="vertical-align: middle;">{{$estampa->nome}}</td>
                                                <td style="vertical-align: middle;">{{$estampa->descricao}}</td>
                                                <td><img width="100px" height="100px" src="{{ asset("storage/estampas/$estampa->imagem_url") }}"/></td>
                                                <td style="vertical-align: middle;">
                                                    <a href="{{route('estampas.edit', ['estampa' => $estampa->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                        <form action="{{route('estampas.destroy', ['estampa' => $estampa->id])}}" method="POST">
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
                                {{ $estampas->links() }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->




@endsection
