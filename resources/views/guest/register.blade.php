@extends('base')

@section('title', 'inscription')

@vite('resources/css/flex-center.css')

@section('content')

<form class="register-form" action="{{ route('register.store') }}" method="POST" style="transform: translateY(-45px);>
    @csrf
    <h1>Inscription</h1>

    <!-- Name -->
    <x-input name="name" label="Nom"/>
    
    <!-- email -->
    <x-input name="email"  type="email" label="Adresse email"/>
    
    <!-- mot de passe -->
    <x-input name="password"  type="password" label="Mot de passe"/>
    
    <x-input name="submit-btn"  type="submit" value="S'inscrire"/>
    <p class="alternative-text">Vous avez déjà un compte ? <a  class="alternative-link" href="{{ route('login') }}">Se connecter</a></p>
    
</form>
@endsection