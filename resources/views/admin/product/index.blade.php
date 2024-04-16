@extends('base')

@section('title', 'Administration - Listes des produits')

@vite('resources/css/admin/table.css')

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
            <td>Prix ( sans promo )</td>
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
                    <td>{{ number_format($product->price , 2, '.', ' ') }}Ar</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ isset($product->promo) && $product->promo != 0 ? $product->promo . "%": 'pas de promo' }}</td>
                    <td>
                        <a target="_blank" href="{{ $product->getImageUrl() }}">
                            Voir
                        </a>
                    </td>
                    <td class="action">
                        <a class="edit-btn" href="{{ route('admin.product.edit', ['product_id' => $product->id ]) }}">Modifier</a>
                        <a class="remove-btn" href="">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $products->links() }}
@endsection