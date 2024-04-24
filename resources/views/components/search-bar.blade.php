@vite('resources/css/search-bar.css')

<div class="search-bar">
    <form action="{{ route('product.search') }}" method="GET">


        <input type="hidden" name="route" value="{{ $route }}">
        <div>
            <input type="text" name="query" placeholder="{{ $placeholder }}" >
            <button type="submit">
                @if($value != "")
                    {{ $value }}
                @else
                    @include('svg.search')
                @endif
            </button>
        </div>
    </form>
</div>