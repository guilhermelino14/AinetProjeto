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
                            <form method="POST" action="{{route('categorias.store')}}" class="form-group">
                                @csrf
                                <div class="form-group">
                                    <label for="nome">Nome da Categoria</label>
                                    <input type="text" class="form-control" name="nome" id="nome" >
                                    @error('nome')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                                        <a href="{{route('categorias.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
