@extends('layouts.app')

@section('title', 'Page introuvable')

@section('content')


<main class="error-page">
    <h1>Erreur 404</h1>
    <p>{{ session('message') ?? "La page que vous cherchez n'existe pas." }}</p>
    <img src="{{ asset('assets/images/error-nico.jpg') }}" alt="Error 404">
    <a href="{{ route('index') }}" class="btn">Retour à l'accueil</a>
</main>
@endsection