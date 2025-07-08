@extends('layouts.app')

@section('title', 'Profil Utilisateur')

@section('content')
<div class="profile-container">
    <h1>Profil Utilisateur</h1>

    <div class="profile-card">
        <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
        <p><strong>Date d'inscription :</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

        <a href="{{ route('profile.edit') }}" class="btn">Modifier le profil</a>
    </div>
</div>
@endsection