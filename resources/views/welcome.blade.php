<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WearAgain</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-white">
<div id="background" class="absolute left-0 top-0 h-full w-full">
    <img class="object-cover h-full w-full bg-center bg-repeat brightness-75" src="{{ asset('assets/img/background.png') }}" alt="background">
    <div class="absolute inset-0 bg-gradient-to-t from-transparent to-black opacity-50"></div>
    <div class="absolute inset-0 blur-lg bg-gradient-to-t from-transparent via-black to-transparent opacity-70"></div>

    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-30 rounded-lg"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black to-transparent opacity-30 rounded-lg"></div>
    <div class="absolute inset-0 bg-gradient-to-l from-black to-transparent opacity-20 rounded-lg"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black to-transparent opacity-20 rounded-lg"></div>

</div>
<div id="nawigacja" class="flex items-center justify-between mx-5 my-8 relative z-20">
    {{--o nas--}}
    <nav class="relative">
        <a
            href="{{ route('login') }}"
            class="relative inline-block px-3 py-2 overflow-hidden group border-transparent transition-all duration-500">
            <span class="transition-all group-hover:text-pink-200">O nas</span>
            <span class="absolute inset-0 border-b-2 border-pink-300 transform scale-x-0 origin-left transition-all duration-500 group-hover:scale-x-100"></span>
        </a>
    </nav>

    {{--szukaj--}}
    <nav class="relative flex items-center space-x-2">
        <form action="" method="GET" class="relative justify-start">
            <input class="ml-2 sm:max-w-28 sm:py-1.5 lg:max-w-96 lg:ml-6 overlay_search-input text-black focus:border-none focus:ring-0" name="query" placeholder="Wyszukaj przedmioty" type="text">
            <button
                type="submit"
                class="mr-2 lg:px-6 sm:px-3 sm:py-2 border text-sm border-pink-300 px-4 py-2.5 hover:text-black/70 hover:bg-pink-300 hover:rounded-xl transition-all duration-500"
            >Szukaj
            </button>
        </form>
    </nav>

    {{--zaloguj/zarejestruj--}}
    @if (Route::has('login'))
        <nav class="relative flex-1 text-right">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Strona główna
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="relative inline-block px-3 py-2 overflow-hidden group border-transparent transition-all duration-500">
                    <span class="transition-all group-hover:text-pink-200">Zaloguj się</span>
                    <span class="absolute inset-0 border-b-2 border-pink-300 transform scale-x-0 origin-left transition-all duration-500 group-hover:scale-x-100"></span>
                </a>
                </a>
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                    class="relative inline-block px-3 py-2 overflow-hidden group border-transparent transition-all duration-500">
                        <span class="transition-all group-hover:text-pink-200">Zarejestruj</span>
                        <span class="absolute inset-0 border-b-2 border-pink-300 transform scale-x-0 origin-left transition-all duration-500 group-hover:scale-x-100"></span>
                    </a>
                @endif
            @endauth
        </nav>
    @endif
    {{--logo--}}
</div>
<div class="absolute top-3 left-1/2 transform -translate-x-1/2 z-30">
    <a href="{{url('/dashboard')}}">
        <img class="w-22 h-20" src="{{ asset('assets/img/logo4.png') }}" alt="logo">
    </a>
</div>
<div id="container" class="relative flex flex-col items-center text-white pt-20">
    <p class="text-6xl font-bold mt-4 mb-3">Wear Again</p>
    <p class="text-md mt-4">Czas na zmiany w szafie? Sprzedaj, co nie nosisz już od lat i zyskaj na nowo!</p>
    <p class="text-md mt-1">Zrób miejsce na świeże inspiracje.</p>

    <a
        href="{{ route('register') }}"
        class="border-2 text-md border-pink-300 px-10 p-2 my-10 ring-1 ring-transparent hover:text-black/70 hover:bg-pink-300 hover: hover:rounded-3xl focus:outline-none focus-visible:ring-[#FF2D20] transition-all duration-700"
    >
        Sprzedaj już teraz!
    </a>
</div>
</body>
</html>
