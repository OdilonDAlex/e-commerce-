@vite('resources/css/search-bar.css')

<div class="search-bar">
    <form action="" method="get">

        <div>
            <input type="text" name="value">
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