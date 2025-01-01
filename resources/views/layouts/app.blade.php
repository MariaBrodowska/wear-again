<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <x-application-title/>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    {{--tło--}}
    <div id="background" class="absolute left-0 top-0 h-full w-full z-0">
        <img class="object-cover h-full w-full bg-center bg-repeat filter blur-sm" src="{{ asset('assets/img/background.png') }}" alt="background">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
        <div class="min-h-screen relative z-20">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-nav-gray1 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    </body>
</html>
{{--STRONA OFFERS--}}
