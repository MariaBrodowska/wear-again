<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 my-1 mx-0 border-none bg-nav-gray2 text-sm font-medium leading-5 text-pink-300 hover:text-white hover:bg-nav-pink focus:outline-none rounded-3xl hover:rounded-md focus:text-white focus:border-gray-300 transition-all duration-800 ease-linear']) }}>
    {{ $slot }}
</button>
