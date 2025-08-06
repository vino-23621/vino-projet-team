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
        {{-- <div class="dual-panel-right-header">
            <div class="cta-banner">
                <a href="{{ route('cellars.create') }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
                <div class="cta-banner-content">
                    <h3>Catalogue des bouteilles</h3>
                    <p>Commence une cave pour regrouper tes bouteilles à ta façon.</p>
                </div>
                <a href="{{ route('cellars.create') }}" class="button button__safe">Ajouter</a>
            </div>
        </div> --}}
        <div class="dual-panel-right-content">
            <div class="grid-card">
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
                            <form action="{{ route('cellars.addBottle') }}" method="POST" class="inline-form">
                                @csrf
                                <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="cellar_id" value="{{ $cellarId }}">
                                
                                <button type="submit" title="Ajouter au cellier" class="cellar-icon-btn">
                                    <i class="fa-solid fa-wine-bottle cellar-icon"></i>
                                </button>
                            </form>                      
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection