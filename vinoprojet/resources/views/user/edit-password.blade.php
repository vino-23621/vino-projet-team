@extends('layouts.app')

@section('title', 'Edition mot de passe')

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
                <h3>Mes infos</h3>
                <div class="profile-info-line">
                    <span class="profile-label">Mot de passe</span>
                          <form method="POST">
                            @csrf
                            @method('PUT')
                        <input class="input-text" type="password" name="password" placeholder="Ecrivez votre nouveau mot de passe">
                        @if ($errors->has('password'))
                        <span class="form-content-error">{{ $errors->first('password')}}</span>
                        @endif 
                        <input class="input-text" type="password" name="password_confirmation" placeholder="Retapez de nouveau">
                        @if ($errors->has('password_confirmation'))
                        <span class="form-content-error">{{ $errors->first('password_confirmation')}}</span>
                        @endif
                        <button type="submit" class="button button__safe">Mettre à jour</button>
                        </form>

                </div>

            </div>
        </div>

@endsection