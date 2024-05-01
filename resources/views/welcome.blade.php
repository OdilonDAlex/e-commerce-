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
    @if((bool)$bestPromo)
        <!-- meilleur promo  -->
        <div class="best-promo">

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