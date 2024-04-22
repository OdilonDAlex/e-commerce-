@extends('base')


@section('title', 'Accueil')




<!-- import du navbar et du bar de recherche -->
@section('header')
@include('header')
@endsection

<!-- importation du fichier css -->
@vite('resources/css/homepage.css')

<!-- debut du session content -->
@section('content')

<!-- alerte -->
@if(session('new-user'))
<p>{{ session('new-user') }}</p>
@else

@if(session('product-added-to-cart'))
<div class="alert alert-success">
    {{ session('product-added-to-cart') }}
    
    <svg width="800px" height="800px" viewBox="0 0 24 24" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <style type="text/css">
            .st0{opacity:0.2;fill:none;stroke:#000000;stroke-width:5.000000e-02;stroke-miterlimit:10;}
        </style>
        <g id="grid_system"/>
        <g id="_icons">
        <path d="M5.3,18.7C5.5,18.9,5.7,19,6,19s0.5-0.1,0.7-0.3l5.3-5.3l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3   c0.4-0.4,0.4-1,0-1.4L13.4,12l5.3-5.3c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0L12,10.6L6.7,5.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4   l5.3,5.3l-5.3,5.3C4.9,17.7,4.9,18.3,5.3,18.7z" fill="var(--dark-border)"/>
        </g>
        </svg>
    </div>
    @endif

    <x-search-bar/>
    <!-- Tous les produits -->
    <div class="all-product">
        @foreach($products as $product)
            <x-product-card :product=$product />
        @endforeach
        
    </div>
    <!-- liens vers les autres pages -->
    {{ $products->links('vendor.pagination.custom') }}
@endif


@endsection