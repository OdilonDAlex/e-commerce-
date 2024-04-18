@extends('base')

@section('title', 'Accueil')


@section('header')
    @include('header')
@endsection

@section('content')

@if(session('new-user'))
    <p>{{ session('new-user') }}</p>
@else
    <div class="all-product">
        @foreach($products as $product)
            <x-product-card :product=$product />
        @endforeach

        {{ $products->links('vendor.pagination.custom') }}
    </div>
@endif


@endsection