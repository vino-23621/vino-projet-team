@extends('layouts.app')
@section('title', 'Créer un cellier')

@section('content')

{{-- Introduction section for cellar creation --}}
<div class="cellar">
    <h1>Création des Celliers</h1>
    <p>
        Crée un ou plusieurs celliers pour organiser tes bouteilles selon tes goûts,
        ton espace ou tes occasions spéciales.
    </p>
</div>

<main class="form">

    {{-- Decorative image (optional) --}}
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin">

    {{-- Cellar creation form container --}}
    <div class="form-content container-formcreate-cellar">
        <h2>Créer un cellier</h2>

        {{-- Form to create a new cellar --}}
        <form action="{{ route('cellars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Input: Name of the cellar --}}
            <input type="text" id="cellar_name" name="name" value="{{ old('name') }}" placeholder="Nom du cellier *">
            @if($errors->has('name'))
            <span class="form-content-error">{{ $errors->first('name') }}</span>
            @endif

            {{-- Submit button --}}
            <button class="button" type="submit">Créer mon cellier</button>

            {{-- Return link to cellar list --}}
            <a class="retour" href="{{ route('cellars.index') }}">← Retour à la liste des celliers</a>
        </form>
    </div>

</main>
@endsection