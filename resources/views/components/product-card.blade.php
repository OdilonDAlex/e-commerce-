@vite('resources/css/product/card.css')
@php
    $promo = $product->promos()->first(); 
@endphp
<div class="product-card">
    @auth
        @if(Auth::user()->role == "admin")
            <div class="edit-btn">
                <a href="{{ route('admin.product.edit', ['product_id' => $product->id]) }}">
                    @include('svg.setting')
                </a>
            </div>
        @endif
    @endauth
    <div class="image">
        <div class="float-element">
            <h5 class="price">{{ number_format($product->price*(1 - (  $promo !== null ? (float)$promo->value : 0) /100), 2, '.', ' ') }} Ar</h5>
            
            @auth()
                @if($product->stock > 0)
                <form name="addToCart" action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1" min="0" max="{{ $product->stock }}">
                    
                    <button name="send_form" type="submit">
                        @include('svg.cart')
                    </button>
                </form>
                @endif
            @endauth()
        </div>

        <!-- image -->
        <img class="img" src="{{ $product->getImageUrl() }}" alt="">
    </div>
            

    <div class="product-details">        
        <!-- details du produit -->
        <h1 class="name">{{ htmlspecialchars_decode($product->name) }}</h1>
        @if($promo !== null)
            @if($promo->value > 10)
                <h1 class="price">
                    <span class="price old-price">{{ number_format($product->price, 2, '.', ' ') }} Ar</span>
                    {{ number_format($product->price - (($product->price * $promo->value) / 100), 2, '.', ' ') }} Ar
                <h1>
            @endif
        @else
            <h1 class="price">{{ number_format($product->price, 2, '.', ' ') }} Ar</h1>
        @endif
        <h1 class="stock">{{ $product->stock > 0 ? $product->stock . ' disponible(s)' : 'en rupture de stock' }}</h1>
    </div>

    <!-- action -->
    <div class="action">
        <a class="show" href="{{ route('product.show', ['slug' => $product->slug, 'product_id' => $product->id]) }}">plus de details</a>   
    </div>
</div>