@vite('resources/css/product-list-view.css')
<div style="position: relative;">
<a href="{{ route('product.show', ['product_id' => $product->id, 'slug' => $product->slug]) }}" class="product">
    <div class="details">
        <h1 class="name">{{ $product->name }}</h1>
        <h2 class="price">{{ number_format($product->price, 2, '.', ' ') }}Ar</h2>
        <h5 class="stock">{{ $product->stock }} disponible(s)</h5>
    </div>
    
    <div class="action">
        
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
    </div>
</a>
</div>