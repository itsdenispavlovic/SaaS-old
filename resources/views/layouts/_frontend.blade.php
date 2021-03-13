<!doctype html>
<html lang="en">
<head>
    @include('layouts._meta_head')
</head>
<body>
<!-- =========================== header-->
@if(auth()->check() && auth()->user()->trial_ends_at)
    <div class="alert alert-info text-center mb-0 rounded-0">
        You have {{ now()->diffInDays(auth()->user()->trial_ends_at) }} days of free trial left. <a href="{{ route('billing') }}">Choose your plan</a> at any time.
    </div>
@endif
<header class="header has-style2">
    <!-- =========================== navbar-->
    <nav class="navbar is-dark">
        <div class="container">
            <div class="flex">
                <a href="/" class="navbar-brand flex vcenter">
{{--                    <img data-aos="fade-right" class="logo" src="../assets/images/logos/logo-dark.svg" alt="">--}}
                    <h3>{!! config('app.name') !!}</h3>
                </a>
                <ul class="navbar-menu">
                    @foreach($menus as $menu)
                        <li data-aos="fade-left" data-aos-delay="100">
                            <a class="fade-page" href="{{ $menu->slug == "home" ? '/' : $menu->slug }}">{{ $menu->menu_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="level-right">
                <!-- your list menu here -->
                <div class="navbar-menu">
                    @if(Auth::check())
                        <a href="{{ url('/logout') }}" data-aos="fade-left" data-aos-delay="400" class="btn btn-green btn-round"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-lock"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" data-aos="fade-left" data-aos-delay="400" class="btn btn-green btn-round"> Get
                            Started
                        </a>
                    @endif
                </div>
                <div class="mobile-menu">
                    <!-- your list menu in mobile here -->
                    <ul>
                        @foreach($menus as $menu)
                            <li>
                                <a class="fade-page" href="{{ $menu->slug == "home" ? '/' : $menu->slug }}">{{ $menu->menu_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
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
{{--                            <img src="../assets/images/icons/logo-icon.svg" alt="">--}}
                            <h3 class="text-white">
                                {!! config('app.name') !!}
                            </h3>
                        </div>
                        <p>{!! $footer->short_description !!}</p>
                    </div>
                </div>
                @if(!empty($footer['company_links']) && count($footer['company_links']) > 0)
                    <div class="col-lg-2 col-6">
                        <h6 class="list-title">Company</h6>
                            <ul class="list-items">
                                @foreach($footer['company_links'] as $companyLink)
                                    <li> <a href="{{ asset($companyLink->short_description) }}">{{ $companyLink->menu_name }}</a> </li>
                                @endforeach
                            </ul>
                    </div>
                @endif

                @if(!empty($footer['useful_links']) && count($footer['useful_links']) > 0)
                    <div class="col-lg-2 col-6">
                        <h6 class="list-title">Useful links</h6>
                        <ul class="list-items">
                            @foreach($footer['useful_links'] as $companyLink)
                                <li> <a href="{{ asset($companyLink->short_description) }}">{{ $companyLink->menu_name }}</a> </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!empty($footer['legal_links']) && count($footer['legal_links']) > 0)
                    <div class="col-lg-2">
                        <h6 class="list-title">Legal</h6>
                        <ul class="list-items">
                            @foreach($footer['legal_links'] as $companyLink)
                                <li> <a href="{{ asset($companyLink->short_description) }}">{{ $companyLink->menu_name }}</a> </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
<script src="{{ asset(
    'assets/js/plugins/aos.js') }}"></script>
<script src="{{ asset('assets/js/plugins/typed.js') }}"></script>
<script src="{{ asset('assets/js/plugins/all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.counterup.min.js') }}"></script>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Sweet Aler 2.10 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    window.addEventListener('swal:modal-listener', event => {
        Swal.fire({
            icon: event.detail.type,
            title: event.detail.title,
            text: event.detail.text
        });
    })
</script>

@livewireScripts

@stack('scripts')
</body>
</html>
