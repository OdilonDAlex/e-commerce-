<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Bar de navigation -->
    <header class="navbar-container">
        <div class="brand-logo">
            <img src="../../storage/app/public/logo.png" alt="Logo">
        </div>
        <navbar>
            <ul class="nav">
                    <li class="nav-item"><a href="" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Panier</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Activité</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Historique</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Profil</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Préference</a></li>
                    @auth
                        <li class="nav-item"><a href="" class="nav-link">Admin</a></li>
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
                <button>S'inscrire</button>
                <button>Se Connecter</button>
            @endguest
        </div>
    </header>
    @yield('content')
    <footer></footer>
</body>
</html>