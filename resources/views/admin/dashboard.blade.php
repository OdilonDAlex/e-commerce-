@extends('base')

@section('title', 'Administration - tableau de bord')

@vite(['resources/css/admin/dashboard.css', 'resources/js/admin/chart.js'])

@section('header')
    @include('header')
@endsection('header')

@section('content')

    @include('admin.sidebar')

    <div class="main-content">

        <h5 class="section-title">Produits</h5>
        <div class="products">
            
            <!-- Nombre de produits -->
            <x-admin.mini-card :value="$products_count" title="produit(s) au total" action-link="" svg="product"/>
            
            <!-- Nombre de category -->
            <x-admin.mini-card :value="$categories_count" title="différente(s) categorie(s)" action-link="" svg="category"/>
            
            <!-- Produits en rupture de stock -->
            <x-admin.mini-card :value="$unavaible_products" title="produit(s) en rupture de stock" action-link="" svg="stock-out"/>
        </div>
        
        <h5 class="section-title">Utilisateurs</h5>
        <div class="users">
            <!-- Nombre d'Utilisateurs -->
            <x-admin.mini-card :value=$users_count title="Utilisateur(s) inscrit" action-link="" svg="user"/>
        </div>
        
        <h5 class="section-title">Diagramme Statistique</h5>
        <div class="charts">
            <canvas class="chart-bar"></canvas>
        </div>
    </div>
    <aside class="activity-container">
        <div class="activity"></div>
        <div class="top-product"></div>
        right aside
    </aside>

@endsection