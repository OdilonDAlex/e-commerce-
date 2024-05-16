<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/css/message.css',
            'resources/css/footer.css',
        ])
</head>
<body>

    @auth
        <input id="authenticated_user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    @endauth

    

    @yield('header')
    <!-- Contenu principale -->
    
    @auth
        @if(session('new-user'))
            <p>{{ session('new-user') }}</p>
        @endif

    @endauth
    <section class="content">

        @yield('content')

        @auth
            @php
                $allMessages = App\Models\Message::whereRaw('author_id = ' . Auth::user()->id  . ' OR receiver_id = ' . Auth::user()->id)->get();
            @endphp
            @if(Auth::user()->role != "admin")
                <div class="message-collapse">

                    <x-message-container  receiver_id="{{ Auth::user()->id }}" :messages=$allMessages conversation-with="Conversation entre vous et l'administrateur"/>
                    <button class="collapse-btn">
                        @include('svg.message')
                    </button>
                </div>
            @endif
        @endauth
    </section> 

    <div class="quick-action">
        <button class="scrollToTop" onclick="scrollTo(0, 0);">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
        </button>
        <div class="send-email">
            <div>
                <label for="">Vous avez des questions ? </label><br>
                <input type="text" name="" id="" placeholder="votre question....">
            </div>
            <input type="submit" value="Envoyer">
        </div>
    </div>
    <!-- Pied de page -->
    <footer>
        <div class="links">
            <h1 class="title">Lien rapide</h1>
            <ul>
                @guest
                    <li><a href="{{ route('register') }}">S'inscrire</a></li>
                    <li><a href="{{ route('login') }}">Se connecter</a></li>
                @endguest
                <li><a href="{{ route('product.index') }}">Tous nos produits</a></li>
                @auth
                    <li><a href="">Profil</a></li>
                    <li><a href="">Panier</a></li>
                    @if(Auth::user()->role == 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
                    @endif
                @endauth

            </ul>
        </div>
        <div class="projects-info">
            <h1 class="title">A propos</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem fuga repellendus ratione perspiciatis consectetur, harum, sint sapiente voluptate repellat explicabo doloribus, placeat quidem quasi ullam quaerat debitis natus labore veritatis.
            Cupiditate rem illo molestias ipsa, quidem id veniam illum eaque eius non quos deleniti alias recusandae cumque atque itaque obcaecati soluta voluptas sit! Corrupti repellat provident ipsum obcaecati blanditiis facilis?</p>
        </div>
        <div class="contact">
            <h1 class="title">Contact</h1>
            
            <ul>
                <li><a href="mailto:odilondalex2600@gmail.com">Adresse email</a></li>
                <li><a href="www.facebook.com/odilondalex2600">Facebook</a></li>
                <li><a href="githu.com/OdilonDAlex">Github</a></li>
                <li><a href="tel:+261341257910">+261341.....</a></li>
            </ul>
            
        </div>
    </footer>
    <p style="margin: 10px 0px 5px 0px; background-color: var(--navbar-bg); text-align: center; margin:0px auto;">copyright &copy; 2024</p>
</body>
</html>