<div class="{{ 'alert alert-' . $type }}">
    <span class="content">
        {{ $slot }}
    </span>

    <button class="close" onclick="event.target.parentNode.parentNode.parentNode.removeChild(event.target.parentNode.parentNode)">
        @include('svg.cross')
    </button>
</div>