@vite('resources/css/admin/mini-card.css')

<div class="mini-card">
    <section class="illustration">
    @if($svg != "")
        @include('svg.' . $svg)
    @else
        {{ $title }}
    @endif
    </section>
    <section class="info">
        <h3><span>{{ $value }}</span> {{ $title }}</h3>
        <a href="{{ $actionLink }}" class="action">{{ $action }}</a>
    </section>
</div>  