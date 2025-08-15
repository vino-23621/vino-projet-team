@extends('layouts.app')

@section('title', $bottle->name)

@section('content')
<div class="dualPanel">
    <div class="dualPanel-right">

        <div class="dual-panel-right-header">
            <a href="{{ url()->previous() }}" class="button button__soft">&larr; Retour</a>
        </div>

        <div class="dual-panel-right-content">
            <article class="card-bottle card-bottle--single">
                <img src="https://{{ $bottle['image'] }}" class="card-bottle-image" alt="{{ $bottle->name }}">

                <header class="card-bottle-header">
                    <h2>{{ $bottle->name }}</h2>
                    <div class="sub-header">
                        <div
                            @if ($bottle->identity->name === 'Vin rouge') class="wine-color-ico red"
                            @elseif ($bottle->identity->name === 'Vin blanc') class="wine-color-ico white"
                            @elseif ($bottle->identity->name === 'Vin rosé') class="wine-color-ico rose"
                            @elseif ($bottle->identity->name === 'Vin orange') class="wine-color-ico orange"
                            @endif
                            ></div>

                        <p>
                            {{ $bottle->identity->name }}
                            |
                            @if($bottle->vintage !== null) {{ $bottle->vintage }} @else Date non connue @endif
                        </p>
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
                            <h5 class="price-wine">$ {{ number_format($bottle->price, 2) }}</h5>
                            <p>CAD</p>
                        </div>

                        <form action="{{ route('catalog.addWineFromCatalog', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">

                            @isset($cellarId)
                            <input type="hidden" name="cellar_id" value="{{ $cellarId }}">
                            @endisset

                            <label for="quantity_cellar" class="sr-only">Quantité</label>
                            <input type="number" name="quantity" id="quantity_cellar" value="1" min="1">
                            <button type="submit" class="button addCellar">+ Ajouter au cellier</button>
                        </form>


                        <form action="{{ route('wishlist.addToWishList', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="users_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="bottles_id" value="{{ $bottle->id }}">

                            <label for="quantity_wishlist" class="sr-only">Quantité</label>
                            <input type="number" name="quantity" id="quantity_wishlist" value="1" min="1">
                            <button type="submit" class="button addCellar">+ Ajouter à la liste d’achats</button>
                        </form>
                    </section>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection