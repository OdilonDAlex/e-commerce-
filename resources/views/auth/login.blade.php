@extends('base')

@section('title', 'Connexion')

@section('content')

<form action="{{ route('login.store') }}" method="POST">
    @csrf

    <!-- email -->
    <div>
        <label for="email">Adresse email</label><br>
        <input type="email" name="email" id="email">
    </div>

    <!-- mot de passe -->
    <div>
        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" id="password">
    </div>

    <input type="submit" value="Se connecter">
</form>
@endsection