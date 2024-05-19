@extends('base')

@section('title', 'Payments')

@vite(['resources/css/checkout.css', 'resources/css/admin/table.css', 'resources/js/checkout.js'])

@section('header')
    @include('header')
@endsection

@php
    $cart = Auth::user()->carts()->first();

    $items = $cart->items()->get();
    
    $product_count = array_sum($items->pluck('quantity')->toArray());

    $total_price = 0;
    
    foreach($items as $item){

        $relatedProduct = $item->products()->first();
        
        try {
            $total_price += $relatedProduct->price * $item->quantity; 
        }
        catch(Exception $error){;}
    }

    $deliverPrice = 2000;
@endphp


@section('content')
    
    <div class="ticket-information">

        <form  name="ticketInformation" action="{{ route('register.store') }}" method="POST">
            @csrf
            <h1>Details de livraison</h1>

            <div class="full-name">
                <!-- Name -->
                <x-input name="name" label="Nom" placeholder="Nom du recepteur"/>
            
                <!-- prenom -->
                <x-input name="first_name"  label="Prénom" placeholder="Prénom du recepteur"/>
            </div>
            
            <div>
                <!-- email -->
                <x-input name="email"  type="email" label="adresse email" placeholder="exmple@gmail.com"/>

                <!-- telephone -->
                <x-input name="phonenumber" type="tel" label="Telephone" placeholder="+2613xxxxxxxx"/>
            </div>
            
            <div class="address">
                <!-- Adresse -->
                <x-input name="adress"  type="text" label="adresse de livraison" placeholder="adresse ..."/>

                <!-- code postal -->
                <x-input name="posta-code" type="number" label="Code Postal" placeholder="exemple: 501"/>
            </div>
        
        </form>
    </div>


    <div class="leftside">
        <div class="cart-total">
            <h1>Addition</h1>
            <table>
                <tr>
                    <td>Nombre total d'element dans le panier</td>
                    <td>{{ $product_count }}</td>
                </tr>
                <tr>
                    <td>Prix total des produits</td>
                    <td>{{ number_format($total_price, 2, '.', ' ') }}Ar</td>
                </tr>
                <tr>
                    <td>Livraion</td>
                    <td>{{ number_format($deliverPrice, 2, '.', ' ')}}Ar</td>
                </tr>
                <tr>
                    <td>Total a payer</td>
                    <td>{{ number_format($deliverPrice + $total_price, 2, '.', ' ')}}Ar</td>
                </tr>
            </table>
        </div>
        <div class="payment-method">
            <h1>Methode de paiement</h1>
            <form name="paymentMethod" action="{{ route('cart.buy') }}" method="POST">
                @csrf

                <div class="methods">
                    <!-- Mvola -->
                    <div>
                        <input type="radio" name="payment" id="mvola">
                        <label for="mvola">Mvola</label>
                        <input type="tel" placeholder="numero telma" class="mvola">
                    </div>
                    
                    <!-- Orange Money -->
                    <div>
                        <input type="radio" name="payment" id="orange-money">
                        <label for="orange-money">Orange Money</label>
                        <input type="tel" placeholder="numero orange" class="orange-money">
                    </div>
                    <div>
                        <input type="radio" name="payment" id="airtel-money">
                        <label for="airtel-money">Airtel Money</label>
                        <input type="tel" placeholder="numero airtel" class="airtel-money">
                    </div>
                </div>

                <x-input type="submit" value="Payer"/>
            
            </form>
        </div>
    </div>
@endsection