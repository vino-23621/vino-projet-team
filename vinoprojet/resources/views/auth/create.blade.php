@extends('layouts.app')
@section('title', 'Connexion')
@section('content')

<div class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="Image de bouteille de vin">
    <div class="form-content">
        <h2>Se connecter</h2>
        <div>
            <p>Pas encore de compte ?</p>
            <a href="{{ route('user.create') }}">Je m'inscris</a>
        </div>
        <form method="POST" id="loginForm">
            @csrf
            <input type="email" placeholder="Adresse courriel" id="email" name="email" value="{{ old('email') }}">
            @foreach($errors->all() as $error)
            <span class="form-content-error">{{ $error }}</span>
            @endforeach

            <input type="password" placeholder="Mot de passe" id="password" name="password">

            <ul class="password-rules">
                <li id="consigne1">Au moins une lettre minuscule<span class="checkmark">✔</span></li>
                <li id="consigne2">Au moins une lettre majuscule<span class="checkmark">✔</span></li>
                <li id="consigne3">Au moins un chiffre<span class="checkmark">✔</span></li>
                <li id="consigne4">Au moins 6 caractères<span class="checkmark">✔</span></li>

            </ul>
            <button class="button" type="submit">Se connecter</button>
        </form>
    </div>
</div>
@endsection