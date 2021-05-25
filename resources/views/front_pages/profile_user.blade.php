@extends('front_layouts.template')

@section('content')

    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-60">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    @if (Auth::user()->foto_url != null)
                                        <img src="{{ asset('storage/fotos/' . Auth::user()->foto_url) }}" alt="User_Pic">
                                    @else
                                        <img src="{{ asset('admin_pub/img/undraw_profile.svg') }}" alt="User_Pic">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile_update', $user) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row gutters">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name"
                                            placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email"
                                            placeholder="Enter email">
                                    </div>
                                </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="website">Morada</label>
                                            <input type="text" class="form-control" value="{{ $user->cliente->endereco }}"
                                                id="endereco" name="endereco" placeholder="Enter adress">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="phone">NIF</label>
                                            <input type="text" class="form-control" value="{{ $user->cliente->nif }}" name="nif" id="nif"
                                                placeholder="Enter NIF">
                                        </div>
                                    </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="phone">Alterar Imagem</label>
                                        <input type="file" class="form-control" name="img" id="img"
                                            placeholder="Enter photo">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                            placeholder="Enter password again">
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
