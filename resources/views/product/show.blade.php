@extends('base')

@section('title', $product->name )
@vite('resources/css/product/show.css')

@section('header')
    @include('header')
@endsection

@section('content')
    <div class="product-informations">
        <div class="product-images">
            @if($product->getImageUrl() !== null)
                <img src="{{ $product->getImageUrl() }}" alt="Image Url" class="current-image">    

                <div class="pola-images"></div>
            @else
                <h1>$product->name</h1>
            @endif
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
                    <h5 style="color: var(--primary-btn);" ><span style="font-size: 20px;">{{ $product->stock }}</span> unité(s) disponible</h5>
                @else
                    <p>Pour l'instant, le produit est en rupture de stock</p>
                    <button>Recevoir une notification</button>
                @endif
            </div>
            <hr>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="product-quantity">
                    <label for="quantity">Quantité</label><br>
                    <input placeholder="entre 0 et {{ (int)$product->stock }}" type="number" name="quantity" id="quantity" min="0" max="{{ (int)$product->stock }}">
                </div>
                    <hr>
                <input class="add-to-cart-button" type="submit" value="Ajouter au panier">
            </form>
            <hr>
            <div class="share-product">
                <p>Share : <a href="">Facebook</a> | <a href="">Twitter</a> | <a href="">Gmail</a></p>
            </div>
        </div>

    </div>
    <div class="review-description-container">
        <div class="nav">

        </div>
        <div class="current-content"></div>
    </div>
    
@endsection