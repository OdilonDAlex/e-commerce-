@extends('base')

@section('title', 'Creation de categorie')

@section('content')
    <form action="{{ route('admin.product.category.create') }}" method="POST">
        @csrf

        <label for="names">Nom des categories ( séparé par des espaces )</label><br>
        <input type="text" name="names" id="names">

        <input type="submit" value="Créer">
    </form>
@endsection