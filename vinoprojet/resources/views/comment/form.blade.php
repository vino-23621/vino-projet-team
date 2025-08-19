@extends('layouts.app')
@section('title', 'commentaire')
@section('content')

<div class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="Image de bouteille de vin">
    <div class="form-content">

        <div class="input_comment">
            <h5>Ajoutez votre commentaire</h5>
        </div>


        <form action="{{route('comment.addcomment', ['cellar' => $cellar->id, 'bottle' => $bottle->id])  }}" method="POST" id="loginForm">
            @csrf
            <input type="text" placeholder="Exprimez votre opinion" id="comment" name="comment">
            @foreach($errors->all() as $error)
            <span class="form-content-error">{{ $error }}</span>
            @endforeach

            <button class="button" type="submit">Soumettre</button>
        </form>
    </div>
</div>
@endsection