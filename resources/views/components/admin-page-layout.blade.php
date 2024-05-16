@extends('base')

@section('title', 'Administration')


@vite(['resources/css/admin/sidebar.css'])

@section('header')
    @include('header')
@endsection

@section('content')

    @include('admin.sidebar')

    <div class="main-content">
        {{ $slot }}
    </div>

@endsection