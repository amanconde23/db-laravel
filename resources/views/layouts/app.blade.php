<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AcheiAqui') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('site/jquery.js') }}" defer></script>
    <script src="{{ asset('site/bootstrap.js') }}" defer></script>
    <script src="{{ asset('site/main.js') }}" defer></script>
    <script src="{{ asset('site/jquery.mask.min.js') }}" defer></script>
    <script src="{{ asset('site/jquery.validate.min.js') }}" defer></script>
    <script src="{{ asset('site/sweetalert2.all.min.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&family=Poppins:wght@300;500&display=swap" rel="stylesheet">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/a0b66fbad1.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('site/style.css') }}" rel="stylesheet">
    <link href="{{ asset('site/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav id="navbar-header" class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'AcheiAqui') }}
                </a>
                <button class="navbar-toggler line" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link nav-link-header" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-header" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown home-navbar-logado">
                                @if (Auth::user()->usertype === 'admin')
                                    <a class="nav-link nav-link-header home-navbar-link" href="{{ url('painel-admin') }}">Painel do Admin</a>
                                @endif
                                <a class="nav-link nav-link-header home-navbar-link" href="{{ url('painel-usuario') }}">Painel do Usuário</a>

                                <a id="navbarDropdown" class="nav-link nav-link-header dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Olá, {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="conteudo">
            @yield('content')
            @include('sweetalert::alert')
        </main>

        <footer>
            <p>Desenvolvido por Amanda Martinez</p>
            <p class="copyright-img">Créditos da imagem: <a class="copyright-img-link" href="http://www.freepik.com" target="_blank">Designed by pikisuperstar / Freepik</a></p>
        </footer>
    </div>
</body>
</html>
