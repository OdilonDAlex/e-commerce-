@vite(['resources/css/admin/dashboard.css', 'resources/js/admin/chart.js'])

<x-admin-page-layout>
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
    <div class="income">
        <canvas class="chart-bar"></canvas>
    </div>
</x-admin-page-layout>