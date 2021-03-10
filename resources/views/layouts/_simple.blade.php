<!doctype html>
<html lang="en">
<head>
    @include('layouts._meta_head')
</head>
<body>
    <!-- =========================== header-->
    <header class="header-page2" >
        <!-- =========================== navbar-->
        <nav class="navbar is-dark">
            <div class="container">
                <div class="flex">
                    <a href="/" class="navbar-brand flex vcenter">{!! config('app.name') !!}</a>

                </div>
                <div class="level-right">
                    <!-- your list menu here -->
                    {{--                    <div class="navbar-menu">--}}
                    {{--                        <a href="{{ route('login') }}" class="btn text-primary "> Sign in </a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </nav>
        <img class="shape" src="{{ asset('assets/images/others/shape2.svg') }}" alt="">
    </header>
    @yield('content')
</body>
</html>
