@extends('base')


@section('title', 'Accueil')


<!-- import du navbar et du bar de recherche -->
@section('header')
    @include('header')
@endsection

<!-- importation du fichier css -->
@vite(['resources/css/homepage.css', 'resources/js/change-category.js', ])

<!-- debut du session content -->
@section('content')

    <x-search-bar value='Rechercher' />

    @if(! $bestPromos->isEmpty())
    <h1 class="info">Meilleur Promo</h1>
    <!-- meilleur promo  -->
    <div class="best-promos">
        @foreach($bestPromos as $product)
            <div>
                <p class="promo"><span> - {{ $product->promos()->first()->value }}%</span> sur <span>{{ htmlspecialchars_decode($product->name) }}</span></p>
                <x-product-card :product=$product />
            </div>
        @endforeach
    </div>
    @endif

    <!-- categories -->
    @if(! $categories->isEmpty())
        <h1 class="info">par categories</h1>
        <div class="categories">
        @forelse($categories as $category)
            <button class="category {{ $activeCategory == $category ? 'active' : '' }}">{{ $category->name }}</button>
        @empty
        @endforelse
        </div>
        <div class="by-categories">
            @if((bool)$activeCategory)
                @php
                        $products_ = $activeCategory->products()->get() ;
                @endphp

                @forelse($products_ as $product)
                    <x-product-card :product=$product/>
                @empty
                @endforelse
            @endif
        </div>
    @endif
    
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