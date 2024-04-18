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
    @yield('header')
    <!-- Contenu principale -->
    <section class="content">
        @yield('content')

        @auth
            <div class="message-collapse">
                <button class="collapse-btn">+</button>
            </div>
        @endauth
    </section> 

    <!-- Pied de page -->
    <footer></footer>
</body>
</html>