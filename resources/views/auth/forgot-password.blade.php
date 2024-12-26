<x-guest-layout>
    <div class="mb-4 text-sm text-white">
        {{ __('Zapomniałeś hasła? Nie ma problemu. Podaj nam swój adres e-mail, a my wyślemy Ci link do resetowania hasła, który pozwoli Ci wybrać nowe.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
{{--            <x-input-label for="email" :value="__('Email')" />--}}
            <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4" >
            <x-primary-button class="justify-center mt-4 py-3 w-full rounded-xl">
                {{ __('Wyślij link do resetowania hasła') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
