@extends('base')

@php
    $creation = $product == null;
    $title =  $creation ? 'Creation de produit' : 'Modification de produit';
@endphp

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>

<form  enctype="multipart/form-data" action="{{ $creation ? route('product.store') : route('product.update', ['product_id' => $product->id]) }}" method="POST">
    @csrf

    <!-- Category -->
    @php 
        $product_categories_id = $product->categories()->pluck('name', 'id');
    @endphp
    <div>
        <label for="categories_id">Categories: </label><br>
        <select name="categories_id[]" id="categories_id" multiple>
            @foreach($categories as $id => $value)
                
                <option value="{{ $id }}"
                    @selected($product_categories_id->contains($value))
                >
                {{ $value }}</option>
            @endforeach
        </select>
    </div>
    <!-- name -->
    <div>
        <label for="name">Nom du produit</label><br>
        <input type="text" name="name" id="name" value="{{ $creation ? '' : $product->name }}">
    </div>

    <!-- prix -->
    <div>
        <label for="price">Prix</label><br>
        <input type="number" name="price" id="price" value="{{ $creation ? '' : $product->price }}">
    </div>

    <!-- Stock -->
    <div>
        <label for="stock">Stock</label><br>
        <input type="number" name="stock" id="stock" value="{{ $creation ? '' : $product->stock }}">
    </div>

    <!-- description -->
    <div>
        <label for="description">description</label><br>
        <input type="text" name="description" id="description" value="{{ $creation ? '' : $product->description }}">
    </div>

    <!-- PROMO -->
    <div>
        <label for="promo">promo</label><br>
        <input type="number" max="100" min="0" name="promo" id="promo" value="{{ $creation ? '' : $product->promo }}">
    </div>

    <!-- image -->
    @if(! $creation )
        <img src="{{ $product->getImageUrl() }}" alt="">
    @endif


    <label for="image">Image de remplacement: </label>
    <input type="file" name="image" id="image">
    <input type="submit" value="{{ $creation ? 'Créer' : 'Modifier'}}">
</form>

@endsection