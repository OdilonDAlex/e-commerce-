@extends('base')


@section('title', 'Accueil')


<!-- import du navbar -->
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