<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
</head>
<body>
<nav>
    <div>
        <ul>
            {{-- Voor niet-ingelogde gebruikers --}}
            @guest
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Log In</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endguest

            {{-- Voor ingelogde gebruikers --}}
            @auth
                @if (Auth::user()->admincode == '222222')
                    {{-- Admin navigatie --}}
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li><a href="{{ url('account_edit') }}">Account Edit</a></li>
                    <button>Record</button>
                    <div>
                        <li><a href="{{ url('player') }}">Player</a></li>
                        <li><a href="{{ url('score') }}">Score</a></li>
                    </div>
                    <li>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Log Out</a>
                    </li>
                    <form id="logout_form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    {{-- Gebruiker navigatie --}}
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <button>Account</button>
                    <div class="dropdown-content">
                        <li><a href="{{ url('edit') }}">Edit</a></li>
                        <li><a href="{{ url('status') }}">Status</a></li>
                    </div>
                    <li>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Log Out</a>
                    </li>
                    <form id="logout_form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            @endauth
        </ul>
    </div>
</nav>

<!-- Inhoud dat op de pagina komt te staan -->
<div>
    @yield('content')
</div>

<footer>
    <!-- Footer content -->
</footer>
</body>
</html>
