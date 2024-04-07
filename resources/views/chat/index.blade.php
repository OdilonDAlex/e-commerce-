@extends('base')

@section('title', 'Chat')


@section('content')


<div class="conversation_container" style="height: calc(100vh - 200px);">

</div>

<form action="{{ route('chat.create') }}" method="POST" name="send_message_form">
    @csrf

    <input type="hidden" name="receiver_id" value="2">
    <textarea name="message_content" id="" cols="30" rows="4"></textarea><br>
    <input type="submit" value="Envoyer" name="send_message_button">
</form>


@endsection