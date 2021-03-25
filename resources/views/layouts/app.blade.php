<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/images/logo.png"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand mr-5" href="{{ url('/home') }}">MetroMed</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            @can('viewAny', \App\Market::class)
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/market" style="cursor: pointer; text-decoration: none; font-size: 14px;">Clients/marché</a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Client::class)
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/client-bon-de-commande" style="cursor: pointer; text-decoration: none; font-size: 14px;">Clients bon de commande</a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Ticket::class)
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/ticket" style="cursor: pointer; text-decoration: none; font-size: 14px;">Interventions</a>
                                </li>
                            @endcan
                            @can('viewAny', \App\EquipementStock::class)
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/stock" style="cursor: pointer; text-decoration: none; font-size: 14px;">Stock</a>
                                </li>
                            @endcan
                            @if(Auth::User()->role == 'admin')
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/home-stock" style="cursor: pointer; text-decoration: none; font-size: 14px;">Bons/cal</a>
                                </li>
                            @endif
                            @can('viewAny', \App\Bon::class)
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="/bon" style="cursor: pointer; text-decoration: none; font-size: 14px;">Bons</a>
                                </li>
                            @endcan
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::User()->role == 'admin')
                                        <a class="dropdown-item" href="/user/{{ Auth::User()->id }}/history" style="cursor: pointer;">Mon historique</a>
                                    @endif
                                    <a class="dropdown-item" data-toggle="modal" data-target="#settings" style="cursor: pointer;">Paramètres</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Se déconnecter</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @include('layouts.choix')
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
