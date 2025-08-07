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
                @if($bottle->pivot->quantity !== 0)
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
                        </section>

                        <form action="{{ route('cellars.updateQuantity', ['cellar' => $cellar->id, 'bottle' => $bottle->id]) }}" method="POST" class="inline-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
                            <label for="quantity"></label>
                            
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $bottle->pivot->quantity) }}" min="0" required>
                            <button type="submit" title="Ajouter au cellier" class="button addCellar">
                                Changer la quantité
                            </button>
                        </form>

                        <button class="openModalBtnBottle modalBtn" data-id="{{$bottle->id}}" data-cellar="{{$cellar->id}}"><i class="fa-regular fa-trash-can"></i> Retirer la bouteille</button>

                        <div id="customModal" class="modal">
                            <div class="modal-content">
                                <h5>Retirer</h5>
                                <p>Voulez vous retirer la bouteille?</p>
                                <div class="flex-row modal-buttons">
                                    <button class="button button__safe close-btn" id="closeModalBtn">Fermer</button>
                                    <form method="post" action="" id="deleteForm">
                                        @method('delete')
                                        @csrf
                                        <button class="button button__danger" type="submit">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </article>
                @endif
                @endforeach
            </div>
        </div>
          <div class="dual-panel-right-footer">
            {!! $bottles->links('vendor.pagination.default') !!}
        </div>
        </div>
    </div>
    
  


    @endsection