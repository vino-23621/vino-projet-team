@extends('layouts.app')

@section('title', 'Cellier Show')

@section('content')

<main>

    @if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    <div class="info">
        <h4>{{$cellar->name}}</h4>
        <div class="flex-row">
            <p>C’est ici que tu retrouveras tes bouteilles.</p>
            <a class="button" href="{{ route('catalog.index') }}">Ajouter une bouteille</a>
        </div>
    </div>


    @if($cellar->bottles->isEmpty())
    <p>Aucune bouteille dans ce cellier.</p>
    @else
    <div class="bottle-list">
        @foreach($cellar->bottles as $bottle)
        <div class="flex-row">
            <img src="https://{{ $bottle->image }}" alt="{{ $bottle->name }}" style="max-width:100px;">

            <div>
                <h5 class="">{{ $bottle->name }}</h5>
                <p>Quantité: {{ $bottle->pivot->quantity }}</p>
                <p>Prix: {{ $bottle->price }}</p>
                <p> Couleur: {{ $bottle->identity->name }}</p>
                <p>Pays: {{ $bottle->country->name }}</p>
                <p>volume: {{ $bottle->size }} ml</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</main>


@endsection