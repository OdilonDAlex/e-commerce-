@extends('base')

@section('title', 'Accueil')

@section('content')

@if(session('new-user'))
    <p>{{ session('new-user') }}</p>
@else
    <p>Bonjour {{ Auth::user()->name }}</p>
@endif


<form action="{{ route('logout') }}" method="POST">
    @method('delete')
    @csrf

    <input type="submit" value="Se déconnecter">
</form>
@endsection