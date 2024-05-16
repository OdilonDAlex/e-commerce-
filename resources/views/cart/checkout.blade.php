@extends('base')

@section('title', 'Payments')

@section('header')
    @include('header')
@endsection


@section('content')
    <div class="ticket-information">
        <form action="">

            <!-- nom -->
            <x-input value="{{ Auth::user()->name }}" label="Nom"/>

            <!-- adresse -->
            <x-input label="Adresse de livraison"/> 
        </form>
    </div>
    <div class="price-total">

    </div>
@endsection