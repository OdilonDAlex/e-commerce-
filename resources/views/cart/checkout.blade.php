@extends('base')

@section('title', 'Payments')

@vite(['resources/css/checkout.css', 'resources/css/admin/table.css', 'resources/js/checkout.js'])

@section('header')
    @include('header')
@endsection


@section('content')
    
    <div class="ticket-information">

        <form class="register-form" action="{{ route('register.store') }}" method="POST">
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
                    <td>15</td>
                </tr>
                <tr>
                    <td>Prix total des produits</td>
                    <td>1 500 000Ar</td>
                </tr>
                <tr>
                    <td>Livraion</td>
                    <td>2 000Ar</td>
                </tr>
                <tr>
                    <td>Total a panier</td>
                    <td>1 502 000Ar</td>
                </tr>
            </table>
        </div>
        <div class="payment-method">
            <h1>Methode de paiement</h1>
            <form class="register-form" action="{{ route('register.store') }}" method="POST">
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