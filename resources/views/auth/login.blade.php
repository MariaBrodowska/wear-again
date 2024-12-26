<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-white font-bold text-2xl pb-4">Logowanie</div>

        <!-- Email Address -->
        <div>
{{--            <x-input-label for="email" :value="__('Email')" />--}}
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
{{--            <x-input-label for="password" :value="__('Password')" />--}}

            <x-text-input placeholder="Hasło" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-2">
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer hover:text-white/70">
                <input id="remember_me" type="checkbox" class="mb-6 rounded bg-white border-gray-300 border-b-white text-pink-300 shadow-sm focus:ring-pink-300 dark:focus:ring-pink-300 dark:focus:ring-offset-gray-800 cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-white hover:text-white/70">{{ __('Zapamiętaj mnie') }}</span>
            </label>
        </div>
        @if (Route::has('password.request'))
            <a class="text-sm text-white hover:text-white/70 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Zapomniałeś hasła?') }}
            </a>
        @endif
        </div>
        <x-primary-button class="w-full mb-5 mx-0 text-center justify-center py-3 rounded-xl">
            {{ __('Zaloguj się') }}
        </x-primary-button>
        <span class="ms-2 font-thin text-sm text-white">Nie masz konta?</span>
        <a class="text-sm font-bold text-white hover:text-white/70 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
            {{ __('Zarejestruj się') }}
        </a>
    </form>
</x-guest-layout>
