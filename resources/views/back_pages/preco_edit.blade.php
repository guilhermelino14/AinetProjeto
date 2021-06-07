@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Preco</h6>
                        </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('precos.update', $preco)}}" class="form-group">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label>Valor de Est.Catalogo</label>
                                        <input type="text" name="preco_un_catalogo" id="preco_un_catalogo" value="{{$preco->preco_un_catalogo}}" class="form-control" >
                                    </div>
                                    @error('preco_un_catalogo')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label>Valor de Est.Propria	</label>
                                        <input type="text" name="preco_un_proprio" id="preco_un_proprio" value="{{$preco->preco_un_proprio}}" class="form-control" >
                                    </div>
                                    @error('preco_un_proprio')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label>Valor de Est.Catalogo c/Desconto	</label>
                                        <input type="text" name="preco_un_catalogo_desconto" id="preco_un_catalogo_desconto" value="{{$preco->preco_un_catalogo_desconto}}" class="form-control" >
                                    </div>
                                    @error('preco_un_catalogo_desconto')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label>Valor de Est.Propria c/Desconto</label>
                                        <input type="text" name="preco_un_proprio_desconto" id="preco_un_proprio_desconto" value="{{$preco->preco_un_proprio_desconto}}" class="form-control" >
                                    </div>
                                    @error('preco_un_proprio_desconto')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label>Desconto por 10 Estampas</label>
                                        <input type="text" name="quantidade_desconto" id="quantidade_desconto" value="{{$preco->quantidade_desconto}}" class="form-control" >
                                    </div>
                                    @error('quantidade_desconto')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                                        <a href="{{route('precos.index')}}" class="btn btn-primary">Voltar</a>
                                    </div>
                                </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
