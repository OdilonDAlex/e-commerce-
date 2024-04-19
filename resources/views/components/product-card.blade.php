@vite('resources/css/product/card.css')

<div class="product-card">
    <div class="product-details">

        <!-- image -->
        <div class="image">
            <h5 class="price">{{ number_format($product->price, 2, '.', ' ') }}Ar</h5>

            <img class="img" src="{{ $product->getImageUrl() }}" alt="">
        </div>
        
        <!-- details du produit -->
        <div class="card-head"> 
            <h1>{{ $product->name }}</h1>
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