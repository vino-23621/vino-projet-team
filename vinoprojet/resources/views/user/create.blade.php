@extends('layouts.app')
@section('title', 'Login')
@section('content')
<main>
    <img src="#" alt="#">
    <div>
       <h3>Se connecter</h3>
       <div>
           <p>Pas encore de compte ?</p>
           <a href="#">Je m'inscris</a>
       </div>
       <form action="POST">
        @csrf
         
        <label for="name">Nom *</label>
        <input type="text" id="name" name="name" required>

        <label for="username">Username *</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Courriel *</label>
        <input type="email" id="email" name="email" required >

        <label for="password">Mot de passe *</label>
        <input type="password" id="password" name="password" required>
        
        <label>
            <input type="checkbox" name="terms">
            J’accepte <a href="#">la politique de confidentialité</a> et les <a href="#">Conditions d’utilisation</a>
        </label>


         <button type="submit" class="button">Créer mon compte</button>
       </form>
    </div>
</main>
@endsection