@extends('layouts.app')

@section('title', 'Mon Cellier')

@section('content')


<div class="dualPanel">
    <div class="dualPanel-left">
        <div class="dual-panel-left-header">
            <h2>{{$cellar->name}}</h2>
            <p class="profile-subtitle">Crée un ou plusieurs celliers pour organiser tes bouteilles.</p>
        </div>
    </div>

    <div class="dualPanel-right">
        <div class="dual-panel-right-header">
            <div class="cta-banner">
                <a href="{{ route('catalog.index', ['cellar_id' => $cellar->id]) }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
                <div class="cta-banner-content">
                    <h3>Ajoute une nouvelle bouteille</h3>
                    <p>Étoffe ton catalogue avec de nouveaux ajouts.</p>
                </div>
                <a href="{{ route('catalog.index', ['cellar_id' => $cellar->id]) }}" class="button button__safe">Ajouter</a>
            </div>
        </div>
        <div class="dual-panel-right-content">
            <div class="grid-card">
                @foreach($bottles as $bottle)
                <div class="flex-row">
                    <img src="https://{{ $bottle->image }}" alt="{{ $bottle->name }}" style="max-width:100px;">

                    <div>
                        <h5 class="">{{ $bottle->name }}</h5>
                        <p>Quantité: {{ $bottle->pivot->quantity }}</p>
                        <p>Prix: {{ $bottle->price }}</p>
                        <p> Couleur: {{ $bottle->identity->name }}</p>
                        <p>Pays: {{ $bottle->country->name }}</p>
                        <p>volume: {{ $bottle->size }} ml</p>


                        <label for="deleteModal-{{ $bottle->id }}" class="cellar-icon" title="Supprimer">
                            <i class="fa-solid fa-trash"></i>
                        </label>

                        <input type="checkbox" id="deleteModal-{{ $bottle->id }}" class="modalUser-toggle" hidden>

                        <div class="modalUser">
                            <div class="modalUser-box">
                                <p>Voulez-vous supprimer cette bouteille du cellier ?</p>
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
        </div>
        <div class="dual-panel-right-footer">
            <div class="pagination-wrapper">
                {{ $bottles->links() }}
            </div>
        </div>
    </div>

    @endsection