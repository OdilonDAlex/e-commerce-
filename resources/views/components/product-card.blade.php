@vite('resources/css/product/card.css')

<div class="product-card">
    <!-- details  -->
    <div class="product details">
        <div class="card-head"> 
            <h1>{{ $product->name }}</h1>
            <h1>{{ $product->stock }} disponible(s)</h1>
        </div>

        <div class="image">
            <h5 class="price">{{ number_format($product->price, 2, '.', ' ') }}Ar</h5>
            @if($product->haveImage())
                <img class="img" src="{{ $product->getImageUrl() }}" alt="">
            @else
                <p class="img" >{{ $product->description }}</p>
            @endif
        </div>

    </div>

    <!-- action -->
    <div class="action">
        <div class="options">
            <a href="">like</a>
            <a href="">revue</a>
        </div>

        <a href="{{ route('product.show', ['slug' => $product->slug, 'product_id' => $product->id]) }}">plus de details</a>   
        </form>
    </div>
</div>