@vite('resources/css/admin/sidebar.css')

<aside class="navbar">
    <h3 class="nav-header">Administration</h3>
    <ul class="nav">
        <li class="nav-item {{  request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}" class="nav-link">Tableau de bord</a></li>
        <li class="nav-item"><a href="" class="nav-link">Utilisateurs</a></li>
        <li class="nav-item {{  request()->routeIs('admin.product.index') ? 'active' : '' }} "><a href=" {{ route('admin.product.index') }}" class="nav-link">Produits</a></li>
        <li class="nav-item  {{ request()->routeIs('chat.*') ? 'active' : '' }} "><a  class="nav-link" href="{{ route('chat.index') }}">Messages</a></li>
        <li class="nav-item"><a href="" class="nav-link">Paramètres</a></li>
    </ul>
</aside>