@extends('front_layouts.template')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::has('cart'))
                                    @foreach ($items as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset("storage/estampas/".$item['item']['imagem_url']) }}" alt="" width="100px">
                                        <h5>{{ $item['item']['nome']}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ $item['price'] / $item['qty']}}€
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <a href="{{route('editItemFromCart', ['id' => $item['item']['id'],'operator' => '-'])}}"><span class="dec qtybtn">-</span></a>
                                                <input type="text" value="{{ $item['qty'] }}" disabled>
                                                <a href="{{route('editItemFromCart', ['id' => $item['item']['id'],'operator' => '+'])}}"><span class="inc qtybtn">+</span></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{ $item['price'] }}€
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{route('removeFromCart', ['id' => $item['item']['id']])}}"><span><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6">
                    {{-- <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>@if (Session::has('cart')){{$totalPrice}} @else 0 @endif€</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn"
                        @if (Session::has('cart'))
                            @if ($totalPrice <= 0)
                                style="pointer-events: none;
                                cursor: default;"
                            @endif
                        @else
                            style="pointer-events: none;
                            cursor: default;"
                        @endif
                        
                        >PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection
