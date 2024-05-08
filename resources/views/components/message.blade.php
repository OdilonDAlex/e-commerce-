<div class="message {{ $bySender === '1' ? 'right' : 'left' }}">
    <div class="content">
        {{ $slot }}
        @if($status !== "")
            <p class="status">{{ $status }}</p>
        @endif
    </div>
</div>