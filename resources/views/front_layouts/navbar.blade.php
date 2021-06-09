<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset('img/logoAI.png') }}" alt=""></a>
    </div>
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

                <div class="header__top__right__language" style="top: 4px" aria-haspopup="true"
                    aria-expanded="false">
                    <div>
                        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <span>{{ Auth::user()->name }}</span>
                            @if (Auth::user()->foto_url != null)
                                <img class="img-profile rounded-circle" width="20px"
                                    src="{{ asset('storage/fotos/' . Auth::user()->foto_url) }}">
                            @else
                                <img class="img-profile rounded-circle" width="20px"
                                    src="{{ asset('admin_pub/img/undraw_profile.svg') }}">
                            @endif

                        </a>
                    </div>

                    <ul style="top: 40px">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">
                                Perfil
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('minhasEstampas') }}">
                                Minhas Estampas
                            </a></li>
                        <li><a class="dropdown-item" >
                                Minhas Encomendas
                            </a></li>
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
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('shopgrid') }}">Estampas</a></li>
            <li><a href="{{ url('criarEstampa') }}">Criar Estampa</a></li>
            <li><a href="{{ url('contact') }}">Contactos</a></li>
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
            <li><i class="fa fa-envelope"></i> help@magicshirt.com</li>
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
                            <li><i class="fa fa-envelope"></i> help@magicshirt.com</li>
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

                            <div class="header__top__right__language" style="top: 4px" aria-haspopup="true"
                                aria-expanded="false">
                                <div>
                                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        @if (Auth::user()->foto_url != null)
                                            <img class="img-profile rounded-circle" width="20px"
                                                src="{{ asset('storage/fotos/' . Auth::user()->foto_url) }}">
                                        @else
                                            <img class="img-profile rounded-circle" width="20px"
                                                src="{{ asset('admin_pub/img/undraw_profile.svg') }}">
                                        @endif

                                    </a>
                                </div>

                                <ul style="top: 40px">
                                    @if (Auth::User()->tipo != "F")
                                    <li><a class="dropdown-item" href="{{ route('profile') }}">
                                        Perfil
                                    </a></li>
                                    @endif
                                    @if (Auth::User()->tipo == "C")
                                    <li><a class="dropdown-item" href="{{ route('minhasEstampas') }}">
                                        Minhas Estampas
                                        </a></li>
                                    @endif
                                    <li><a href="{{ route('minhasencomendas') }}" class="dropdown-item" >
                                        Minhas Encomendas
                                    </a></li>
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
                <div class="header__logo" style="padding-right: 13%;">
                    <a href="{{ url('/') }}"><img src="{{ asset('img/logoAI.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li @if (Request::route()->getName() == 'homeT') class="active" @endif>
                            <a href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li @if (Request::route()->getName() == 'shopgrid') class="active" @endif>
                            <a href="{{ url('shopgrid') }}">Estampas</a>
                        </li>
                        @guest
                        @else
                        @if (Auth::User()->tipo == "C")
                            <li @if (Request::route()->getName() == 'criarEstampa') class="active" @endif>
                                <a href="{{ url('criarEstampa') }}">Criar</a>
                            </li>
                        @endif
                        @endguest
                        <li @if (Request::route()->getName() == 'contact') class="active" @endif>
                            <a href="{{ url('contact') }}">Contactos</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ url('shoppingcart') }}"><i class="fa fa-shopping-bag"></i>
                                <span>{{ Session::has('cart') ? Session::get('cart')->totalQty() : '0' }}</span></a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item:
                        <span>{{ Session::has('cart') ? Session::get('cart')->totalPrice() : '0' }}€</span></div>
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
                        @php($categorias = App\Models\Categoria::all())
                        @if(count($categorias)> 0)
                            @foreach($categorias as $categoria)
                                <li><a href="{{ route('shopgrid_categorias', $categoria->id) }}">{{$categoria->nome}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('search') }}" method="GET" role="search">

                            <input type="text" id="estampa" name="estampa" placeholder="Procurar estampas?">
                            <button type="submit" class="site-btn">PROCURAR</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>244 820 300</h5>
                            <span>Suporte 24/7 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
<script>
    console.log($request - > path())

</script>
