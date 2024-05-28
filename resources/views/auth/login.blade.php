@extends('base')

@section('title', 'Connexion')

@section('content')
@vite('resources/css/flex-center.css')

<form class="login-form" action="{{ route('login.store') }}" method="POST" style="transform: translateY(-45px);">
    @csrf
    <h1>Connexion</h1>  
    
    <!-- email -->
    <x-input name="email" type="email" label="Adresse Email" />

    <!-- mot de passe -->
    <x-input name="password" type="password" label="Mot de passe" />


    <x-input type="submit" value="Se Connecter" name="submit-btn" />

    <p class="alternative-text">Vous n'avez pas encore de compte ? <a  class="alternative-link" href="{{ route('register') }}">S'inscrire</a></p>

</form>
@endsection