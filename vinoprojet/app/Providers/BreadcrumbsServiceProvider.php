<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Page d'accueil (assumant que vous avez une route home)
        Breadcrumbs::for('home', fn (Trail $trail) =>
            $trail->push('Accueil', route('home'))
        );

        // Routes d'authentification
        Breadcrumbs::for('login', fn (Trail $trail) =>
            $trail
                ->parent('home')
                ->push('Connexion', route('login'))
        );

        // Routes utilisateur
        Breadcrumbs::for('user.create', fn (Trail $trail) =>
            $trail
                ->parent('home')
                ->push('Inscription', route('user.create'))
        );

        Breadcrumbs::for('user.show', fn (Trail $trail) =>
            $trail
                ->parent('home')
                ->push('Mon Profil', route('user.show'))
        );

        Breadcrumbs::for('user.edit-name', fn (Trail $trail, $user) =>
            $trail
                ->parent('user.show')
                ->push('Modifier le nom', route('user.edit-name', $user))
        );

        Breadcrumbs::for('user.edit-password', fn (Trail $trail, $user) =>
            $trail
                ->parent('user.show')
                ->push('Modifier le nom', route('user.edit-password', $user))
        );
    }
}
