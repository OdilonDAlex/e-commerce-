@extends('base')

@section('title', 'Historique')

@vite('resources/css/history.css')

@section('header')
    @include('header')
@endsection

@section('content')

    <div class="history-container">
        <h1 class="info" style="color: var(--text-primary); background-color: var(--nav-hover); border-color: var(--primary-btn);">Historique</h1>
        <h2>Non lu</h2>
        @forelse($unReadNotifications as $notification)
            <x-history.notification :notification=$notification bgColor="var(--secondary-btn)" color="var(--dark-border)"/>
        @empty
            <h6>aucune nouvelle notification</h6>
        @endforelse
        
        <h2>lu</h2>
        @forelse($readedNotifications as $notification)
            <x-history.notification :notification=$notification bgColor="var(--nav-hover)" />
        @empty
            <h6>aucune notification</h6>
        @endforelse

        {{ $readedNotifications->links('vendor.pagination.custom') }}
    </div>
    

@endsection