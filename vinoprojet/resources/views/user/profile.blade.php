@extends('layouts.app')

@section('title', 'Profil Utilisateur')

@section('content')
<div class="container">
    <div class="profile-container">
        <div class="profile-wrapper">
            <div class="profile-greeting">
                <h2>Bonjour {{ Auth::user()->name ?? 'Utilisateur' }}</h2>
                <p class="profile-subtitle">Bienvenue sur ton compte Vino.</p>
            </div>

            <div class="profile-info">
                <h3>Mes infos</h3>
                <div class="profile-info-line">
                    <span class="profile-label">Nom</span>
                    <span class="profile-value">{{ Auth::user()->name }}</span>
                    <a href="{{ route('user.edit', Auth::id()) }}" class="profile-edit-link">Changer</a>
                </div>

                <div class="profile-info-line">
                    <span class="profile-label">Courriel</span>
                    <span class="profile-value">{{ Auth::user()->email }}</span>
                    <a href="{{ route('user.edit', Auth::id()) }}" class="profile-edit-link">Changer</a>
                </div>

                <div class="profile-info-line">
                    <span class="profile-label">Mot de passe</span>
                    <span class="profile-value">••••••••</span>
                    <a href="{{ route('user.edit', Auth::id()) }}" class="profile-edit-link">Changer</a>
                </div>
                 <input type="checkbox" id="modalUser-toggle" class="modalUser-toggle" hidden>


            <label for="modalUser-toggle" class="button button__danger">Supprimer le compte</label>
            <div class="modalUser">
                <div class="modalUser-box">
                    <p>Voulez-vous vraiment supprimer?</p>
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