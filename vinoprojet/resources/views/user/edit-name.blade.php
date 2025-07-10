@extends('layouts.app')

@section('title', 'Edition nom utilisateur')

@section('content')
<main>
    <form method="POST">
        @csrf
         @method('PUT')

        <input type="text" id="name" name="name" value="{{ old('name') !== null && old('name') !== '' ? old('name') : Auth::user()->name}}" placeholder="Nom">
        @error('name')
            <span class="form-content-error">{{ $message }}</span>
        @enderror

        <button type="submit" class="button">Mettre à jour votre nom</button>
       </form>
</main>

@endsection