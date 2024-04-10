@extends('base')

@section('title', 'Administration - Listes des produits')

@section('content')

    <table>
        <thead>
            <td>Identifiant</td>
            <td>Nom du produit</td>
            <td>Description</td>
            <td>Prix ( en Ar )</td>
            <td>Stock</td>
            <td>Promotion ( en % )</td>
            <td>Image</td>
            <td>Action</td>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->promo }}</td>
                    <td>
                        <a target="_blank" href="{{ $product->getImageUrl() }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>
                        <a href="">Modifier</a>
                        <a href="">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $products->links() }}
@endsection