@extends('front_layouts.template')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Estampas</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <input id="image_url" hidden value="{{$estampa->imagem_url}}">
                            <img class="product__details__pic__item--large" id="estampa"
                            @if ($estampa->cliente_id == null)
                            src="{{ asset("storage/estampas/$estampa->imagem_url") }}"
                            @else
                            src="{{ route("estampas.privadas", $estampa) }}"
                            @endif
                                alt="">
                        </div>
                        {{-- <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $estampa->nome }}</h3>
                        {{-- <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div> --}}
                        @if ($estampa->cliente_id == null)
                            <div class="product__details__price">{{ $preco->preco_un_catalogo }} ???</div>
                        @else
                            <div class="product__details__price">{{ $preco->preco_un_proprio }} ???</div>
                        @endif
                        <p>{{ $estampa->descricao }}</p>

                        <ul>
                            <form method="GET" action="{{ route('addToCart', ['id' => $estampa->id]) }}">
                                <div class="row">
                                    <div class="col-12 col-lg-6 ">
                                        <select name="tamanho" id="tamanho" class="form-control form-control-lg">
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <select name="cor" id="cor" class="form-control form-control-lg">
                                            @foreach ($cores as $cor)
                                                <option value="{{$cor->codigo}}">{{$cor->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3 mb-3" style="text-align-last: center;">
                                        <div class="product__details__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <span class="dec qtybtn">-</span>
                                                    <input type="text" value="1" id="qty" name="qty">
                                                    <span class="inc qtybtn">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <button style="padding: 16px 28px 14px;margin-right: 6px;margin-bottom: 5px;" onclick="preview()" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#preview">
                                            Preview
                                          </button>
                                    </div>
                                    <div class="col-12 col-lg-6 ">
                                        <button type="submit" style="padding: 16px 28px 14px;margin-right: 6px;margin-bottom: 5px;" class="btn btn-primary btn-block" data-toggle="modal" >ADD TO CARD</button>
                                    </div>
                                    
                                </div>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                        suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                        vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                        accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                        pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                        elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                        et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                        vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                        sed sit amet dui. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($estampasRelated as $estamparelated)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                            @if ($estamparelated->cliente_id == null)
                            data-setbg="{{ asset("storage/estampas/$estamparelated->imagem_url") }}"
                            @else
                            data-setbg="{{ route("estampas.privadas", $estamparelated) }}"
                            @endif
                                >
                                <ul class="product__item__pic__hover">
                                    <li><a href="{{ route('shopdetails', $estamparelated->id)}}"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('shopdetails', $estamparelated->id) }}">{{ $estamparelated->nome }}</a></h6>
                                @if ($estamparelated->cliente_id == null)
                                    <h5>{{ $preco->preco_un_catalogo }}???</h5>
                                @else
                                    <h5>{{ $preco->preco_un_proprio }}???</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="position: relative; top: 0; left: 0;">
              <img id="tshirt" src="" style="position: relative; top: 0; left: 0;"/>
              @if ($estampa->cliente_id == null)
                <img id="tshirtTeste" src="" style=" position: absolute;top: 18%; left: 34%; width: 35%;"/>
                @else
                <img src="{{ route("estampas.privadas", $estampa) }}" style=" position: absolute;top: 18%; left: 34%; width: 35%;"/>
                @endif
            </div>
          </div>
        </div>
      </div>
      @section('scripts')
      <script>
          function preview() {
            var tshirt = document.getElementById("tshirt")
            var tshirtTeste = document.getElementById("tshirtTeste")
            var image_url = document.getElementById("image_url").value
            
            var cor = document.getElementById("cor").value
            console.log(estampa);
            tshirt.src='{{asset("storage/tshirt_base/")}}/'+cor+'.jpg'
            tshirtTeste.src='{{ asset("storage/estampas/")}}/'+image_url
            }
      </script>
      @endsection
    <!-- Related Product Section End -->

@endsection
