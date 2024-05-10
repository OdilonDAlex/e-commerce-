<div class="message-container">
    <x-message-container-header :with=$conversationWith/>

    <x-conversation-body>
        @forelse($messages as $message)
            
            <x-message by-sender="{{ (int)Auth::user()->id === (int)$message->author_id ? '1' : '0' }}">
                {{ $message->content }}
            </x-message>
        @empty
        @endforelse
    </x-conversation-body>

    <form name="sendMessageForm" action="" class="send-message">
        
        <input type="text" name="content" id="content" placeholder="votre message..." autofocus>
                                                        <!-- a changer plus tard -->
        <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $receiver_id }}">
        <button type="submit"> 
            envoyer
        </button>
    </form>
</div>