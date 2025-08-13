@extends('layouts.app')

@section('title', 'Modifier le nom d’utilisateur')

@section('content')
<div class="container">
    <div class="profile">
        <div class="profile-wrapper">
            <div class="profile-greeting">
                <h2>Bonjour {{ Auth::user()->name ?? 'Utilisateur' }}</h2>
                <p class="profile-subtitle">Bienvenue sur ton compte Vino.</p>
            </div>

            <div class="profile-info profile-info__form">
                <h3>Mes informations</h3>
                <div class="profile-info-line">
                    <span class="profile-label">Nom</span>

                    {{-- <div class="profile-content-line"> --}}
                          <form method="POST">
                            @csrf
                            @method('PUT')
                        <input class="input-text" type="text" id="name" name="name" value="{{ old('name') !== null && old('name') !== '' ? old('name') : Auth::user()->name}}" placeholder="Nom">
                        @error('name')
                            <span class="form-content-error">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="button button__safe">Mettre à jour</button>
                        </form>
                    {{-- </div> --}}

                </div>

            </div>
        </div>
@endsection