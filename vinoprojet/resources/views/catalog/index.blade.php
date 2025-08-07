@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')

<div class="dualPanel">
    <div class="dualPanel-left">
        <div class="dual-panel-left-header">
            <h2>Catalogue des bouteilles</h2>
            <p class="profile-subtitle">Ajouter une bouteille dans votre cellier parmi une large gamme de produits</p>
        </div>
    </div>

    <div class="dualPanel-right">
        {{--
        <div class="dual-panel-right-header">
            <div class="cta-banner">
                <a href="{{ route('cellars.create') }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
        <div class="cta-banner-content">
            <h3>Catalogue des bouteilles</h3>
            <p>Commence une cave pour regrouper tes bouteilles à ta façon.</p>
        </div>
        <a href="{{ route('cellars.create') }}" class="button button__safe">Ajouter</a>
    </div>
</div>
--}}
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

                    <form action="{{ isset($cellarId) ? route('cellars.addBottle') : route('catalog.addWineFromCatalog', ['bottle' => $bottle->id]) }}" method="POST" class="inline-form">
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
                </section>
            </div>
        </article>
        @endforeach
    </div>
     <div class="dual-panel-right-footer">
        {!! $bottles->links('vendor.pagination.default') !!}
    </div>
</div>
</div>
</div>

@endsection