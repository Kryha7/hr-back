<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hyperaffle') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Hyperaffle') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-item"><a href="{{route('login.facebook')}}" class="nav-link"><button class="btn btn-outline-primary">Login with Facebook</button></a></li>
                        {{--<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>--}}
                        {{--<li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>--}}
                    @else
                        <li class="nav-item"><a href="{{route('tickets')}}" class="nav-link">{{ Auth::user()->tickets }} tickets</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>
        <div class="nav-scroller bg-dark box-shadow">
            <nav class="nav nav-underline justify-content-md-center">
                <a class="nav-link active" href="{{route('dashboard')}}">Dashboard</a>
                <a class="nav-link" href="{{route('raffle.index')}}">Raffles</a>
                <a class="nav-link" href="{{route('pool.index')}}">Pools</a>
                <a class="nav-link" href="{{route('transactions')}}">Transactions</a>
                <a class="nav-link" href="{{route('users')}}">Users</a>
                <a class="nav-link" href="{{route('raffle.create')}}">Create raffle</a>
                <a class="nav-link" href="{{route('pool.create')}}">Create pool</a>
            </nav>
        </div>

    @yield('content')

    <div class="container">
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="{{asset('img/hyperaffle.svg')}}" alt="Hyperaffle" height="24">

                    <small class="d-block mb-3 text-muted">made with <span style="color: #bb2222">&#x2764;</span> © 2018</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Social media</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Instagram</a></li>
                        <li><a class="text-muted" href="#">Facebook</a></li>
                        <li><a class="text-muted" href="#">Youtube</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Newsletter</a></li>
                        <li><a class="text-muted" href="#">Blog</a></li>
                        <li><a class="text-muted" href="#">Media</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
