@extends('layouts.app')

@section('title', 'Modifier le mot de passe')

@section('content')
@if(Breadcrumbs::has())
<div id="fil-ariane" aria-label="breadcrumb">
    <ul class="breadcrumb">
        @foreach (Breadcrumbs::current() as $crumbs)
        @if ($crumbs->url() && !$loop->last)
        <li class="breadcrumb-item">
            <a href="{{ $crumbs->url() }}">
                {{ $crumbs->title() }}
            </a>
        </li>
        @else
        <li class="breadcrumb-item active" aria-current="page">
            {{ $crumbs->title() }}
        </li>
        @endif
        @if (!$loop->last)
        <span class="breadcrumb-separator">></span>
        @endif
        @endforeach
    </ul>
</div>
@endif

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


                    <form method="POST" id="loginForm3">
                        @csrf
                        @method('PUT')
                        <input class="input-text" type="password" id="password" name="password" placeholder="Ecrivez votre nouveau mot de passe">
                        @if ($errors->has('password'))
                        <span class="form-content-error">{{ $errors->first('password')}}</span>
                        @endif
                        <input class="input-text" type="password" name="password_confirmation" placeholder="Retapez de nouveau">

                        @if ($errors->has('password_confirmation'))
                        <span class="form-content-error">{{ $errors->first('password_confirmation')}}</span>
                        @endif

                        <ul class="password-rules">
                            <li id="consigne1">Au moins une lettre minuscule<span class="checkmark">✔</span></li>
                            <li id="consigne2">Au moins une lettre majuscule<span class="checkmark">✔</span></li>
                            <li id="consigne3">Au moins un chiffre<span class="checkmark">✔</span></li>
                            <li id="consigne4">Au moins 6 caractères<span class="checkmark">✔</span></li>

                        </ul>


                        <button type="submit" class="button button__safe">Mettre à jour</button>


                </div>
            </div>
        </div>

        @endsection