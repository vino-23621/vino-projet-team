@extends('layouts.app')
@section('title', 'Login')
@section('content')
<main class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin">
    <div class="form-content">
       <h2>Se connecter</h2>
       <div>
           <p>Pas encore de compte ?</p>
           <a href="">Je m'inscris</a>
       </div>
       <form action="POST" >
        @csrf
        <input type="email" placeholder="Nom d’utilisateur ou adresse courriel" id="email" name="email" value="{{ old('email') }}">
        <span class="form-content-error">Erreur de validation</span>
         <input type="password" placeholder="Mot de passe" id="password" name="password">
         <button class="button" type="submit">Se connecter</button>
       </form>
    </div>
</main>
@endsection