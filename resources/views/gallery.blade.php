@extends('front_layouts.template')

@section('content')

    <div class="container">
        <div class="row">
            @for($i = 0; $i <= 10; $i++)

                <div class="col-2 gallery_item">
                    <img src="{{ asset('img/plain_white.png') }}" height="100" width="50">
                </div>
                
            @endfor
            
            <img src="{{ asset('storage/estampas/1_6079a48684474.png') }}" />
        </div>
    </div>

@endsection
