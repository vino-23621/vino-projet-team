@extends('layouts.app')
@section('title', 'Créer mon compte')
@section('content')
<main class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin">
    <div class="form-content">
       <h2>Créer mon compte</h2>
       <div>
           <p>Déjà inscrit·e ?</p>
           <a href="#">Connecte-toi</a>
       </div>
       <form action="POST">
        @csrf
         
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nom *">
        <span class="form-content-error">Erreur de validation</span>

        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Nom d’utilisateur *">
        <span class="form-content-error">Erreur de validation</span>

        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Adresse courriel *">
        <span class="form-content-error">Erreur de validation</span>

        <input type="password" id="password" name="password" placeholder="Mot de passe">
        <span class="form-content-error">Erreur de validation</span>

        <input type="password" id="password" name="confirmed-password" placeholder="Retaper mot de passe">
        <span class="form-content-error">Erreur de validation</span>
        
        <button type="submit" class="button">Créer mon compte</button>
       </form>
    </div>
</main>
@endsection