<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/import.css') }}">
</head>

<body class="header">

    <header>

        <div class="header-connexion">
            <div class="flex-row">

                <button class="bouton-white" href="">Mon compte</button>
                <button class="bouton-mauve" href="">Déconnexion</button>
                <div class="header-p">
                    <p>langue</p>
                </div>
            </div>

        </div>


        <nav class="header-nav">

            <img
                class=""
                src=""
                alt="logovino" />

            <ul class="flex-row">
                <li><a href="">Mon cellier</a></li>
                <li><a href="">Liste d'achats</a></li>
                <li><a href="">Notes de dégustation</a></li>
            </ul>

            <img
                class=""
                src=""
                alt="search" />


        </nav>



    </header>



    @yield ('content')
















    <footer id="footer-main">
        <section>
            <h2>Produit</h2>
            <ul>
                <li><a href="">Mon cellier</a></li>
                <li><a href="">Liste d’achats</a></li>
                <li><a href="">Notes de dégustation</a></li>
                <li><a href="">S’enregistrer</a></li>
                <li><a href="">Se connecter</a></li>
            </ul>
        </section>
        <section>
            <h2>Entreprise</h2>
            <ul>
                <li><a href="">À propos de Vino</a></li>
                <li><a href="">Nous contacter</a></li>
                <li><a href="">Rejoindre l’équipe</a></li>
                <li><a href="">Notre culture</a></li>
                <li><a href="">Infolettre</a></li>
            </ul>
        </section>
        <section>
            <h2>Support</h2>
            <ul>
                <li><a href="">Commencer avec Vino</a></li>
                <li><a href="">Centre d’aide</a></li>
                <li><a href="">Signaler un problème</a></li>
                <li><a href="">Assistance par chat</a></li>
                <li><a href="">Questions fréquentes</a></li>
            </ul>
        </section>
        <div class="socialNetwork">
            <a href="">Facebook</a>
            <a href="">Twitter</a>
            <a href="">Youtube</a>
            <a href="">Instagram</a>
        </div>
        <aside>
            <div>
                <img src="" alt="icon glass of vine">
                <a href="#">Vino</a>
            </div>
            <span>© 2025 Vino Tous droits réservés</span>
        </aside>
    </footer>




</body>

</html>
