@extends('layouts.app')
@section('title', 'Cellar Content')
@section('content')
<main class="form">
        <!-- <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin"> -->

    <div class="container-infoedit-cellar">
        <h4>Modifier vos Celliers</h4>
    </div>
    <div class="form-content container-formedit-cellar">
        <h3>Modifier votre Cellier</h3>

        <form action="{{ route('cellars.update') }}" method="POST">
            <label for="cellar_name">Nom du cellier</label>
            <input type="text" id="cellar_name" name="name" value="{{ old('name') }}">
            @if($errors->has('name'))
            <span class="form-content-error">{{ $errors->first('name') }}</span>
            @endif

            <div class="flex-row">
                <label class="label-margin-bottom" for="cellar_image">L'image du cellier</label>
                <input type="file" id="cellar_image" name="image" value="{{ old('image') }}">
            </div>
            @if($errors->has('image'))
            <span class="form-content-error">{{ $errors->first('image') }}</span>
            @endif
        </form>
    </div>
</main>
@endsection