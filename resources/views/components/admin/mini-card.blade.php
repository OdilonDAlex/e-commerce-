@vite('resources/css/admin/mini-card.css')

<div class="mini-card">
    @if($incomeDifference !== "")    
        <p class=" income-difference {{(int) $incomeDifference > 0 ? 'positive' : 'negative' }}">{{ $incomeDifference }}% <span class="arrow">
            @if((int) $incomeDifference > 0)
                &uparrow;
            @else
                &downarrow;
            @endif
        </span></p>
    @endif
    <section class="illustration">
    @if($svg != "")
        @include('svg.' . $svg)
    @else
        {{ $title }}
    @endif
    </section>
    <section class="info">
        <h3><span>{{ $value }}</span><br> {{ $title }}</h3>

        @if($action !== "")
            <a href="{{ $actionLink }}" class="action">{{ $action }}</a>
        @endif
    </section>
</div>  