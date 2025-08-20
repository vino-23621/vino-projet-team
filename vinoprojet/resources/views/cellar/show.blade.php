@extends('layouts.app')

@section('title', 'Mon Cellier')

@section('content')


<div class="dualPanel ">
    <div class="dualPanel-left">
        <div class="dual-panel-left-header">
            <h2>{{$cellar->name}}</h2>
            <p class="profile-subtitle">Ajoutez une ou plusieurs bouteilles à votre cellier.</p>
        </div>
        <div class="dual-panel-left-content">
            <div class="filter-sidebar">
                <details class="filter-details">
                    <summary class="filter-summary">
                        <h3>Recherche Avancée</h3>
                        <span class="chevron" aria-hidden="true"></span>
                    </summary>

                    <form class="filter-searchBar" action="{{ route('cellars.show', $cellar->id) }}" method="GET">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher par nom"
                            class="filter-searchBar-input">
                        <button class="button button__filtersearch" type="submit">Rechercher
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
            @if($bottles->isEmpty())
            <div class="empty-cellar">
                <p>Aucune bouteille trouvée dans ce cellier.</p>
                <img src="{{ asset('assets/images/img-empty-cellar.png') }}" alt="Cellar vide">
            </div>
            @else

            <div class="grid-card">
                @foreach($bottles as $bottle)
                @if($bottle->pivot->quantity !== 0)
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

                        <div class="card-bottle-wishtlist-variation">
                            <form action="{{ route('cellars.updateQuantity', ['cellar' => $cellar->id, 'bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
                                <label for="quantity"></label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $bottle->pivot->quantity) }}" min="0" required>
                                <button type="submit" title="Ajouter au cellier" class="button addCellar">
                                    Modifier la quantité
                                </button>
                            </form>
                            <button class="openModalBtnBottle modalBtn button button__danger"" data-id="{{$bottle->id}}" data-cellar="{{$cellar->id}}">Retirer</button>
                        </div>

                        <div id="customModal" class="modal">
                            <div class="modal-content">
                                <h5>Retirer</h5>
                                <p>Voulez-vous retirer la bouteille ?</p>
                                <div class="flex-row modal-buttons">
                                    <button class="button button__safe close-btn" id="closeModalBtn">Fermer</button>
                                    <form method="post" action="" id="deleteForm">
                                        @method('delete')
                                        @csrf
                                        <button class="button button__danger" type="submit">Retirer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-bottle-footer">
                        <div class="comments">
                        
                            <a class="button-comments" href="{{ route('comment.form', ['cellar' => $cellar->id, 'bottle' => $bottle->id]) }}"><i class="fa-solid fa-comments"></i> Ajouter une note</a>
                        
                        <h5 class="comments-title">Notes:</h5>

                        @if($comments)
                        @foreach ($comments as $comment)
                        @foreach ($comment->bottles as $commentedBottle)
                        @if ($commentedBottle->id === $bottle->id)
                        <div class="container_comments">
                            <div class="comments-gray">
                                <p>{{ $comment->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="comments-flex">
                                <p>{{ $commentedBottle->pivot->comment }}</p>
                                <form action="{{ route('comments.destroy', ['comment' => $comment->id, 'bottle' => $commentedBottle->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="modalBtn suppBtn comments-gray" type="submit"><i class="fa-regular fa-trash-can"></i></button>
                                </form>


                            </div>

                        </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                        @endif

                    </div>
                </article>
                @endif
                @endforeach
            </div>
            @endif
        </div>
        <div class="dual-panel-right-footer">
            {!! $bottles->links('vendor.pagination.default') !!}
            <div class="cta-banner">
                <a href="{{ route('catalog.index', ['cellar_id' => $cellar->id]) }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
                <div class="cta-banner-content">
                    <h3>Ajoutez une nouvelle bouteille</h3>
                    <p>Étoffe votre catalogue avec de nouvelles bouteilles.</p>
                </div>
                <a href="{{ route('catalog.index', ['cellar_id' => $cellar->id]) }}" class="button button__safe">Ajouter</a>
            </div>
        </div>
    </div>
</div>

@endsection