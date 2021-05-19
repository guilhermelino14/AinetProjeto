<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/logoAI.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="img/language.png" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Spanis</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('shopgrid') }}">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ url('shopdetails') }}">Shop Details</a></li>
                    <li><a href="{{ url('shoppingcart') }}">Shoping Cart</a></li>
                    <li><a href="{{ url('checkout') }}">Check Out</a></li>
                </ul>
            </li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6" style="top: 10px;">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Free Shipping for all Order of $99</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        @guest
                            @if (Route::has('login'))


                                <div class="header__top__right__auth" style="position: relative;top: 4px;">

                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                                </div>
                            @endif
                            @if (Route::has('register'))
                                <div class="header__top__right__auth" style="position: relative;top: 4px;">

                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                                </div>
                            @endif
                        @else

                            <div class="header__top__right__language" style="top: 10px" aria-haspopup="true"
                                aria-expanded="false">
                                <div>
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        <img class="img-profile rounded-circle" width="20px"
                                            src="{{ asset('admin/img/undraw_profile.svg') }}">
                                    </a>
                                </div>

                                <ul style="top: 40px">
                                    @if (Auth::user()->tipo === 'A')
                                        
                                    
                                    <li><a class="dropdown-item" href="{{ route('admin') }}">
                                        Admin
                                        </a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                  document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}"><img src="img/logoAI.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('shopgrid') }}">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{ url('shopdetails') }}">Shop Details</a></li>
                                <li><a href="{{ url('shoppingcart') }}">Shoping Cart</a></li>
                                <li><a href="{{ url('checkout') }}">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ url('shoppingcart') }}"><i class="fa fa-shopping-bag"></i> <span>3</span></a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span>$150.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Categorias</span>
                    </div>
                    <ul style="display: none; position:absolute; background-color:white; z-index: 3; width:90%">
                        <li><a href="#">Bebidas</a></li>
                        <li><a href="#">Cool</a></li>
                        <li><a href="#">Desenhos Abstratos</a></li>
                        <li><a href="#">Desporto</a></li>
                        <li><a href="#">Engraçadas</a></li>
                        <li><a href="#">Filmes</a></li>
                        <li><a href="#">Frases</a></li>
                        <li><a href="#">Geeks</a></li>
                        <li><a href="#">Infantil</a></li>
                        <li><a href="#">Inspiração</a></li>
                        <li><a href="#">Locais</a></li>
                        <li><a href="#">Logotipos</a></li>
                        <li><a href="#">Memes</a></li>
                        <li><a href="#">Musica</a></li>
                        <li><a href="#">Publicidade e Marcas</a></li>
                        <li><a href="#">Sem Sentido</a></li>
                        <li><a href="#">Simples</a></li>
                        <li><a href="#">Surf</a></li>
                        <li><a href="#">Verão</a></li>
                        <li><a href="#">Vintage</a></li>
                        <li><a href="#">Tattoo</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
