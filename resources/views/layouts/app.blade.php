<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div id="app">
        <nav class="bg-black p-6">
            <div class="container mx-auto flex justify-between items-center">
                <a class="text-white text-2xl" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="lg:hidden">
                    <button class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex flex-grow items-center justify-center space-x-4">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Add your left side navbar items here -->
                    </ul>

                    <!-- Center of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('contratos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mt-4">Contratos</a>
`
                            <a href="{{ route('provisiones.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mt-4">Provisiones</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->

                </div>
            </div>
        </nav>

        <main class="bg-gray-300 py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
