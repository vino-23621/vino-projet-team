@extends('layouts.app')

@section('title', 'Edition mot de passe')

@section('content')
<main>
    <form method="POST">
        @csrf
         @method('PUT')

       <input type="password" id="password" name="password" placeholder="Mot de passe">
        @if ($errors->has('password'))
        <span class="form-content-error">{{ $errors->first('password')}}</span>
        @endif 

        <input type="password" id="password" name="password_confirmation" placeholder="Retaper mot de passe">
        @if ($errors->has('password_confirmation'))
        <span class="form-content-error">{{ $errors->first('password_confirmation')}}</span>
        @endif 

        <button type="submit" class="button">update password</button>
       </form>
</main>

@endsection