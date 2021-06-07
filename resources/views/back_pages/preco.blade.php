@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Cores</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Valor de Est.Catalogo</th>
                                            <th>Valor de Est.Propria</th>
                                            <th>Valor de Est.Catalogo c/Desconto</th>
                                            <th>Valor de Est.Propria c/Desconto</th>
                                            <th>Desconto por 10 Estampas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($precos as $preco)
                                            <tr>
                                                <td style="vertical-align: middle;">{{$preco->preco_un_catalogo}}€</td>
                                                <td style="vertical-align: middle;">{{$preco->preco_un_proprio}}€</td>
                                                <td style="vertical-align: middle;">{{$preco->preco_un_catalogo_desconto}}€</td>
                                                <td style="vertical-align: middle;">{{$preco->preco_un_proprio_desconto}}€</td>
                                                <td style="vertical-align: middle;">{{$preco->quantidade_desconto}}%</td>
                                                <td >
                                                    <a href="{{route('precos.edit', ['preco' => $preco->id])}}"
                                                        class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                                {{ $precos->links() }}
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
