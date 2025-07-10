<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/import.css') }}">
    <script type="module" src="{{ asset('js/cellar-modal.js') }}"></script>


    <!-- Typographie -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icones -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

</head>

<body class="header">

    <header>

        <div class="header-connexion">
            <div class="flex-row justify-left gap-nav2">
                @auth
                <p>Bienvenu, {{ Auth::user()->name }}</p>
                <a class="button__white" href="{{ route('user.show') }}">Mon compte</a>
                <a class="button" href="{{ route('logout') }}">Déconnexion</a>
                @else
                <a class="button" href="{{ route('login') }}">Connexion</a>
                @endauth
            </div>

        </div>


        <nav class="header-nav flex-row justify-spacebetween ">

            <div class="flex-row gap-nav">
                <img
                    class="logo"
                    src="{{ asset('assets/images/vinologo.png') }}"
                    alt="logovino" />
                <ul class="flex-row gap-nav2">
                    <li><a href="{{route('cellars.index')}}">Mon cellier</a></li>
                    <!-- <li><a href="">Liste d'achats</a></li>
                    <li><a href="">Notes de dégustation</a></li> -->
                </ul>
            </div>

            <!-- <img
                class="icon"
                src="{{ asset('assets/images/searchicon.png') }}"
                alt="search" /> -->


        </nav>



    </header>
    @if(Breadcrumbs::has())
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            @foreach (Breadcrumbs::current() as $crumbs)
            @if ($crumbs->url() && !$loop->last)
            <li class="breadcrumb-item">
                <a href="{{ $crumbs->url() }}">
                    {{ $crumbs->title() }}
                </a>
            </li>
            @else
            <li class="breadcrumb-item active" aria-current="page">
                {{ $crumbs->title() }}
            </li>
            @endif
            @if (!$loop->last)
            <span class="breadcrumb-separator">></span>
            @endif
            @endforeach
        </ul>
    </nav>
    @endif


    @yield ('content')


    <footer id="footer-main">
        <div class="flex-row footer-space justify-spacebetween ">
            <div>
                <img class="logo" src="{{ asset('assets/images/vinologo-color.png') }}" alt="logo">
            </div>
            <span>© 2025 Vino Tous droits réservés</span>
        </div>

    </footer>
</body>
</html>