@extends('layouts.app')

@section('title', 'Ma Liste de Souhaits')

@section('content')


<div class="dualPanel ">
    <div class="dualPanel  filter-sidebar">
        <div class="dualPanel-left">
            <div class="dual-panel-left-header">
                <h2>Ma Liste d'Achats</h2>
                <p class="profile-subtitle">Savoir les bouteilles qui vous manquent à vos celliers.</p>
            </div>
            <div class="dual-panel-left-content">
                <details class="filter-details" open>
                    <summary class="filter-summary">
                        <h3>Recherche Avancée</h3>
                        <span class="chevron" aria-hidden="true"></span>
                    </summary>

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

                        <input type="number" name="vintage_min" placeholder="Date min" value="{{ request('vintage_min') }}">
                        <input type="number" name="vintage_max" placeholder="Date max" value="{{ request('vintage_max') }}">
                        <input type="number" name="price_min" placeholder="Prix min" value="{{ request('price_min') }}">
                        <input type="number" name="price_max" placeholder="Prix max" value="{{ request('price_max') }}">

                        <button type="submit">Filtrer</button>
                    </form>
                </details>
            </div>
        </div>

    </div>
    <div class="dualPanel-right">
        <div class="dual-panel-right-header">
            <div>
                <form method="GET">
                    <select name="sort">
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

                    <button type="submit">Trier</button>
                </form>
            </div>
        </div>
        <div class="dual-panel-right-content">
            @if($bottles->isEmpty())
            <p>Aucune bouteille trouvée dans ce cellier.</p>
            @else

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
                                @endif></div>
                            <p>{{ $bottle->identity->name }} | @if($bottle->vintage !== null) {{ $bottle->vintage }} @else Date non connu @endif</p>
                        </div>
                    </header>

                    <div class="card-bottle-content">
                        <section>
                            <h3 class="subtitle-wines">Détails</h3>
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
                        </section>
                    </div>

                    <form action="{{ route('wishlist.updateQuantity', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
                        <label for="quantity"></label>

                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $bottle->quantity) }}" min="0" required>
                        <button type="submit" title="Ajouter au cellier" class="button addCellar">
                            Changer la quantité
                        </button>
                    </form>

                    <form action="{{ route('wishlist.removeBottle', $bottle->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button button__danger">Retirer</button>
                    </form>

                </article>
                @endforeach

            </div>
            @endif
        </div>
        <div class="dual-panel-right-footer">
            <div class="cta-banner">
                <a href="{{ route('catalog.index') }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
                <div class="cta-banner-content">
                    <h3>Ajoute une nouvelle bouteille</h3>
                    <p>Étoffe ton catalogue avec de nouveaux ajouts.</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="button button__safe">Ajouter</a>
            </div>
        </div>
    </div>
</div>




@endsection