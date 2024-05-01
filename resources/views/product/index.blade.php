@extends('base')

@section('title', $query ===  null ? 'produits' : 'Resultat de `' . $query . '`')

@vite('resources/css/product-index.css')

@section('header')
    @include('header')
@endsection

@section('content')
    <x-search-bar value="Rechercher" route="product.index" placeholder="{{ $query === null ? 'Nom du produit' : $query }}" />

    <h1 class="info">{{ $query === null ? 'Tous les produits' : 'Resultat de recherche pour le mot clé `'. $query . '`' }}</h1>
    <div class="container">
        @forelse($products as $product)
            <x-product-list-view :product=$product/>
        @empty
            <x-alert type="error">
                Aucun produit n'a été trouvé
            </x-alert>
        @endforelse
    </div>

    @if($query === null)
        {{ $products->links('vendor.pagination.custom') }}
    @endif
@endsection