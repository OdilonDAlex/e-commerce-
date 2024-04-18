@extends('base')

@section('title', 'Administration - Listes des produits')

@vite('resources/css/admin/table.css')

@section('header')
    @include('header')
@endsection

@section('content')
    <p style="margin: 10px;">
        <span>admin</span> >
        <span>produits</span> >
        <a href="">liste des produits</a>
    </p>
    @if(session('product_created'))
        <p>{{ session('product_created') }}</p>
    @elseif(session('product_updated'))
        <p>{{ session('product_updated') }}</p>
    @endif

    <table>
        <thead>
            <td>Id</td>
            <td>Nom du produit</td>
            <td>Description</td>
            <td class="price">Prix</td>
            <td>Stock</td>
            <td>Promotion</td>
            <td>Image</td>
            <td>Action</td>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <a href="{{ route('product.show', ['slug' => $product->slug, 'product_id' => $product->id ]) }}">{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->description }}</td>
                    <td class="price">{{ number_format($product->price , 2, '.', ' ') }}Ar</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ isset($product->promo) && $product->promo != 0 ? $product->promo . "%": 'pas de promo' }}</td>
                    <td>
                        <a target="_blank" href="{{ $product->getImageUrl() }}">
                            Voir
                        </a>
                    </td>
                    <td class="action">
                        <a class="edit-btn" href="{{ route('admin.product.edit', ['product_id' => $product->id ]) }}">Modifier</a>
                        <form  class="remove-form" action="{{ route('admin.product.delete') }}" method="POST">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <input type="submit" value="Supprimer">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $products->links('vendor.pagination.custom') }}
@endsection