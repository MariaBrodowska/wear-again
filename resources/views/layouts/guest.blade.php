<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    {{--ruchome tlo--}}
    <div class="h-screen w-full bg-cover animate-moveBackground" style="background-image: url({{ asset('assets/img/user6.png') }});">
        <div class="h-screen w-full bg-cover animate-moveBackground2" style="background-image: url({{ asset('assets/img/user22.png') }}); background-size: 800px 500px;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
{{--            <div>--}}
{{--                <a href="/">--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="box w-full sm:max-w-md mt-6 px-6 pt-14 pb-6 rounded-xl border-b-white bg-[rgba(255,255,255,0.1)] overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </div>
    </div>
    </body>
</html>
