@extends('base')

@section('title', 'Creation de categorie')


@vite('resources/css/flex-center.css')

@section('header')
    @include('header')
@endsection

@section('content')
<form  class="register-form"  action="{{ route('admin.product.category.create') }}" method="POST">
    @csrf

    <h1>Création de categorie</h1>

    <div style="width: 70ch;">
        <x-input label="Nom des categories.Sépare les noms d'une virgule ',' . Pour les noms qui comporte des une ou plusieurs virgules utilise deux virgules  ',,' " name="names"/>

        <x-input type="submit" value="Créer"/>
    </div>
</form>
@endsection

