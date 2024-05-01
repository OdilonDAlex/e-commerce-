@extends('base')

@php
    $creation = $product == null;
    $title = $creation ? 'Creation de produit' : 'Modification de produit';
@endphp

@section('title', $title)

@vite(['resources/css/product/create.css', 'resources/css/form.css'])

@section('header')
@include('header')
@endsection

@section('content')
<div class="create-product">
    <h1>{{ $title }}</h1>

    <form enctype="multipart/form-data" action="{{ $creation ? route('admin.product.store') : route('admin.product.update', ['product_id' => $product->id]) }}" method="POST">
        @csrf

        <!-- Category -->
        @if(! $creation)
            @php
                $product_categories_id = $product->categories()->pluck('name', 'id');
            @endphp
        @endif
        <div>
            <label for="categories_id">Categories </label><br>
            <select name="categories_id[]" id="categories_id" multiple>
                @foreach($categories as $id => $value)

                <option value="{{ $id }}" @if(! $creation) @selected($product_categories_id->contains($value))
                    @endif
                    >
                    {{ $value }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- name -->
        <x-input label="Nom du produit" type="text" name="name" value="{{ $creation ? '' : $product->name }}" 
        />

        <!-- prix -->
        <x-input label="Prix" type="number" name="price" id="price" value="{{ $creation ? '' : $product->price }}"/>

        <!-- Stock -->
        <x-input label="Stock" type="number" name="stock" id="stock" value="{{ $creation ? '' : $product->stock }}"/>

        <!-- description -->
        <div>
            <label for="description">description</label><br>
            <textarea name="description" id="description" cols="30" rows="3">{{ $creation ? '' : $product->description }}</textarea>
        </div>

        <!-- PROMO -->
        <x-input label="promo" type="number" max="100" min="0" name="promo" id="promo" value="{{ $creation ? '' : $product->promo }}"/>
        
        <!-- image -->
        <label for="image">{{ $creation ? 'Image' : 'Image de remplacement' }} </label>
        <input type="file" name="image" id="image">

        <x-input type="submit" value="{{ $creation ? 'Créer' : 'Modifier'}}"/>
    </form>
</div>

@endsection