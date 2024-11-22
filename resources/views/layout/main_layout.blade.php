<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

</head>
<body>
<nav>
        <
        <div id="">
            <ul>
                {{-- Voor niet-ingelogde gebruikers (gast) (Gaby) --}}
                @guest
                    <li class=""><a href="{{ url('home') }}">Home</a></li>
                    <li class=""><a href="{{ route('login') }}">Log In</a></li>
                    <li class=""><a href="{{ route('register') }}">Register</a></li>
                @endguest
        
                {{-- Voor ingelogde gebruikers (geen admin) (Gaby) --}}
                @auth
                    @if (Auth::user()->email !== 'uneedit-admin@gmail.com')
                        <li class=""><a href="{{ url('home') }}">Home</a></li>
                        <button class="">Account</button>
                            <div class="dropdown-content">
                            <li class=""><a href="{{ url('edit') }}">Edit</a></li>
                            <li class=""><a href="{{ url('status') }}">Status</a></li>
  
                        

                        <li class="">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">  Log Out   </a>
                        </li>
                        <form id="" action="" method="POST">    @csrf </form>
                    @endif
                @endauth
        
                {{-- Voor de admin gebruiker (Gaby) --}}
                @auth
                    @if (Auth::user()->email !== 'uneedit-admin@gmail.com')
                        <li class=""><a href="{{ url('home') }}">Home</a></li>
                        <li class=""><a href="{{ url('account_edit') }}">Account Edit</a></li>
                        <button class="">Record</button>
                            <div class="">
                            <li class=""><a href="{{ url('player') }}">Player</a></li>
                            <li class=""><a href="{{ url('score') }}">Score</a></li>
                        

                        <li class="">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">  Log Out   </a>
                        </li>
                        <form id="" action="" method="POST">    @csrf </form>
                        
                    @endif
                @endauth
    
            </ul>
        </div>
    </nav>
    

    <!-- Inhoud dat op de pagina komt te staan (Gaby) -->
    <div class="">
        @yield ('content')
    </div>



  <!--Hier wordt de footer ingeladen (Gaby) -->
     <footer>
    
     </footer>
</body>
</html>
