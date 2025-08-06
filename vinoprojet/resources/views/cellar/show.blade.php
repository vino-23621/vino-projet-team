@extends('layouts.app')

@section('title', 'Cellier Show')

@section('content')
<main>
    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    <div class="info">
        <h4>{{ $cellar->name }}</h4>
        <div class="flex-row">
            <p>C’est ici que tu retrouveras tes bouteilles.</p>
            <a class="button" href="{{ route('catalog.index', ['cellar_id' => $cellar->id]) }}">
                Ajouter une bouteille
            </a>
        </div>
    </div>

    @if($bottles->isEmpty())
    <p>Aucune bouteille dans ce cellier.</p>
    @else
    <div class="bottle-list">
        @foreach($bottles as $bottle)
        <div class="flex-row">
            <img src="https://{{ $bottle->image }}" alt="{{ $bottle->name }}" style="max-width:100px;">
            <div>
                <h5>{{ $bottle->name }}</h5>
                <p>Quantité: {{ $bottle->pivot->quantity }}</p>
                <p>Prix: {{ $bottle->price }}</p>
                <p>Couleur: {{ $bottle->identity->name }}</p>
                <p>Pays: {{ $bottle->country->name }}</p>
                <p>Volume: {{ $bottle->size }} ml</p>

                <label for="deleteModal-{{ $bottle->id }}" class="cellar-icon" title="Supprimer">
                    <i class="fa-solid fa-trash"></i>
                </label>
                <input type="checkbox" id="deleteModal-{{ $bottle->id }}" hidden>
                <div class="modalUser">
                    <div class="modalUser-box">
                        <p>Voulez-vous supprimer cette bouteille du cellier&nbsp;?</p>
                        <div>
                            <form action="{{ route('cellars.removeBottle', ['cellar' => $cellar->id, 'bottle' => $bottle->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button__danger">Supprimer</button>
                            </form>
                            <label for="deleteModal-{{ $bottle->id }}" class="button button__safe">Annuler</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $bottles->links() }}
    </div>
    @endif
</main>
@endsection