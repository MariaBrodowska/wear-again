<nav x-data="{ open: false }" class="bg-nav-gray1 sticky top-0  border-b border-gray-700 z-20">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-between h-16">
            <div class="flex w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-application-logo classes="w-15 h-12 mr-4"/>
                </div>
                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ms-10 flex w-full justify-between">
                    <x-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.index')">
                        {{ __('Strona główna') }}
                    </x-nav-link>
                    <div class="relative">
                        <x-nav-link :href="route('login')" class="h-10 mr-2">
                            {{ __('Zaloguj się') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" class="h-10">
                            {{ __('Zarejestruj się') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</nav>
{{--NAWIGACJA DO OFFERS--}}
