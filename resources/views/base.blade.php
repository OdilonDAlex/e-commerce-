<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/css/header.css',
            'resources/css/message.css'
        ])
</head>
<body>
    <!-- Bar de navigation -->
    <header class="navbar-container">
        <div class="brand-logo">
            <img src="{{ Storage::disk('public')->url('logo.png') }}" alt="Logo">
        </div>
        <navbar>
            <ul class="nav">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : ''}}"><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Produit</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Panier</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Historique</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Profil</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Préference</a></li>
                    @auth
                        <li class="nav-item nav-dropdown {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            <a href="" class="nav-link ">Admin</a>
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
                                            <a   href="" class="nav-link">Statistiques</a>
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
                                            <a   href="" class="nav-link">Visiteurs</a>
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
                                            <a   href="" class="nav-link">Statistiques</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </li>
                    @endauth
            </ul>
        </navbar>
        <div class="session-info">
            @auth
                <span>{{ Auth::user()->name }}</span>
                <form  action="{{ route('logout') }}" method="POST">
                    @method('delete')
                    @csrf

                    <input class="logout-btn" type="submit" value="Se déconnecter">
                </form>
            @endauth
            @guest
                <!-- inscription -->
                <form  action="{{ route('register') }}" method="GET">

                    <input id="register-btn" type="submit" value="S'inscrire">
                </form>

                <!-- Connexion -->
                <form  action="{{ route('login') }}" method="GET">

                    <input id="login-btn" type="submit" value="Se connecter">
                </form>
            @endguest
        </div>
    </header>
    <div class="transition-test">
        
    </div>
    <section class="content">
        @yield('content')

        @auth
            <div class="message-collapse">
                <button class="collapse-btn">Contacter l'administrateurs</button>
            </div>
        @endauth
    </section> 
    <footer></footer>
</body>
</html>