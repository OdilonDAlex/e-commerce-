@extends('base')

@section('title', $user->name)

@vite('resources/css/profile.css')

@include('header')

@if(session('profile-updated'))
    <x-alert>
        {{ session('profile-updated') }}
    </x-alert>
@endif

@section('content')
    <form  class="profile" action="{{ route('profile.update') }}" method="POST">
        @method('patch')
        @csrf
        <h2>Informations personnelle</h2>
        <!-- Nom -->
        <x-input label="Nom" type="text" name="name" value="{{ Str::of( $user->name )->toHtmlString() }}"/>
        
        <!-- email -->
        <x-input  label="Adresse email" type="email" name="email" value="{{ $user->email }}" disabled="1"/>
        
        <!-- type d'utilisateur -->
        <x-input label="Type d'utilisateur" name="role" value="{{ $user->role }}" disabled="1"/>

        <!-- Changer de mot de passe -->
        <h2>Changer de mot de passe</h2>
        
        <!-- Mot de passe -->
        <x-input  label="Mot de passe actuel" type="password" name="password"/>
        
        <!-- Nouveau mot de passe -->
        <x-input  label="nouveau mot de passe" type="password" name="new-password"/>
        
        <!-- Confirmation -->
        <x-input  label="Confirmation" type="password" name="password-confirmation"/>

        <x-input value="Enregistrer" type="submit" />
    </form>
@endsection