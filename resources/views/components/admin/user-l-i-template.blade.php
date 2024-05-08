<div class="user">
    @php
        $lastMessage = $user->messages()->orderBy('created_at')->get()->last();
    @endphp
    <h3 class="name">{{ $user->name }}</h3>
    <p class="last-message">{{ $lastMessage->content }}</p>
    <p class="elapsed-time">il y a {{ $lastMessage->getTimeElapsed() }}</p>
</div>