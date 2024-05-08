<div class="message-container">
    <x-message-container-header/>

    <x-conversation-body/>

    <form name="sendMessageForm" action="" class="send-message">
        
        <input type="text" name="content" id="content" placeholder="votre message..." autofocus>
                                                        <!-- a changer plus tard -->
        <input type="hidden" name="receiver_id" id="receiver_id" value="1">
        <button type="submit">
            envoyer
        </button>
    </form>
</div>