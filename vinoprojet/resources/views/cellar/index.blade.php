@extends('layouts.app')

@section('title', 'Celliers')

@section('content')


<main class="cellar-main">


    <div class="info">
        <h4>Mes Celliers</h4>
        <p>C’est ici que tu retrouveras tous les celliers que tu as créés. Organise tes bouteilles à ta façon, selon tes envies, ton espace ou les moments que tu veux célébrer.</p>
        <a class="button" href="{{ route('cellars.create') }}">Créer un cellier</a>
    </div>




    <div class="cards-cellar-container grille">

        @foreach($cellar as $cellier)
        <div class="card-cellar">
            <img src="{{ asset('storage/cellar_images/' . $cellier->image) }}" class="card-cellar-image">
            <div class="card-cellar-content">
                <h3 class="card-cellar-title">{{ $cellier->name }}</h3>
                <p class="card-cellar-date">Créé le: {{ $cellier->created_at->format('Y-m-d') }}</p>
                <a class="button" href="">Voir</a>
                <a class="button" href="">Supprimer</a>
            </div>
        </div>
        @endforeach



</main>
@endsection