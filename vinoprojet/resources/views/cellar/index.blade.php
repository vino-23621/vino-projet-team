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
                <button class="button">Voir</button>
                <button class="openModalBtn button" data-id="{{$cellier->id}}">Supprimer</button>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Modal -->

    <div id="customModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h5>Effacer</h5>
            <p>Voulez vous effacer le cellier?</p>
            <div class="flex-row modal-buttons">
                <button type="button" class="button__white" id="closeModalBtn">Fermer</button>
                <form method="post" action="" id="deleteForm">
                    @method('delete')
                    @csrf
                    <button class="button" type="submit">Supprimer</button>
                </form>
            </div>
        </div>
    </div>






</main>
@endsection