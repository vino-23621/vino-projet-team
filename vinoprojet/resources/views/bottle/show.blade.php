@extends('layouts.app')

@section('title', $bottle->name)

@section('content')
<div class="dualPanel">
    <div class="dualPanel-right">

        <div class="dual-panel-right-header">
            <a href="{{ url()->previous() }}">&larr; Retour en arrière</a>
        </div>

        <div class="dual-panel-right-content">
            <article class="card-bottle-show">
                <img src="https://{{ $bottle['image'] }}" class="card-bottle-show-image" alt="{{ $bottle->name }}">

                <header class="card-bottle-show-header">
                    <h3>{{ $bottle->name }}</h3>
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

                        <p>
                            {{ $bottle->identity->name }}
                            |
                            @if($bottle->vintage !== null) {{ $bottle->vintage }} @else Date non connue @endif
                        </p>
                    </div>
                </header>

                <div class="card-bottle-show-content">
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
                        <div class="card-bottle-show-details">
                            <div class="card-bottle-show-details-content">
                                <p>Taux de sucre: </p>
                                <p>{{$bottle->sugar}} g/L</p>
                            </div>
                            <div class="card-bottle-show-details-content">
                                <p>Taux d'alcool: </p>
                                <p>{{$bottle->alcohol_percentage}} %</p>
                            </div>
                            <div class="card-bottle-show-details-content">
                                <p>Appellation: </p>
                                <p>{{$bottle->appellation}}</p>
                            </div>
                            <div class="card-bottle-show-details-content">
                                <p>Cépages: </p>
                                <p>{{ is_array($bottle->grape_variety) ? implode(', ', $bottle->grape_variety) : $bottle->grape_variety }}</p>
                            </div>
                        </div>


                        <form class="card-bottle-show-add" action="{{ route('catalog.addWineFromCatalog', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">

                            @isset($cellarId)
                            <input type="hidden" name="cellar_id" value="{{ $cellarId }}">
                            @endisset

                            <label for="quantity_cellar" class="sr-only">Quantité</label>
                            <input type="number" name="quantity" id="quantity_cellar" value="1" min="1">
                            <button type="submit" class="button addCellar">+ Ajouter au cellier</button>
                        </form>


                        <form class="card-bottle-show-add" action="{{ route('wishlist.addToWishList', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
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
