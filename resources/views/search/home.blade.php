@extends('base')

@section('title', 'Resultat pour : `' . $query . '`')

@vite('resources/css/search-result.css')

@include('header')

@section('content')
    <div class="alert alert-success">
        Resultat de recherche pour le mot clé <strong>`{{ $query}}`</strong>
    </div>

    <x-search-bar  placeholder="autre recherche" value="Rechercher"/>
    <h2>Produits <span class="count">{{ count($products) }}</span></h2>
    <div class="result">

        <!-- Produits -->
        <div class="products">
            @forelse($products as $product)
                <x-product-card :product=$product/>
            @empty
                <div class="alert alert-error">Aucun produit n'a été trouvé</div>
            @endforelse
        </div>

        <br>

        <!-- Produits par Categories -->
        <h2>Categories <span class="count">{{ count($categories) }}</span></h2>
        @forelse($categories as $category)
            <h1 class="category_name">{{$loop->index + 1}}-{{ $category->name }}</h1>
            <div class="categories">

                @forelse($category->products()->get() as $product)
                    <x-product-card :product=$product />
                @empty
                    <div class="alert alert-error">Aucun produit de categorie {{ $category->name }}</div>
                @endforelse
            @empty
                <div class="alert alert-error">Aucun Categorie n'a été trouvé</div>

            @endforelse
        </div>
    </div>
@endsection