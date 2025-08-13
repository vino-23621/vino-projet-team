@extends('layouts.app')

@section('title', 'Modifier le mot de passe')

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
                    <span class="profile-label">Mot de passe</span>
                          <form method="POST">
                            @csrf
                            @method('PUT')
                        <input class="input-text" type="password" name="password" placeholder="Écrivez votre nouveau mot de passe">
                        @if ($errors->has('password'))
                        <span class="form-content-error">{{ $errors->first('password')}}</span>
                        @endif 
                        <input class="input-text" type="password" name="password_confirmation" placeholder="Confirmez le mot de passe">
                        @if ($errors->has('password_confirmation'))
                        <span class="form-content-error">{{ $errors->first('password_confirmation')}}</span>
                        @endif
                        <button type="submit" class="button button__safe">Mettre à jour</button>
                        </form>
                </div>
            </div>
        </div>

@endsection