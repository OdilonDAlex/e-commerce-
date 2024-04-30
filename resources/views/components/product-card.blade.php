@vite('resources/css/product/card.css')

<div class="product-card">
    <div class="product-details">

        <!-- image -->
        <div class="image">
            <div class="action">
            <h5 class="price">{{ number_format($product->price, 2, '.', ' ') }}Ar</h5>
            
            @auth()
                @if($product->stock > 0)
                <form name="addToCart" action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1" min="0" max="{{ $product->stock }}">
                    
                    <button name="send_form" type="submit">
                        @include('product.cart')
                    </button>
                </form>
                @endif
            @endauth()
        </div>
            

            <img class="img" src="{{ $product->getImageUrl() }}" alt="">
        </div>
        
        <!-- details du produit -->
        <div class="card-footer"> 
            <h1>{{ $product->name }}</h1>
            <h1 class="price">{{ number_format($product->price, 2, '.', ' ') }}Ar</h1>
            <h1>{{ $product->stock }} disponible(s)</h1>
        </div>
    </div>

    <!-- action -->
    <div class="action">
        <!-- <div class="options">
            <a href="">like</a>
            <a href="">revue</a>
        </div> -->

        <!-- vue de details  -->
        <a class="show" href="{{ route('product.show', ['slug' => $product->slug, 'product_id' => $product->id]) }}">plus de details</a>   
    </div>
</div>