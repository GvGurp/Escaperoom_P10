


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url(../public/images/Paisajes.gif)] bg-cover bg-center h-screen">
<nav class="border-gray-200 bg-slate-800 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="../public/images/brightened_escape_room_logo.jpg" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-mono whitespace-nowrap dark:text-white">escaperoom</span>
        </a>
        <button data-collapse-toggle="navbar-solid-bg" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-solid-bg" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                @guest
                    {{-- Voor niet-ingelogde gebruikers --}}
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Log In</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Register</a>
                    </li>
                @endguest

                @auth
                    {{-- Voor ingelogde admin(Gaby) --}}
                    @if (auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin_home') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Admin Home</a>
                        <li>
                            <a href="{{ url('account_edit') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Account Edit</a>
                        </li>
                        <li>
                            <a href="{{ url('player') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Player</a>
                        </li>
                        <li>
                            <a href="{{ url('score') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Score</a>
                        </li>

                        </li>
                    @else  {{-- Voor ingelogde gebruikers --}}
                    <li>
                        <a href="{{ route('player.home') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Player Home</a>
                    <li class="relative group">
                        <button class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">
                            Account
                        </button>
                        <ul class="absolute hidden mt-2 w-40 bg-gray-100 rounded shadow-lg p-2 dark:bg-gray-700 group-hover:block">
                            <li>
                                <a href="{{ route('user.edit') }}" class="block py-2 px-3 text-slate-400 rounded hover:bg-gray-200 dark:text-slate-400 dark:hover:bg-gray-600">Edit</a>
                            </li>
                            <li>
                                <a href="{{ url('status') }}" class="block py-2 px-3 text-slate-400 rounded hover:bg-gray-200 dark:text-slate-400 dark:hover:bg-gray-600">Status</a>
                            </li>
                        </ul>
                    </li>

                    </li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}" class="block py-2 px-3 md:p-0 text-slate-400 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white"
                           onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                            Log Out
                        </a>
                        <form id="logout_form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>


<!-- Inhoud dat op de pagina komt te staan -->
<div>
    @yield('content')
</div>



<footer class="bg-slate-800 rounded-lg shadow m-4 dark:bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
      <span class="text-sm text-gray-200 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
    </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-200 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">About</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Contact</a>
            </li>
        </ul>
    </div>
</footer>

</body>
</html>
