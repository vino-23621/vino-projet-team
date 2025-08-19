@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')



<div class="dualPanel">
    <div class="dualPanel-left">
        <div class="dual-panel-left-header">
            <h2>Catalogue des bouteilles</h2>
            <p class="profile-subtitle">Ajoutez une bouteille à votre cellier, parmi une large gamme de produits.</p>
        </div>
        <div class="dual-panel-left-content">
            <div class="filter-sidebar">
                <details class="filter-details">
                    <summary class="filter-summary">
                        <h3>Recherche Avancée</h3>
                        <span class="chevron" aria-hidden="true"></span>
                    </summary>
                    
                    <form class="filter-searchBar" action="{{ route('catalog.index') }}" method="GET">
                        <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par nom"
                        class="filter-searchBar-input">
                        <button class="button button__defaultCellar" type="submit">Rechercher
                        </button>
                    </form>
                    <form method="GET" class="filter-form">
                        <select name="country">
                            <option value="">Tous les pays</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>
                        <select name="identity">
                            <option value="">Toutes les variétés</option>
                            @foreach($identities as $identity)
                            <option value="{{ $identity->id }}" {{ request('identity') == $identity->id ? 'selected' : '' }}>
                                {{ $identity->name }}
                            </option>
                            @endforeach
                        </select>
                        <label>
                            <input type="checkbox" name="vintage_null" value="1" {{ request('vintage_null') ? 'checked' : '' }}>
                            Sans millésime
                        </label>
                        <input type="number" name="vintage_min" placeholder="Année minimum" value="{{ request('vintage_min') }}">
                        <input type="number" name="vintage_max" placeholder="Année maximum" value="{{ request('vintage_max') }}">
                        <input type="number" name="price_min" placeholder="Prix minimum" value="{{ request('price_min') }}">
                        <input type="number" name="price_max" placeholder="Prix maximum" value="{{ request('price_max') }}">
                        <button type="submit">Filtrer</button>
                    </form>
                    
                </details>
            </div>
        </div>
    </div>
    <div class="dualPanel-right">
        
        <div class="dual-panel-right-header">
            <div class="sort-container">
                <form method="GET">
                    <select name="sort" class="sort-select">
                        <option value="">Aucun tri</option>
                        <option value="vintage_asc" {{ request('sort') == 'vintage_asc' ? 'selected' : '' }}>Millésime (ancien → récent)</option>
                        <option value="vintage_desc" {{ request('sort') == 'vintage_desc' ? 'selected' : '' }}>Millésime (récent → ancien)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix (bas → haut)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix (haut → bas)</option>
                        <option value="country_asc" {{ request('sort') == 'country_asc' ? 'selected' : '' }}>Pays (A → Z)</option>
                        <option value="country_desc" {{ request('sort') == 'country_desc' ? 'selected' : '' }}>Pays (Z → A)</option>
                    </select>

                    <input type="hidden" name="country" value="{{ request('country') }}">
                    <input type="hidden" name="identity" value="{{ request('identity') }}">
                    <input type="hidden" name="vintage_null" value="{{ request('vintage_null') }}">
                    <input type="hidden" name="vintage_min" value="{{ request('vintage_min') }}">
                    <input type="hidden" name="vintage_max" value="{{ request('vintage_max') }}">
                    <input type="hidden" name="price_min" value="{{ request('price_min') }}">
                    <input type="hidden" name="price_max" value="{{ request('price_max') }}">

                    <button class="sort-button" type="submit">Trier</button>
                </form>
            </div>
        </div>
            <div class="dual-panel-right-content">
                <div class="grid-card">
                    @foreach($bottles as $bottle)
                    
                    <article class="card-bottle">
                        <img src="https://{{ $bottle['image'] }}" class="card-bottle-image">
                        
                        <header class="card-bottle-header">
                            <h4>{{ $bottle->name }}</h4>
                            <div class="sub-header">
                                <div
                                @if ($bottle->identity->name === 'Vin rouge') class="wine-color-ico red"
                                @elseif ($bottle->identity->name === 'Vin blanc') class="wine-color-ico white"
                                @elseif ($bottle->identity->name === 'Vin rosé') class="wine-color-ico rose"
                                @elseif ($bottle->identity->name === 'Vin orange') class="wine-color-ico orange"
                                @elseif ($bottle->identity->name === 'Vin mousseux') class="wine-color-ico sparkling"
                                @elseif ($bottle->identity->name === 'Champagne') class="wine-color-ico champagne"
                                @elseif ($bottle->identity->name === 'Champagne rosé') class="wine-color-ico champagneRose"
                                @elseif ($bottle->identity->name === 'Vin mousseux rosé') class="wine-color-ico sparkingRose"
                                @elseif ($bottle->identity->name === 'Vin de dessert') class="wine-color-ico dessert"
                                @elseif ($bottle->identity->name === 'Vin de tomate') class="wine-color-ico tomate"
                                @endif></div>
                                <p>{{ $bottle->identity->name }} | @if($bottle->vintage !== null) {{ $bottle->vintage }} @else Date non connue @endif</p>
                            </div>
                        </header>
                        
                        <div class="card-bottle-content">
                            <section>
                                <div class="container-win-details">
                                    <h3 class="subtitle-wines">Détails</h3>
                                    <a href="{{ route('bottle.show', $bottle->id) }}"><i class="fa-regular fa-eye"></i> Plus</a>
                                </div>
                                <div class="content-details">
                                    <p>{{ $bottle->country->name }}</p>
                                    <p class="bottle-size-ml">{{ $bottle->size }} ml</p>
                                </div>
                            </section>
                            <section>
                                <div class="section-price">
                                    <h5 class="price-wine">$ {{ $bottle->price }}</h5>
                                    <p>CAD</p>
                                </div>
                                
                                <form class="card-bottle-add" action="{{ isset($cellarId) ? route('cellars.addBottle') : route('catalog.addWineFromCatalog', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                                    @csrf
                                    
                                    
                                    <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
                                    
                                    
                                    
                                    @if(isset($cellarId))
                                    <input type="hidden" name="cellar_id" value="{{ $cellarId }}">
                                    @endif
                                    
                                    <label for="quantity"></label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1">
                                    
                                    <button type="submit" title="Ajouter au cellier" class="button addCellar">
                                        + Ajouter au cellier
                                    </button>
                                    
                                </form>
                                
                                <!-- Formulaire ajout à la wishlist -->
                                
                                <form class="card-bottle-add" action="{{ route('wishlist.addToWishList', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                                    @csrf
                                    
                                    <input type="hidden" name="users_id" value="{{ auth()->id() }}">
                                    
                                    <input type="hidden" name="bottles_id" value="{{ $bottle->id }}">
                                    
                                    <label for="quantity"></label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1">
                                    
                                    <button type="submit" title="Ajouter à la wishlist" class="button addCellar">
                                        + Ajouter à la liste d’achats
                                    </button>
                                </form>
                            </section>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            <div class="dual-panel-right-footer">
                {!! $bottles->links('vendor.pagination.default') !!}
                <div class="cta-banner">
                    <a href="{{ route('cellars.create') }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
                    <div class="cta-banner-content">
                        <h3>Catalogue des bouteilles</h3>
                        <p>Commencez un cellier pour regrouper vos bouteilles à votre façon.</p>
                    </div>
                    <a href="{{ route('cellars.create') }}" class="button button__safe">Ajouter</a>
                </div>
            </div>
    </div>
    
    @endsection