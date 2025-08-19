@extends('layouts.app')

@section('title', 'Page introuvable')

@section('content')


<div class="error-page">
    <img src="{{ asset('assets/images/error-nico.png') }}" alt="Error 404">
    <div>
        <h1>Erreur 404</h1>
        <p>{{ session('message') ?? "La page que vous cherchez n'existe pas." }}</p>
        <a href="{{ route('cellars.index') }}" class="btn">Retour à l'accueil</a>
    </div>
</div>
@endsection