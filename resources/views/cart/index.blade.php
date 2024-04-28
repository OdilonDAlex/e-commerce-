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

<x-alert>
    {{ session('item-removed-to-cart') }}
</x-alert>


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