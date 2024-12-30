@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-5 my-4 mx-0 border-b border-nav-pink bg-nav-gray2 text-sm font-medium leading-5 text-pink-100 hover:text-white focus:outline-none hover:bg-nav-pink focus:border-nav-pink rounded-3xl hover:rounded-md transition-all duration-800 ease-linear'
            : 'inline-flex items-center px-4 py-5 my-4 mx-0 border-none bg-nav-gray2 text-sm font-medium leading-5 text-nav-pink hover:text-white hover:bg-nav-pink focus:outline-none rounded-3xl hover:rounded-md focus:text-white focus:border-gray-300 transition-all duration-800 ease-linear';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
