<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/import.css') }}">


    <!-- Typographie -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icones -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

</head>

<body class="header">

    <header>

        <div class="header-connexion">
            <div class="flex-row justify-left gap-nav2">
                @auth
                <p>Bienvenu, {{ Auth::user()->name }}</p>
                <a class="button__white" href="{{ route('login') }}">Mon compte</a>
                <a class="button" href="{{ route('logout') }}">Déconnexion</a>
                @else
                <button class="button" href="">Connexion</button>
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
                    <li><a href="">Mon cellier</a></li>
                    <li><a href="">Liste d'achats</a></li>
                    <li><a href="">Notes de dégustation</a></li>
                </ul>
            </div>

            <img
                class="icon"
                src="{{ asset('assets/images/searchicon.png') }}"
                alt="search" />


        </nav>



    </header>



    @yield ('content')
















    <footer id="footer-main">

        <div class="flex-row footer-gap justify-spacebetween">
            <section>
                <h2>Produit</h2>
                <ul class="footer-ul flex-column">
                    <li><a href="">Mon cellier</a></li>
                    <li><a href="">Liste d’achats</a></li>
                    <li><a href="">Notes de dégustation</a></li>
                    <li><a href="">S’enregistrer</a></li>
                    <li><a href="">Se connecter</a></li>
                </ul>
            </section>
            <section>
                <h2>Entreprise</h2>
                <ul class="footer-ul flex-column">
                    <li><a href="">À propos de Vino</a></li>
                    <li><a href="">Nous contacter</a></li>
                    <li><a href="">Rejoindre l’équipe</a></li>
                    <li><a href="">Notre culture</a></li>
                    <li><a href="">Infolettre</a></li>
                </ul>
            </section>
            <section>
                <h2>Support</h2>
                <ul class="footer-ul flex-column">
                    <li><a href="#">Commencer avec Vino</a></li>
                    <li><a href="">Centre d’aide</a></li>
                    <li><a href="">Signaler un problème</a></li>
                    <li><a href="">Assistance par chat</a></li>
                    <li><a href="">Questions fréquentes</a></li>
                </ul>
            </section>

        </div>


        <div class="socialNetwork footer-gap flex-row justify-center">
            <a href="https://www.facebook.com">
                <img class="icon" src="{{ asset('assets/images/facebook.png') }}" alt="Facebook" />
            </a>
            <a href="https://www.twitter.com">
                <img class="icon" src="{{ asset('assets/images/twitter.png') }}" alt="Twitter" />
            </a>
            <a href="https://www.instagram.com">
                <img class="icon" src="{{ asset('assets/images/insta.png') }}" alt="Instagram" />
            </a>
            <a href="https://www.youtube.com">
                <img class="icon" src="{{ asset('assets/images/youtube.png') }}" alt="YouTube" />
            </a>
        </div>

        <div class="flex-row footer-space justify-spacebetween ">
            <div>
                <img class="logo" src="{{ asset('assets/images/vinologo2.png') }}" alt="logo">

            </div>
            <span>© 2025 Vino Tous droits réservés</span>
        </div>

    </footer>




</body>

</html>