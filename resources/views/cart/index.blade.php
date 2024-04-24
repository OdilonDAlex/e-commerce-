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
@if(session('item-removed-to-cart'))
    <div class="alert alert-success">
        {{ session('item-removed-to-cart') }}
        
        <svg width="800px" height="800px" viewBox="0 0 24 24" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <style type="text/css">
            .st0{opacity:0.2;fill:none;stroke:#000000;stroke-width:5.000000e-02;stroke-miterlimit:10;}
        </style>
        <g id="grid_system"/>
        <g id="_icons">
        <path d="M5.3,18.7C5.5,18.9,5.7,19,6,19s0.5-0.1,0.7-0.3l5.3-5.3l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3   c0.4-0.4,0.4-1,0-1.4L13.4,12l5.3-5.3c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0L12,10.6L6.7,5.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4   l5.3,5.3l-5.3,5.3C4.9,17.7,4.9,18.3,5.3,18.7z" fill="var(--dark-border)"/>
        </g>
        </svg>
    </div>
@elseif(session('item-not-removed-to-cart'))
    <div class="alert alert-error">
        {{ session('item-not-removed-to-cart') }}
    </div>
@endif
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
            <td>
                <a href="{{ route('product.show', ['slug' => $product->slug, 'product_id' => $product->id ]) }}">{{ $product->name }}</a>
            </td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($product->price, 2, '.', ' ') }} Ar</td>
            <td>{{ number_format($total_price, 2, '.', ' ') }} Ar</td>
            <td class="action">
                    
                <form action="{{ route('cart.remove-item') }}" method="POST">
                    @method('delete')
                    @csrf

                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">

                    <button class="remove-btn" type="submit">
                        Retirer
                    </button>
                </form>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                Votre panier est vite pour le moment, visite le store pour ajouter des produits dans votre panier <a href="{{ route('home') }}">store</a>
            </td>
        </tr>
        @endforelse
    </tbody>
    @if($sum > 0)
        <tfoot>
            <tr>
                <td>Total</td>
                <td colspan="3">
                    {{ number_format($sum, 2, '.', ' ') }} Ariary
                </td>
                <td class="action">
                    <form action="" method="POST">
                        @csrf

                        <x-input type="submit" value="Acheter"/>
                    </form>
                </td>
            </tr>

        </tfoot>
    @endif
</table>
@endsection