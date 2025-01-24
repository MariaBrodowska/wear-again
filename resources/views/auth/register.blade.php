<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-white font-bold text-2xl pb-4">Rejestracja</div>

        <!-- Name -->
        <div>
            <x-text-input placeholder="Nazwa użytkownika" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input placeholder="Hasło" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            @error('password')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input placeholder="Powtórz hasło" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
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
