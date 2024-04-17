@extends('base')

@section('title', 'Panier')

@section('header')
    @include('header')
@endsection

@section('content')

<p>Assurez-vous de tout vérifier avant de procéder au paiement :D</p>

@forelse($items as $item)
    <p>{{ $item->quantity }}</p>
@empty
    <p>Votre panier est vite pour le moment, visite le store pour ajouter des produits dans votre panier <a href="{{ route('home') }}">store</a></p>
@endforelse

@endsection