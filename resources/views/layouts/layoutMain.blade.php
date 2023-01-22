<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
<header>

<img src="https://www.chollometro.com/assets/img/logo-dark_efa02.png">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Ganga ░▒▓ Severa</span>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/ganga" class="m-2 text-white text-decoration-none">Inicio</a>
                </li>
                <li>
                    <a href="{{route('ganga.news')}}" class="m-2 text-white text-decoration-none">Nuevos</a>
                </li>
                <li>
                    <a href="{{route('ganga.highlights')}}" class="m-2 text-white text-decoration-none">Destactas</a>
                </li>
            </ul>
        </div>
        @if(Auth::check())
            <p class="m-2 text-white text-decoration-none">Registrado como: {{ Auth::user()->name }}</p>
            <a href="{{ route('logout') }}" class="m-2 text-white text-decoration-none">Log out</a>
        @endif
        @if(!Auth::check())
            <a href="{{ route('login') }}" class="m-2 text-white text-decoration-none">Log in</a>
            <a href="{{ route('register') }}" class="m-2 text-white text-decoration-none">Registrarse</a>
        @endif
    </div>
</nav>

</header>

<main>
    @yield('contenido')
    @extends('layouts.footer')
</main>

</body>


