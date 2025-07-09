@extends('layouts.app')

@section('title', 'Celliers')

@section('content')

<div class="text-align-center ">

    <a class="button" href="{{ route('cellars.create') }}">Créer un cellier</a>

</div>


<div class="cards-cellar-container">
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
</div>





@endsection