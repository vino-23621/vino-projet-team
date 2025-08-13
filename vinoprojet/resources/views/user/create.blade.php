@extends('layouts.app')
@section('title', 'Créer mon compte')
@section('content')

<div class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="Bouteille de vin">
    <div class="form-content">
        <h2>Créer mon compte</h2>
        <div>
            <p>Déjà inscrit·e ?</p>
            <a href="{{ route('login') }}">Connecte-toi</a>
        </div>
        <form method="POST" id="loginForm2">
            @csrf

            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nom">
            @if ($errors->has('name'))
            <span class="form-content-error">{{ $errors->first('name')}}</span>
            @endif

            <input type="text" id="cellar_name" name="cellar_name" value="{{ old('cellar_name') }}" placeholder="Donne un nom au cellier">
            @if ($errors->has('cellar_name'))
            <span class="form-content-error">{{ $errors->first('cellar_name')}}</span>
            @endif

            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Adresse courriel">
            @if ($errors->has('email'))
            <span class="form-content-error">{{ $errors->first('email')}}</span>
            @endif

            <input type="password" id="password2" name="password" placeholder="Mot de passe">
            @if ($errors->has('password'))
            <span class="form-content-error">{{ $errors->first('password')}}</span>
            @endif

            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe">
            @if ($errors->has('password_confirmation'))
            <span class="form-content-error">{{ $errors->first('password_confirmation')}}</span>
            @endif

            <ul class="password-rules">
                <li id="consigne1">Au moins une lettre minuscule<span class="checkmark">✔</span></li>
                <li id="consigne2">Au moins une lettre majuscule<span class="checkmark">✔</span></li>
                <li id="consigne3">Au moins un chiffre<span class="checkmark">✔</span></li>
                <li id="consigne4">Au moins 6 caractères<span class="checkmark">✔</span></li>

            </ul>

            <button type="submit" class="button">Soumettre</button>
        </form>
    </div>
</div>
@endsection