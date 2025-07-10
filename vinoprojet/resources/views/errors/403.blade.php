@extends('layouts.app')

@section('title', 'Accès refusé')

@section('content')


<div class="error-page">
    <img src="{{ asset('assets/images/error-nico.jpg') }}" alt="Error 403">
    <div>
        <h1>Erreur 403</h1>
        <p>{{ session('message') ?? "Vos droits d'accès ne permettent pas de consulter cette page." }}</p>
        <a href="{{ route('index') }}" class="btn">Retour à l'accueil</a>
    </div>
</div>
@endsection