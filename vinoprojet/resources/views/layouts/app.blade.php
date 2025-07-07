<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} - @yield('title')</title>
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





















</body>

</html>