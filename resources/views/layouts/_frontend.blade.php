<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>{!! config('app.name') !!}</title>

    @yield('styles')
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav w-100">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="ml-auto">

                        @can('tasks')
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Tasks</a>
                        </li>
                        @endcan

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ auth()->user()->username }} </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                @if(auth()->user()->type == "admin")
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a>
                                @endif
                                <a href="{{ route('billing') }}" class="dropdown-item">Billing</a>
                                <a href="{{ url('/logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-lock"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</nav>
<div style="padding-top: 80px;">
    @if(auth()->check() && auth()->user()->trial_ends_at)
        <div class="alert alert-info text-center">
            You have {{ now()->diffInDays(auth()->user()->trial_ends_at) }} days of free trial left. <a href="{{ route('billing') }}">Choose your plan</a> at any time.
        </div>
    @endif
    @yield('content')
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

@stack('scripts')
</body>
</html>
