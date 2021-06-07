@extends('back_layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Nova Cor</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('cores.store')}}" class="form-group">
                                @csrf
                                <div class="form-group">
                                    <label for="codigo">Codigo da Cor</label>
                                    <input type="text" class="form-control" name="codigo" id="codigo" >
                                    @error('codigo')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nome">Nome da Cor</label>
                                    <input type="text" class="form-control" name="nome" id="nome" >
                                    @error('nome')
                                        <div class="small text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="ok">Create</button>
                                        <a href="{{route('cores.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
@endsection
