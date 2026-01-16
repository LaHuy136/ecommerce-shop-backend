<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="{{ route('member.dashboard') }}"><img
                                src="{{ asset('frontend/images/home/logo.png') }}" alt="Logo Image..." /></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canada</a></li>
                                <li><a href="">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('checkouts.index') }}">
                                    <i class="fa fa-crosshairs"></i> Checkout
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('carts.index') }}" class="nav-link position-relative">
                                    <i class="fa fa-shopping-cart"></i> Cart

                                    <span id="cartQty" class="badge">
                                        {{ $cartQty }}
                                    </span>
                                </a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ url('/account') }}">
                                        <i class="fa fa-user"></i> Account
                                    </a>
                                </li>

                                {{-- <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i> Wishlist
                                    </a>
                                </li> --}}

                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-unlock"></i>Logout
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            @endauth

                            @guest
                                <li>
                                    <a href="{{ url('/login') }}">
                                        <i class="fa fa-sign-in"></i> Login
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('/register') }}">
                                        <i class="fa fa-sign-out"></i> Register
                                    </a>
                                </li>
                            @endguest

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li>
                                <a href="{{ route('member.dashboard') }}" class="active">Home</a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('products.home') }}">
                                    Shop <i class="fa fa-angle-down"></i>
                                </a>
                                <ul role="menu" class="sub-menu">
                                    <li>
                                        <a href="{{ url('/products') }}">Products</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('checkouts.index') }}">Checkout</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('carts.index') }}">Cart</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('blogs.index') }}">
                                    Blog <i class="fa fa-angle-down"></i>
                                </a>
                                <ul role="menu" class="sub-menu">
                                    <li>
                                        <a href="{{ url('/blog') }}">Blog List</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/404') }}">404</a>
                            </li>
                            <li>
                                <a href="{{ url('/contact-us') }}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{ route('products.search') }}" method="GET">
                            <input type="text" placeholder="Search" name="name" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const mainMenu = document.getElementsByClassName('mainmenu')[0];
        const listItems = mainMenu.querySelectorAll('ul li');

        listItems.forEach(function(li) {
            li.addEventListener("click", function() {
                a = this.querySelector("a");
                console.log(a)
                if (a.classList.contains("active")) {
                    a.classList.remove("active");
                } else {
                    a.classList.add("active");
                }
            })
        })
    </script>
    <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/add-to-cart.js') }}"></script>
</header><!--/header-->
