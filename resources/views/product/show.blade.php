@extends('base')

@section('title', $product->name )
@vite(['resources/css/product/show.css', 'resources/css/flex-center.css'])

@section('header')
    @include('header')
@endsection

@section('content')
    <div class="product-informations">
        <div class="product-images">
            <img src="{{ $product->getImageUrl() }}" alt="Image Url" class="current-image">    

            <div class="pola-images"></div>
        </div>
        <div class="product-details">
            <div class="product-name">
                <h1>{{ $product->name }}</h1>
                <small class="description">{{ $product->description }}</small><br>
                <small>
                    <div class="stars">
                        <div class="star star-1">
                            @include('product.star')
                        </div>
                        <div class="star star-2">
                            @include('product.star')
                        </div>
                        <div class="star star-3">
                            @include('product.star')
                        </div>
                        <div class="star star-4">
                            @include('product.star')
                        </div>
                        <div class="star star-5">
                            @include('product.star')
                        </div>
                    </div>
                </small>
            </div>
            <hr>
            <div class="product-price-stock">
                @if($product->promo > 0)
                    <h5 class="product-price">
                        <span class="product-price old-price">{{ number_format($product->price, 2, '.', ' ') }}Ar</span>
                        {{ number_format($product->price - (($product->price * $product->promo) / 100), 2, '.', ' ') }}Ar
                    <h5>
                @else
                    <h5 class="product-price">{{ number_format($product->price, 2, '.', ' ') }}Ar</h5>
                @endif

                @if($product->stock > 0) 
                    <h5 class="avaible-product"><span class="avaible-product-quantity">{{ $product->stock }}</span> unité(s) disponible</h5>
                @else
                    <p>Pour l'instant, le produit est en rupture de stock</p>
                    <button>Recevoir une notification</button>
                @endif
            </div>
            <hr>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <!-- quantité -->

                <div class="product-quantity">
                    <label for="quantity">Quantité</label><br>
                    <input type="number" name="quantity" id="quantity" min="0" max="{{ $product->stock }}">
                </div>
                <hr>

                <input type="submit" value="Ajouter au panier">
            </form>
            <hr>
            <div class="share-product">
                <p>Partager : <a href="">Facebook</a> | <a href="">Twitter</a> | <a href="">Gmail</a></p>
            </div>
        </div>

    </div>
    <div class="review-description-container">
        <div class="nav">

        </div>
        <div class="current-content"></div>
    </div>
    
@endsection