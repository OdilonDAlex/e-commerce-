@vite('resources/css/header.css')

@php
    if(Auth::check()){
        $cart = Auth::user()->carts()->first();
    }
@endphp

<!-- Bar de navigation -->
<header class="navbar-container">
    <div class="brand-logo">
        <img src="{{ Storage::disk('public')->url('logo.png') }}" alt="Logo">
    </div>
        <ul class="nav">
            <li class="nav-item {{ request()->routeIs('home') ? 'active' : ''}}"><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a href="" class="nav-link">Produit</a></li>
            @auth
            <li class="nav-item {{ request()->routeIs('cart.index') ? 'active' : ''}}"><a href="{{ route('cart.index') }}" 
            
            class="nav-link">Panier
            @if($cart != null) 
                <span class="cart-items-count">{{ count( $cart->items()->get()->toArray() )}}</span>
            @endif
            </a></li>
            @endauth
            <li class="nav-item"><a href="" class="nav-link">Historique</a></li>
            <li class="nav-item"><a href="" class="nav-link">Préference</a></li>
            @auth
            <li class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"><a href="{{ route('profile.index') }}" class="nav-link">Profil</a></li>
            @if(Auth::user()->isAdmin())
            <li class="nav-item nav-dropdown {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                <a href="" class="nav-link ">
                    <span>
                    Admin<svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    </span>
                </a>
                <div class="big-menu">
                    <div class="admin-product-manager">
                        <h1>Produits</h1>
                        <ul class="big-menu-nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.product.create') }}" class="nav-link">Créer un produit</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product.index') }}" class="nav-link">Listes des produits</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Statistiques</a>
                            </li>
                        </ul>
                    </div>
                    <div class="admin-user-manager">
                        <h1>Utilisateurs</h1>
                        <ul class="big-menu-nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.product.create') }}" class="nav-link">Listes des utlisateurs</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product.index') }}" class="nav-link">Activités</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Visiteurs</a>
                            </li>
                        </ul>
                    </div>
                    <div class="admin-app-manager">
                        <h1>Produits</h1>
                        <ul class="big-menu-nav">
                            <li class="nav-item">
                                <a href="{{ route('admin.product.create') }}" class="nav-link">Créer un produit</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product.category.create') }}" class="nav-link">Créer des catégories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product.index') }}" class="nav-link">Listes des produits</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Statistiques</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </li>
            @endif
            @endauth
        </ul>
    </navbar>
    <div class="session-info">
        @auth
        <span>{{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @method('delete')
            @csrf

            <input class="logout-btn" type="submit" value="Se déconnecter">
        </form>
        @endauth
        @guest
        <!-- inscription -->
        <form action="{{ route('register') }}" method="GET">

            <input id="register-btn" type="submit" value="S'inscrire">
        </form>

        <!-- Connexion -->
        <form action="{{ route('login') }}" method="GET">

            <input id="login-btn" type="submit" value="Se connecter">
        </form>
        @endguest
    </div>
</header>