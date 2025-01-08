@vite('resources/css/header.css')

@php
    $cart = null;
    if(Auth::check()){
        $cart = Auth::user()->carts()->first();
        if($cart == null){
            $cart = Auth::user()->carts()->create();

            Auth::user()->carts()->associate($cart);
            
            Auth::user()->save();
        }

        $items_count = 0;

        $items_count = count(Auth::user()->carts()->first()->items()->get()->toArray());
    }


@endphp

<!-- Bar de navigation -->
<header class="navbar-container">

    <button class="menu">
        @include('svg.menu')
    </button>
    
    <button class="session">
        @include('svg.user')
    </button>
    <div class="brand-logo">
        {{-- <img src="{{ Storage::disk('public')->url('logo.png') }}" alt="Logo" width="20" height="48"> --}}
        <h1>LOGO</h1>
    </div>
        <navbar>
            <ul class="nav">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : ''}}"><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>

                <li class="nav-item {{ request()->routeIs('product.show') || request()->routeIs('product.index') ? 'active' : '' }}"><a href="{{ route('product.index') }}" class="nav-link">Produit</a></li>
                
                <li class="nav-item {{ request()->routeIs('cart.index') ? 'active' : ''}}"><a href="{{ route('cart.index') }}" 
                
                class="nav-link">Panier
                @auth
                    <span class="cart-items-count"
                    >{{ $items_count }}</span>
                @endauth
                </a></li>
                @auth
                <li class="nav-item {{ request()->routeIs('history') ? 'active' : '' }}"><a href="{{ route('history') }}" class="nav-link">Historique
                    @php
                        $unReadNotifNumber = count( Auth::user()->unReadNotifications()->get() );
                    @endphp 
                    <span class="notification-count"
                        @if($unReadNotifNumber <= 0)
                            style="display: none;" 
                        @endif
                    >{{ $unReadNotifNumber }}</span></a></li>
                @endauth
                <li class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"><a href="{{ route('profile.index') }}" class="nav-link">Profil</a></li>
                @auth
                @if(Auth::user()->isAdmin())
                <li class="nav-item nav-dropdown {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <span>
                        Admin<svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        </span>
                    </a>
                    <div class="big-menu">
                        <button class="admin-dashboard" onclick="window.location.href = `${window.origin}/admin/`">
                            <div class="dashboard-illustration">
                                @include('svg.dashboard')
                            </div>
                            <h1>Tableau de bord</h1>
                        </button>
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
                                    <a href="{{ route('admin.product.category.create') }}" class="nav-link create-category">Créer des catégories</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.index') }}" class="nav-link">Listes des produits</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </li>
                @endif
                @endauth
            </ul>
        </navbar>
        <div class="anchor"></div>
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