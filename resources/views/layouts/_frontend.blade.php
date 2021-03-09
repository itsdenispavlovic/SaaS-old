<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/img/logos/fav.png') }}" type="image/x-icon">
    <!-- ========================================= Css files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>{!! config('app.name') !!}</title>

    @yield('styles')
</head>
<body>
<!-- =========================== header-->
<header class="header has-style2">
    <!-- =========================== navbar-->
    <nav class="navbar is-dark">
        <div class="container">
            <div class="flex">
                <a href="../index.html " class="navbar-brand flex vcenter" href="#">
{{--                    <img data-aos="fade-right" class="logo" src="../assets/images/logos/logo-dark.svg" alt="">--}}
                    <h3>{!! config('app.name') !!}</h3>
                </a>
                <ul class="navbar-menu">
                    <li data-aos="fade-left" data-aos-delay="100"> <a class="fade-page"
                                                                      href="/">Home</a>
                    </li>
{{--                    <li class="menu-item-has-children">--}}
{{--                        <a>Gradient Demos</a>--}}
{{--                        <ul class="sub-menu">--}}
{{--                            <li><a class="fade-page" href="Home_1_grad.html">Home 1 <span--}}
{{--                                        class="text-grad">Gradient</span></a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="Home_2_grad.html">Home 2 <span--}}
{{--                                        class="text-grad">Gradient</span></a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="Home_3_grad.html">Home 3 <span--}}
{{--                                        class="text-grad">Gradient</span></a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="Home_4_grad.html">Home 4 <span--}}
{{--                                        class="text-grad">Gradient</span></a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="Home_5_grad.html">Home 5 <span--}}
{{--                                        class="text-grad">Gradient</span></a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="menu-item-has-children">--}}
{{--                        <a>Pages</a>--}}
{{--                        <ul class="sub-menu">--}}
{{--                            <li><a class="fade-page" href="page_about.html">About</a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="page_services.html">Services</a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="page_plans.html">Plans</a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="page_blog.html">Blog</a>--}}
{{--                            </li>--}}
{{--                            <li><a class="fade-page" href="page_blog details.html"> Blog Details</a>--}}
{{--                            </li>--}}

{{--                            <li><a class="fade-page" href="page_Article.html"> Article</a>--}}
{{--                            </li>--}}

{{--                            <li><a class="fade-page" href="page_contact.html"> Contact</a>--}}
{{--                            </li>--}}

{{--                            <li><a class="fade-page" href="page_help.html"> Help Center </a>--}}
{{--                            </li>--}}

{{--                            <li><a class="fade-page" href="page_help.html"> 404 Page </a>--}}
{{--                            </li>--}}


