@extends('layouts.app')
@section('title', 'Connexion')
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

<main class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin">
    <div class="form-content">
       <h2>Se connecter</h2>
       <div>
           <p>Pas encore de compte ?</p>
           <a href="{{ route('user.create') }}">Je m'inscris</a>
       </div>
       <form method="POST" >
        @csrf
        <input type="email" placeholder="Nom d’utilisateur ou adresse courriel" id="email" name="email" value="{{ old('email') }}">
        @foreach($errors->all() as $error)
        <span class="form-content-error">{{ $error }}</span>
        @endforeach
         <input type="password" placeholder="Mot de passe" id="password" name="password">
         <button class="button" type="submit">Se connecter</button>
       </form>
    </div>
</main>
@endsection