@extends('layouts.app')

@section('title', 'Profil Utilisateur')

@section('content')
<div class="profile-container">
    <h1>Profil Utilisateur</h1>

    <div class="profile-card">
        <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
        <p><strong>Date d'inscription :</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

        <a href="#" class="btn">Modifier le profil</a>

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