@extends('base')


@section('title', 'Accueil')


<!-- import du navbar et du bar de recherche -->
@section('header')
    @include('header')
@endsection

<!-- importation du fichier css -->
@vite(['resources/css/homepage.css', 'resouces/css/product/show.css'])

<!-- debut du session content -->
@section('content')

    <x-search-bar value='Rechercher' />

    <h1 class="info">Meilleur Promo</h1>
    <!-- meilleur promo  -->
    <div class="best-promos">
        @forelse($bestPromos as $product)
            <div>
                <p class="promo">Promotion <span> - {{ $product->promo }}%</span> sur <span>{{ $product->name }}</span></p>
                <x-product-card :product=$product />
            </div>
        @empty
        @endforelse
    </div>

    <!-- categories -->
    <h1 class="info">Categories</h1>
    <div class="categories">
        @forelse($categories as $category)
            <button class="category {{ $activeCategory == $category ? 'active' : '' }}">{{ $category->name }}</button>
        @empty
        @endforelse
    </div>
    <div class="by-categories">
        @php
            $products_ = $activeCategory->products()->get() ;
        @endphp

        @forelse($products_ as $product)
            <x-product-card :product=$product/>
        @empty
        @endforelse
    </div>
    <!-- Tous les produits -->
    <h1 class="info">Tous les produits</h1>
    <div class="all-product">

        @foreach($products as $product)
            <x-product-card :product=$product />
        @endforeach
        
    </div>
    
    <!-- liens vers les autres pages -->
    {{ $products->links('vendor.pagination.custom') }}


@endsection