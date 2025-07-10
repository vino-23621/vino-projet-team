@extends('layouts.app')
@section('title', 'Créer mon compte')
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

<div class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin">
    <div class="form-content">
       <h2>Créer mon compte</h2>
       <div>
           <p>Déjà inscrit·e ?</p>
           <a href="{{ route('login') }}">Connecte-toi</a>
       </div>
       <form method="POST">
        @csrf
         
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nom *">
        @if ($errors->has('name'))
        <span class="form-content-error">{{ $errors->first('name')}}</span>
        @endif  

        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Adresse courriel *">
        @if ($errors->has('email'))
        <span class="form-content-error">{{ $errors->first('email')}}</span>
        @endif 

        <input type="password" id="password" name="password" placeholder="Mot de passe">
        @if ($errors->has('password'))
        <span class="form-content-error">{{ $errors->first('password')}}</span>
        @endif 

        <input type="password" id="password" name="password_confirmation" placeholder="Retaper mot de passe">
        @if ($errors->has('password_confirmation'))
        <span class="form-content-error">{{ $errors->first('password_confirmation')}}</span>
        @endif 

        <button type="submit" class="button">Créer mon compte</button>
       </form>
    </div>
</div>
@endsection