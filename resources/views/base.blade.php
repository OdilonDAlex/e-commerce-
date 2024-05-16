<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/css/message.css'
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

    <!-- Pied de page -->
    <footer>
        <div class="links">

        </div>
        <div class="about-us">

        </div>
    </footer>
</body>
</html>