@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')

<main class="catalog-main">


    <div class="infos">
        <h3>Le Catalogue</h3>

    </div>

    <div class="card-bottle-container grilles">
        @foreach($bottles as $bottle)
        <div class="card-bottle">
            <img src="https://{{$bottle['image'] }}" class="card-bottle-image">

            <div class="card-bottle-content ">
                <h3 class="card-bottle-title">{{ $bottle->name }}</h3>
                <p> Couleur: {{ $bottle->identity->name }}</p>
                <p>Vintage: {{ $bottle->vintage }}</p>
            </div>

            <div class="card-bottle-content">
                <div>
                    <h3>Détails</h3>
                    <p>Pays: {{ $bottle->country->name }}</p>
                    <p>volume: {{ $bottle->size }} ml</p>
                </div>

                <div>
                    <h3>Prix</h3>
                    <p>{{ $bottle->price }} CAD</p>
                    <form action="{{ route('cellars.addBottle', ['cellar' => $cellar->id]) }}" method="POST" class="inline-form">
                        @csrf
                        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" title="Ajouter au cellier" class="cellar-icon-btn">
                            <i class="fa-solid fa-wine-bottle cellar-icon"></i>
                        </button>
                    </form>


                </div>
            </div>
        </div>
        @endforeach
    </div>

</main>

@endsection