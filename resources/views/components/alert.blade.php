<div class="{{ 'alert alert-' . $type }}">
    <span class="content">
        {{ $slot }}
    </span>

    <button class="close">
        @include('svg.cross')
    </button>
</div>