@extends('front_layouts.template')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{route('checkoutCart')}}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="checkout__input">
                                <p>Nome Completo<span>*</span></p>
                                <input type="text" name="name" id="name" @if(Auth::user() != null)value="{{Auth::user()->name}}"@endif>
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="email" name="email" id="email" @if(Auth::user() != null)value="{{Auth::user()->email}}"@endif>
                            </div>
                            @if(Auth::user() != null)
                            <div class="checkout__input">
                                <p>Endereço<span>*</span></p>
                                <input type="text" placeholder="Morada" class="checkout__input__add" name="endereco1" id="endereco1" value="{{Auth::user()->cliente->endereco}}">
                            </div>
                            @else
                                <div class="checkout__input">
                                    <p>Endereço<span>*</span></p>
                                    <input type="text" placeholder="Morada" class="checkout__input__add" name="endereco1" id="endereco1">
                                    <input type="text" placeholder="Apartamento, Numero, ect (optinal)" name="endereco2" id="endereco2">
                                </div>
                                <div class="checkout__input">
                                    <p>Postcode / ZIP<span>*</span></p>
                                    <input type="text" name="endereco3" id="endereco3">
                                </div>
                            @endif
                            <div class="checkout__input">
                                <p>NIF<span>*</span></p>
                                <input type="text" name="nif" id="nif" @if(Auth::user() != null)value="{{Auth::user()->cliente->nif}}"@endif>
                            </div>
                            <div class="checkout__input">
                                <p>Referencia Pagamento<span>*</span></p>
                                <input type="text" name="ref_pagamento" id="ref_pagamento" @if(Auth::user() != null)value="{{Auth::user()->cliente->ref_pagamento}}"@endif>
                            </div>
                            @if(Auth::user() == null)
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="password" name="password" id="password">
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @if (Session::has('cart'))
                                        @foreach ($items as $item)
                                            @php($cor = App\Models\Cor::where('codigo', $item['cor'])->first())
                                                <li>{{ $item['qty'] }}x {{ $item['item']['nome'] }} / {{ $item['tamanho'] }} /
                                                    {{ $cor->nome }} <span>{{ $item['price'] / $item['qty'] }}€</span></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="checkout__order__total">Total
                                        <span>{{ Session::has('cart') ? Session::get('cart')->totalPrice() : '0' }}€</span>
                                    </div>
                                    <div class="checkout__order__products">Tipo de Pagamento </div>
                                    <div class="checkout__input__checkbox">
                                        <select id="tipo_pagamento" name="tipo_pagamento">
                                            <option value="VISA">Visa</option>
                                            <option value="MC">MC</option>
                                            <option value="PAYPAL">Paypal</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="site-btn" @if (Session::has('cart'))
                                    @if ($totalPrice <= 0)
                                        style="pointer-events: none;
                                        cursor: default;"
                                    @endif
                                    @else
                                        style="pointer-events: none;
                                        cursor: default;"
                                    @endif>
                                        PLACE ORDER</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->

    @endsection
