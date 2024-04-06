@extends('base')

@section('title', 'inscription')

@section('content')

<form action="{{ route('register.store') }}" method="POST">
    @csrf

    <!-- Name -->
    <div>
        <label for="name">Nom</label><br>
        <input type="text" name="name" id="name">
    </div>

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

    <input type="submit" value="S'inscrire">
</form>
@endsection