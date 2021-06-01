@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Nova Encomenda</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('encomendas.store')}}" class="form-group">
                                @csrf
                                <div class="form-group">
                                    <label for="inputNumeroCliente">Número de Cliente</label>
                                    <input type="text" class="form-control" name="numero" id="inputNumeroCliente"  value="{{old('numero', $encomenda->cliente_id)}}" >
                                    @error('numero')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputPreco">Valor da encomenda</label>
                                    <input type="text" class="form-control" name="preco" id="inputPreco"  value="{{old('preco', $encomenda->preco_total)}}" >
                                    @error('preco')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputNotas">Descrição</label>
                                    <input type="text" class="form-control" name="notas" id="inputNotas"  value="{{old('notas', $encomenda->notas)}}" >
                                    @error('notas')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputRecibo">Recibo</label>
                                    <input type="file" class="form-control" name="recibo_url" id="inputRecibo"  value="{{old('recibo_url', $encomenda->recibo_url)}}" >
                                    @error('recibo_url')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                @if (isset($user->foto_url))
                                    <img src="{{ asset("storage/pdf_recibos/$encomenda->recibo_url") }}" />
                                @endif
                                <div class="form-group">
                                <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                                        <a href="{{route('encomendas.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
