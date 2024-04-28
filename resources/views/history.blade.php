@extends('base')

@section('title', 'Historique')

@section('header')
    @include('header')
@endsection

@section('content')

    @forelse($notifications as $notification)
        <x-history.notification :notification=$notification/>
    @empty
        <h5>Pas de notifications</h5>
    @endforelse

@endsection