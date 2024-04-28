@vite('resources/css/notification.css')

<div class="notification-render-container" style="background-color: {{ $bgColor }};color: {{ $color }}">
    <h5 class="title">{{ $notification->data['title'] }}</h5>
    <p class="content">{{ $notification->data['content'] }}</p>
    <small class="datetime">{{ $notification->created_at }}</small>

    @php
        $notification->markAsRead();
    @endphp
</div>