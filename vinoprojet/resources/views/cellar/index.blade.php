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

                <div class="flex-row justify-center cellar-icons-gap ">
                    <i class="fa-solid fa-wine-bottle cellar-icon" title="voir""></i>
                    <i class=" fa-solid fa-pen-to-square openModalBtnEdit cellar-icon" data-id="{{$cellier->id}}" title="Éditer"></i>
                    <i class="fa-solid fa-trash openModalBtn cellar-icon" data-id="{{$cellier->id}}" title="Supprimer"></i>
                </div>


            </div>
        </div>
        @endforeach

    </div>

    <!-- Modal Edit -->

    <div id="editModal" class="modal-edit">
        <div class="modal-content-edit">
            <span class="close-btn-edit">&times;</span>
            <h5>Éditer</h5>
            <form action="{{ route('cellars.update', $cellier->id) }}" method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="cellar_name">Nom du cellier</label>
                <input type="text" id="cellar_name" name="name" value="{{ old('name', $cellier->name) }}">
                @if($errors->has('name'))
                <span class="form-content-error">{{ $errors->first('name') }}</span>
                @endif

                <div class="flex-row">
                    <label class="label-margin-bottom" for="cellar_image">L'image du cellier</label>
                    <input type="file" id="cellar_image" name="image">
                </div>
                @if($errors->has('image'))
                <span class="form-content-error">{{ $errors->first('image') }}</span>
                @endif

                <div class="flex-row">
                    <button type="button" class="button__white" id="closeModalBtnEdit">Fermer</button>
                    <button class="button" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Supprimer -->

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