<div {{ $attributes->merge(['class' => 'user user-' . $user->id]) }}>
    @php
        use App\Models\Message;
        $lastMessage = Message::whereRaw('author_id = ' . $user->id . ' OR receiver_id = ' . $user->id)->orderByDesc('created_at')->first();
    @endphp
    <h3 class="name">{{ $user->name }}</h3>
    <p class="last-message">{{ $lastMessage->author_id == $user->id ? '' : 'Vous :' }} {{  $lastMessage->content }}</p>
    <p class="elapsed-time">il y a {{ $lastMessage->getTimeElapsed() }}</p>

    @if($unRead == "1")
        <p class="unread"></p>
    @endif
</div>