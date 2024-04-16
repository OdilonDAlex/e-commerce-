@extends('base')

@section('title', 'Accueil')

@section('content')

@if(session('new-user'))
    <p>{{ session('new-user') }}</p>
@else
    <div class="welcome-illustration">
        <div class="welcome-text">
            <h3>
                @auth
                    Bonjour <span class="username">{{ Auth::user()->name }}</span>. Que souhateriaient-vous acheter aujourd'hui ? 
                @endauth
            </h3>
        </div>

        <form action="" method="POST" name="search-bar" class="search-bar">
            @csrf

            <input type="text" name="search_bar" id="search_bar">
            <input type="submit" value="Rechercher">
        </form>
    </div>
    <hr>
    
    <div class="find-by-categories">
        <h5>Trouver vos produits a partir des categories</h5>
    </div>
@endif


@endsection