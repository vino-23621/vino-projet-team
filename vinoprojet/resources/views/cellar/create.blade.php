@extends('layouts.app')
@section('title', 'Create Cellar')

@section('content')
<main class="form">
    <!-- <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin"> -->

    <div class="container-infocreate-cellar">
        <h4>Celliers</h4>
        <p>Crée un ou plusieurs celliers pour organiser tes bouteilles selon tes goûts, ton espace ou tes occasions spéciales.</p>
    </div>
    <div class="form-content">
        <h3>Créer un cellier</h3>

        <form action="{{ route('cellars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <label for="cellar_name">Nom du cellier</label>
            <input type="text" id="cellar_name" name="name" value="{{ old('name') }}">
            @if($errors->has('name'))
            <span class="form-content-error">{{ $errors->first('name') }}</span>
            @endif

            <div class="flex-row">
                <label class="label-margin-bottom" for="cellar_image">L'image du cellier</label>
                <input type="file" id="cellar_image" name="image">
            </div>
            @if($errors->has('image'))
            <span class="form-content-error">{{ $errors->first('image') }}</span>
            @endif

            <button class="button" type="submit">Créer mon cellier</button>
            <a class="" href="">← Retour à la liste des celliers</a>
        </form>

    </div>
</main>
@endsection