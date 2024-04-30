@vite('resources/css/notification.css')

<div class="notification-render-container" style="background-color: {{ $bgColor }};">
    <div class="date">
        {{ $notification->created_at->englishDayOfWeek }} <br>
        {{ $notification->created_at->day }} <br>
        {{ $notification->created_at->englishMonth }} <br>
    </div>
    <div class="details">
        <h5 class="title">{{ $notification->data['title'] }}</h5>
        <p class="content">{{ $notification->data['content'] }}</p>
        <small class="elapsed-time">il y a {{ $notification->getTimeElapsed() }}</small>
    </div>

    <button class="delete">
        @include('svg.cross') ; 
    </button>

    {{ $notification->markAsRead() }}
</div>