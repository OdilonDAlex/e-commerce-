@extends('base')

@section('title', 'Panier')

@section('header')
@include('header')
@endsection

@vite('resources/css/admin/table.css')

@section('content')

@php
    $sum = 0;
@endphp

<table>
    <thead>
        <td>Nom du produit</td>
        <td>Quantité</td>
        <td>Prix Unitaire</td>
        <td>Prix Calculé</td>
        <td>Action</td>
    </thead>
    <tbody>
        @forelse($items as $item)
        @php
            $product = App\Models\Product::find((int) $item->product_id) ;
            
            if($product === null){
                continue;
            }
            
            $total_price = $product->price * $item->quantity;
            $sum += $total_price;
        @endphp
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($product->price, 2, '.', ' ') }} Ar</td>
            <td>{{ number_format($total_price, 2, '.', ' ') }} Ar</td>
            <td class="action">
                <a class="edit-btn" href="">Rétirer</a>
            </td>
        </tr>
        @empty
        <tr>
            <td>
                Votre panier est vite pour le moment, visite le store pour ajouter des produits dans votre panier <a href="{{ route('home') }}">store</a>
            </td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td>Total</td>
            <td colspan="3">
                {{ number_format($sum, 2, '.', ' ') }} Ariary
            </td>
            <td class="action">
                <a class="remove-btn" href="">Tout Acheter</a>
            </td>
        </tr>

    </tfoot>
</table>
@endsection