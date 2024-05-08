@extends('base')

@section('title', 'message')

@section('header')
    @include('header')
@endsection

@vite('resources/css/admin/message.css')


@section('content')

    <div class="users">
        <h1 class="info">Conversations</h1>
        @forelse($users as $user)
            <x-admin.user-l-i-template :user=$user/>
        @empty
        @endforelse
    </div>
    <x-message-container/>

@endsection