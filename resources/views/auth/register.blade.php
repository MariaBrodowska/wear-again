<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-white font-bold text-2xl pb-4">Rejestracja</div>
        <!-- Name -->
        <div>
{{--            <x-input-label for="name" :value="__('Name')" />--}}
            <x-text-input placeholder="Nazwa użytkownika" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
{{--            <x-input-label for="email" :value="__('Email')" />--}}
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
{{--            <x-input-label for="password" :value="__('Password')" />--}}

            <x-text-input placeholder="Hasło" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

            <x-text-input placeholder="Powtórz hasło" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <x-primary-button class="mt-7 mb-2 py-3 w-full text-center justify-center rounded-xl">
            {{ __('Zarejestruj się') }}
        </x-primary-button>
        <div class="flex items-center justify-center mt-4 text-sm text-white">
            <span class="mx-1 font-thin">Masz już konto?</span>
            <a class="hover:text-white/70 font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Zaloguj się') }}
            </a>
        </div>
    </form>
</x-guest-layout>
