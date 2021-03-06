@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Encomenda</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('encomendas.update', $encomenda)}}" class="form-group">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label>Numero de encomenda</label>
                                    <input type="text" value="{{$encomenda->id}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Estado da encomenda</label>
                                    <select name="estado" id="estado" >
                                        <option value="paga" {{old('estado', $encomenda->estado)=="paga" ? 'selected' : ''}}>Paga</option>
                                        <option value="fechada" {{old('estado', $encomenda->estado)=="fechada" ? 'selected' : ''}}>Fechada</option>
                                        <option value="anulada" {{old('estado', $encomenda->estado)=="anulada" ? 'selected' : ''}}>Anulada</option>
                                    </select>
                                    @error('estado')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Valor da encomenda</label>
                                    <input type="text" name="valor" value="{{$encomenda->preco_total}}" class="form-control" >
                                </div>
                                @error('valor')
                                        <div class="small text-danger">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label>Descri????o</label>
                                    @if ($encomenda->notas == null)
                                        <input type="text" name="notas" value="Sem descri????o" class="form-control"  >
                                        @else
                                        <input type="text" name="notas" value="{{$encomenda->notas}}" class="form-control" >
                                    @endif
                                </div>
                                @error('notas')
                                        <div class="small text-danger">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label>N??mero de cliente</label>
                                    <input type="text" value="{{$encomenda->cliente_id}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nome do cliente</label>
                                    <input type="text" value="{{$encomenda->cliente->user->name}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>N??mero de Identifica????o Fiscal</label>
                                    <input type="text" value="{{$encomenda->nif}}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Endere??o de envio</label>
                                    <input type="text" name="endereco" value="{{$encomenda->endereco}}" class="form-control" >
                                </div>
                                @error('endereco')
                                        <div class="small text-danger">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label>Tipo de pagamento</label>
                                    <select name="tipo" id="tipo" >
                                        <option value="VISA" {{old('estado', $encomenda->estado)=="VISA" ? 'selected' : ''}}>Visa</option>
                                        <option value="MC" {{old('estado', $encomenda->estado)=="MC" ? 'selected' : ''}}>Cart??o de cr??dito</option>
                                        <option value="PAYPAL" {{old('estado', $encomenda->estado)=="PAYPAL" ? 'selected' : ''}}>PayPal</option>
                                    </select>
                                </div>
                                @error('tipo')
                                        <div class="small text-danger">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label>Refer??ncia para pagamento</label>
                                    <input type="text" name="ref" value="{{$encomenda->ref_pagamento}}" class="form-control" >
                                </div>
                                @error('ref')
                                        <div class="small text-danger">{{$message}}</div>
                                @enderror
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
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                                    <a href="{{route('encomendas.index')}}" class="btn btn-primary">Voltar</a>
                                </div>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