{{--                        </ul>--}}
{{--                    </li>--}}
                    <li data-aos="fade-left" data-aos-delay="200"> <a class="fade-page"
                                                                      href="{{ route('billing') }}">Plans</a> </li>
                </ul>
            </div>
            <div class="level-right">
                <!-- your list menu here -->
                <div class="navbar-menu">
                    <a href="{{ route('login') }}" data-aos="fade-left" data-aos-delay="400" class="btn btn-green btn-round"> Get
                        Started
                    </a>
                </div>
{{--                <div class="mobile-menu">--}}
{{--                    <!-- your list menu in mobile here -->--}}
{{--                    <ul>--}}
{{--                        <li><a class="fade-page" href="Home_1.html">Home 1</a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_2.html">Home 2</a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_3.html">Home 3</a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_4.html">Home 4</a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_5.html">Home 5</a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_1_grad.html">Home 1 <span--}}
{{--                                    class="text-grad">Gradient</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_2_grad.html">Home 2 <span--}}
{{--                                    class="text-grad">Gradient</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_3_grad.html">Home 3 <span--}}
{{--                                    class="text-grad">Gradient</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_4_grad.html">Home 4 <span--}}
{{--                                    class="text-grad">Gradient</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a class="fade-page" href="Home_5_grad.html">Home 5 <span--}}
{{--                                    class="text-grad">Gradient</span></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
                <div class="flex">
                    <div class="menu-toggle-icon">
                        <div class="menu-toggle">
                            <div class="menu">
                                <input type="checkbox">
                                <div class="line-menu"></div>
                                <div class="line-menu"></div>
                                <div class="line-menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('headerAddon')
    <div class="hero-particles particle-container">
        <div class="particle particle-6"></div>
    </div>
</header>
@yield('content')
<footer class="footer has-style2 bg-grad2 bg-pattern">
    <div class="footer-body bg-transparent">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6">
                    <div class="footer-desc">
                        <div class="logo">
                            <img src="../assets/images/icons/logo-icon.svg" alt="">
                        </div>
                        <p>Qonto is a Payment Institution (registration number 16958), supervised by the.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="list-title">Company</h6>
                    <ul class="list-items">
                        <li> <a href="#">About</a> </li>
                        <li> <a href="#">Our customers</a> </li>
                        <li> <a href="#">Contact us</a> </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="list-title">Useful links</h6>
                    <ul class="list-items">
                        <li> <a href="#">Media kit</a> </li>
                        <li> <a href="#">Affiliate program</a> </li>
                        <li> <a href="#">Contact us</a> </li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6 class="list-title">Legal</h6>
                    <ul class="list-items">
                        <li> <a href="#">Terms</a> </li>
                        <li> <a href="#">Privacy </a> </li>
                        <li> <a href="#">Cookies</a> </li>
                    </ul>
                </div>
            </div>
            <p class="copyright text-center text-copyright"> All rights reserved {{ date('Y') }}</p>
        </div>
    </div>
</footer>
{{--<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">--}}
{{--    <a class="navbar-brand" href="/">{{ config('app.name') }}</a>--}}
{{--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--        <span class="navbar-toggler-icon"></span>--}}
{{--    </button>--}}
{{--    <div class="collapse navbar-collapse" id="navbarNavDropdown">--}}
{{--        <ul class="navbar-nav w-100">--}}
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Features</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Pricing</a>--}}
{{--            </li>--}}
{{--            @if (Route::has('login'))--}}
{{--                @auth--}}
{{--                    <li class="ml-auto">--}}

{{--                        @can('tasks')--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#">My Tasks</a>--}}
{{--                        </li>--}}
{{--                        @endcan--}}

{{--                        <li class="nav-item dropdown">--}}

{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ auth()->user()->username }} </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                @if(auth()->user()->type == "admin")--}}
{{--                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a>--}}
{{--                                @endif--}}
{{--                                <a href="{{ route('billing') }}" class="dropdown-item">Billing</a>--}}
{{--                                <a href="{{ url('/logout') }}" class="dropdown-item"--}}
{{--                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                                    <i class="fa fa-lock"></i>Logout--}}
{{--                                </a>--}}
{{--                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </li>--}}
{{--                @else--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('login') }}" class="nav-link">Log in</a>--}}
{{--                    </li>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('register') }}" class="nav-link">Register</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @endauth--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</nav>--}}
{{--<div style="padding-top: 80px;">--}}
{{--    @if(auth()->check() && auth()->user()->trial_ends_at)--}}
{{--        <div class="alert alert-info text-center">--}}
{{--            You have {{ now()->diffInDays(auth()->user()->trial_ends_at) }} days of free trial left. <a href="{{ route('billing') }}">Choose your plan</a> at any time.--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @yield('content')--}}
{{--</div>--}}

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}

<script src="{{ asset('assets/js/plugins/jQuery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather-icons.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/aos.js') }}"></script>
<script src="{{ asset('assets/js/plugins/typed.js') }}"></script>
<script src="{{ asset('assets/js/plugins/all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.counterup.min.js') }}"></script>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@stack('scripts')
</body>
</html>
