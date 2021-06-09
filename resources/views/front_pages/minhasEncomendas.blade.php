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
                            <h6 class="m-0 font-weight-bold text-primary">Minhas Encomendas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nº da Encomenda</th>
                                            <th>Estado</th>
                                            <th>Data</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nº da Encomenda</th>
                                            <th>Estado</th>
                                            <th>Data</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            @foreach ($encomendas as $encomenda)
                                            <tr>
                                                <td>
                                                    {{$encomenda->id}}
                                                </td>
                                                <td>
                                                    {{$encomenda->estado}}
                                                </td>
                                                <td>
                                                    {{$encomenda->data}}
                                                </td>
                                                <td>
                                                    {{$encomenda->preco_total}}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <a href="{{ route('minhasencomendas.show', $encomenda->id)}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Ver</a>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                                {{ $encomendas->links() }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->




@endsection
