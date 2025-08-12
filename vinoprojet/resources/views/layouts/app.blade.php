<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/import.css') }}">
    <script type="module" src="{{ asset('js/cellar-modal.js') }}"></script>
    <script type="module" src="{{ asset('js/cellar-modal-edit.js') }}"></script>
    <script type="module" src="{{ asset('js/bottle-modal.js') }}"></script>
    <script type="module" src="{{ asset('js/banner-success.js') }}"></script>
    <script type="module" src="{{ asset('js/login_validation.js') }}"></script>



    <!-- Typographie -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icones -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

</head>

<body>

    <nav id="nav-main">

        <div class="nav-main-account">
            <div>
                @auth
                <p>Bienvenue, {{ Auth::user()->name }}</p>
                <p>Cellier : {{ Auth::user()->defaultCellar->name }}</p>

                <!-- <p>
                    Cellier actif:
                    {{ Auth::user()->getActiveCellar()?->name ?? Auth::user()->defaultCellar()?->name ?? 'Aucun cellier actif' }}
                </p> -->

                <a class="button__white" href="{{ route('user.show') }}">Mon compte</a>
                <a class="button" href="{{ route('logout') }}">Déconnexion</a>
                @else
                <a class="button" href="{{ route('login') }}">Connexion</a>
                @endauth
            </div>
        </div>
        <div class="nav-main-links">
            <div>
                <a href="#"><img class="logo"
                        src="{{ asset('assets/images/vinologo.png') }}"
                        alt="logovino" /></a>
                <a href="{{route('cellars.index')}}">Mes celliers</a>
                <a href="{{route('wishlist.index')}}">Liste d'achat</a>
                <a href="{{route('catalog.index')}}">Catalogue des vins</a>
                <form action="{{ route('catalog.index') }}" method="GET" class="mb-4">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par nom de la bouteille"
                        class="form-control input-search">
                    <button type="submit" class="button-search">
                        <i class="fa-solid fa-magnifying-glass icon-search "></i>
                    </button>

                </form>
            </div>
        </div>



    </nav>

    @if (session('success'))
    <div class="cta-success-banner">
        <span class="close-btn">&times;</span>
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="cta-error-banner">
        <span class="close-btn">&times;</span>
        {{ session('error') }}
    </div>
    @endif



    <main>
        @yield ('content')
    </main>


    <footer id="footer-main">
        <div>
            <img class="logo" src="{{ asset('assets/images/vinologo-color.png') }}" alt="logo">
            <span>© 2025 Vino Tous droits réservés</span>
        </div>
    </footer>
</body>

</html>