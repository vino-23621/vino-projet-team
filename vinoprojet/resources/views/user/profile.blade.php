@extends('layouts.app')

@section('title', 'Profil utilisateur')

@section('content')
<div class="container">
    <div class="profile">
        <div class="profile-wrapper">
            <div class="profile-greeting">
                <h2>Bonjour {{ Auth::user()->name ?? 'Utilisateur' }}</h2>
                <p class="profile-subtitle">Bienvenue sur ton compte Vino.</p>
            </div>

            <div class="profile-info">
                <h3>Mes informations</h3>
                <div class="profile-info-line">
                    <span class="profile-label">Nom</span>

                    <div class="profile-content-line">
                        <span class="profile-value">{{ Auth::user()->name }}</span>
                        <a href="{{ route('user.edit-name', Auth::id()) }}" class="profile-edit-link">Modifier</a>
                    </div>

                </div>

                <div class="profile-info-line">
                    <span class="profile-label">Courriel</span>

                    <div class="profile-content-line">
                        <span class="profile-value">{{ Auth::user()->email }}</span>

                    </div>

                </div>

                <div class="profile-info-line">
                    <span class="profile-label">Mot de passe</span>

                    <div class="profile-content-line">
                        <span class="profile-value">••••••••</span>
                        <a href="{{ route('user.edit-password', Auth::id()) }}" class="profile-edit-link">Modifier</a>
                    </div>
                </div>

                <input type="checkbox" id="modalUser-toggle" class="modalUser-toggle" hidden>


                <label for="modalUser-toggle" class="button button__danger">Supprimer le compte</label>

                <h3>Mes Commentaires</h3>

                @forelse ($comments as $comment)
                @foreach ($comment->bottles as $bottle)
                <div class="container_comments">
                    <img src="https://{{ $bottle['image'] }}" alt="bottle" width="70">
                    <div>
                        <div class="comments-flex">
                            <p class="comments-title"> Nom: </p>
                            <p> {{ $bottle->name }}</p>
                        </div>

                        <div class="comments-flex">
                            <p class="comments-title"> Commentaire: </p>
                            <p> {{ $bottle->pivot->comment }}</p>
                        </div>

                        <form action="{{ route('comments.destroy', ['comment' => $comment->id, 'bottle' => $bottle->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="modalBtn suppBtn" type="submit"><i class="fa-regular fa-trash-can"></i> Supprimer</button>
                        </form>

                    </div>

                </div>

                @endforeach
                @empty
                <p>Pas des commentaires</p>
                @endforelse


                <div class="modalUser">
                    <div class="modalUser-box">
                        <p>Voulez-vous vraiment supprimer ce compte ?</p>
                        <div>
                            <form action="{{ route('user.destroy', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button__danger">Supprimer</button>
                            </form>
                            <label for="modalUser-toggle" class="button button__safe">Annuler</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection