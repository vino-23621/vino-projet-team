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
                                <button class="openModalBtnEdit modalBtn"><i class="fa-solid fa-pencil"></i> Éditer le nom</button>
                                <a href="{{ route('cellars.show', $cellar->id) }}"><i class="fa-regular fa-eye"></i> Consulte les bouteilles</a>
                                <button class="openModalBtn modalBtn"><i class="fa-regular fa-trash-can"></i> Supprime ce cellier</button>
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
                                <button class="openModalBtnEdit modalBtn" data-name="{{$cellar->name}}" data-id="{{$cellar->id}}"><i class="fa-solid fa-pencil"></i> Éditer le nom</button>
                                <a href="{{ route('cellars.show', $cellar->id) }}" ><i class="fa-regular fa-eye"></i> Consulte les bouteilles</a>
                                <button class="openModalBtn modalBtn" data-id="{{$cellar->id}}"><i class="fa-regular fa-trash-can"></i> Supprime ce cellier</button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <!-- Modal Edit -->

                <div id="editModal" class="modal-edit">
                    <div class="modal-content-edit">
                        <span class="close-btn-edit">&times;</span>
                        <h5>Éditer</h5>

                        <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <label for="cellar_name">Nom du cellier</label>
                            <input type="text" id="cellar_name" name="name" value="">
                            @if($errors->has('name'))
                            <span class="form-content-error">{{ $errors->first('name') }}</span>
                            @endif

                            <!-- <div class="flex-row">
                                <label class="modal-label label-margin-bottom" for="cellar_image">L'image du cellier</label>
                                <input type="file" id="cellar_image" name="image">
                            </div>
                            @if($errors->has('image'))
                            <span class="form-content-error">{{ $errors->first('image') }}</span>
                            @endif -->

                            <div class="flex-row modal-buttons">


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
            </div>
        </div>
@endsection