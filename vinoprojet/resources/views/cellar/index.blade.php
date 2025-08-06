@extends('layouts.app')

@section('title', 'Celliers')

@section('content')


<div class="dualPanel">
        <div class="dualPanel-left">
            <div class="dual-panel-left-header">
                <h2>Celliers</h2>
                <p class="profile-subtitle">Crée un ou plusieurs celliers pour organiser tes bouteilles.</p>
            </div>
        </div>

        <div class="dualPanel-right">
            <div class="dual-panel-right-header">
               <div class="cta-banner">
                    <a href="{{ route('cellars.create') }}" class="cta-banner-icon"><i class="fa-solid fa-plus"></i></a>
                    <div class="cta-banner-content">
                        <h3>Ajoute un nouveau cellier</h3>
                        <p>Commence une cave pour regrouper tes bouteilles à ta façon.</p>
                    </div>
                    <a href="{{ route('cellars.create') }}" class="button button__safe">Ajouter</a>
               </div>
            </div>
            <div class="dual-panel-right-content">
                <div class="grid-card">
                    @foreach($cellars as $cellar)
                    @if (Auth::user()->cellar_id === $cellar->id)
                    <div class="card-cellar">
                        <div class="card-cellar-header">
                            <h4>{{ $cellar->name }}</h4>
                            <p>Crée le : {{ $cellar->created_at->format('Y-m-d') }}</p>
                        </div>
                        <form action="{{ route('user.cellar-default', $cellar->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="button button__defaultCellar"><i class="fa-solid fa-check"></i> Ce cellier est actif</button>
                        </form>
                        <div class="card-cellar-content">
                            <h5>Gère ton cellier</h4>
                            <p>Tu peux modifier son nom, voir son contenu ou le supprimer si besoin.</p>
                            <div>
                                <p><i class="fa-solid fa-pencil"></i> Édite le nom</p>
                                <a href="{{ route('cellars.show', $cellar->id) }}"><i class="fa-regular fa-eye"></i> Consulte les bouteilles</a>
                                <p><i class="fa-regular fa-trash-can"></i> Supprime ce cellier</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card-cellar">
                        <div class="card-cellar-header">
                            <h4>{{ $cellar->name }}</h4>
                            <p>Crée le : {{ $cellar->created_at->format('Y-m-d') }}</p>
                        </div>
                        <form action="{{ route('user.cellar-default', $cellar->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="button button__chooseCellar"><i class="fa-solid fa-check"></i> Définir par défaut</button>
                        </form>
                        <div class="card-cellar-content">
                            <h5>Gère ton cellier</h4>
                            <p>Tu peux modifier son nom, voir son contenu ou le supprimer si besoin.</p>
                            <div>
                                <p><i class="fa-solid fa-pencil"></i> Édite le nom</p>
                                <a href="{{ route('cellars.show', $cellar->id) }}"><i class="fa-regular fa-eye"></i> Consulte les bouteilles</a>
                                <p><i class="fa-regular fa-trash-can"></i> Supprime ce cellier</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
@endsection