<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-application-title/>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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

    {{-- nawigacja --}}
    <nav class="relative">
        <a
            href="{{ url('/') }}"
            class="flex items-center justify-center ml-4 w-12 h-12 bg-pink-300 text-black rounded-full shadow-lg border-2 border-pink-300 hover:bg-transparent hover:text-pink-300 hover:border-pink-300 transition-all duration-500 group"
        >
            <svg
                class="w-6 h-6 group-hover:-translate-x-1 transition-transform duration-500"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </nav>

    {{-- zaloguj/zarejestruj --}}
    @if (Route::has('login'))
        <nav class="relative flex-1 text-right">
            @auth
                <a
                    href="{{ url('/offers') }}"
                    class="relative inline-block px-3 py-2 overflow-hidden group border-transparent transition-all duration-500">
                    <span class="transition-all group-hover:text-pink-200">Strona główna</span>
                    <span class="absolute inset-0 border-b-2 border-pink-300 transform scale-x-0 origin-left transition-all duration-500 group-hover:scale-x-100"></span>
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="relative inline-block px-3 py-2 overflow-hidden group border-transparent transition-all duration-500">
                    <span class="transition-all group-hover:text-pink-200">Zaloguj się</span>
                    <span class="absolute inset-0 border-b-2 border-pink-300 transform scale-x-0 origin-left transition-all duration-500 group-hover:scale-x-100"></span>
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
</div>

{{-- logo --}}
<div class="absolute top-3 left-1/2 transform -translate-x-1/2 z-30">
    <x-application-logo classes="w-22 h-20"/>
</div>

<div id="container" class="relative flex flex-col items-center text-white pt-20 px-5">
    <h1 class="text-6xl font-bold mt-4 mb-6">O nas</h1>
    <p class="text-lg max-w-4xl text-center mb-6">
        Jesteśmy zespołem pasjonatów, którzy łączą miłość do mody z troską o naszą planetę. Wierzymy, że każda rzecz zasługuje na drugie życie, a nasza platforma, Wear Again, powstała z myślą o tych, którzy pragną odświeżyć swoją szafę, jednocześnie dbając o środowisko.
    </p>
    <p class="text-lg max-w-4xl text-center mb-6">
        Naszą misją jest walka z marnotrawstwem w przemyśle odzieżowym. Umożliwiamy sprzedaż i zakup używanych ubrań online, promując w ten sposób zrównoważony i świadomy sposób konsumowania mody.
    </p>
    <p class="text-lg max-w-4xl text-center">
        Dołącz do naszej społeczności i bądź częścią ruchu, który zmienia przyszłość mody na lepsze! Razem możemy tworzyć świat, w którym każdy wybór ma znaczenie.
    </p>
</div>

<div id="social-media" class="flex justify-center space-x-8 mt-10">
    <a href="https://www.facebook.com" target="_blank" aria-label="Facebook" class="w-12 h-12 bg-pink-300 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-pink-700 transition-all duration-300 transform hover:scale-110">
        <ion-icon name="logo-facebook" class="text-2xl"></ion-icon>
    </a>
    <a href="https://www.instagram.com" target="_blank" aria-label="Instagram" class="w-12 h-12 bg-pink-300 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-pink-700 transition-all duration-300 transform hover:scale-110">
        <ion-icon name="logo-instagram" class="text-2xl"></ion-icon>
    </a>
    <a href="https://www.twitter.com" target="_blank" aria-label="Twitter" class="w-12 h-12 bg-pink-300 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-pink-700 transition-all duration-300 transform hover:scale-110">
        <ion-icon name="logo-twitter" class="text-2xl"></ion-icon>
    </a>
</div>

</body>
</html>
