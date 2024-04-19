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
                <small>{{ $product->description }}</small><br>
                <small>
                    <div class="stars">
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                    </div>
                    ( 10 revues )
                </small>
            </div>
            <hr>
            <div class="product-price-stock">
                <h5 class="product-price">{{ number_format($product->price, 2, '.', ' ') }} Ariary/<small>unité</small> </h5>

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

                <x-input class="product-quantity" label="Quantité" name="quantity" type="number" min="0" max="{{ $product->stock }}"/>
                <hr>

                <x-input type="submit" value="Ajouter au panier"/>
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