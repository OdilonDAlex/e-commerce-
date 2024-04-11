@extends('base')

@section('title', 'Accueil')

@section('content')

@if(session('new-user'))
    <p>{{ session('new-user') }}</p>
@else
    <p>Bonjour {{ Auth::user()->name }}</p>
@endif


@endsection