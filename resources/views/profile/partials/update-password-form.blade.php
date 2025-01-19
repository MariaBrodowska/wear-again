<section>
    <header>
        <h2 class="text-xl font-bold text-nav-pink">
            {{ __('Zmień hasło') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Upewnij się że twoje konto używa długiego, losowego hasła aby zachować bezpieczeństwo.') }}
        </p>
    </header>
    <hr>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-input-label for="update_password_current_password" :value="__('Obecne hasło')"/>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password"  placeholder="{{ __('Aktualne hasło') }}"/>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="update_password_password" :value="__('Nowe hasło')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password"  placeholder="{{ __('Nowe hasło') }}"/>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Potwierdź hasło')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="{{ __('Nowe hasło') }}"/>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
            <button class="inline-flex items-center px-6 py-3 my-1 mx-0 border-none bg-nav-gray2 text-sm font-medium leading-5 text-pink-300 hover:text-white hover:bg-nav-pink focus:outline-none rounded-3xl hover:rounded-md focus:text-white focus:border-gray-300 transition-all duration-800 ease-linear">{{ __('Zapisz') }}</button>
        @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Zapisano.') }}</p>
            @endif
        </div>
    </form>
</section>
