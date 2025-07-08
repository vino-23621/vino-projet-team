@extends(';ayouts.app')
@section('title', 'Create Cellar')
@section('content')
<main class="form">
    <img src="{{ asset('assets/images/img-wines.jpg') }}" alt="image bouteille vin">
    <div class="form-content">
       <h2>Créer un cellier</h2>
       <form action="POST" >
        @csrf
        <input type="text" placeholder="Nom de votre cellier" id="cellar_name" name="cellar_name">
        <span class="form-content-error">Impossible de créer votre cellier</span>
        <button class="button" type="submit">Créer mon cellier</button>
       </form>
    </div>
</main>
@endsection