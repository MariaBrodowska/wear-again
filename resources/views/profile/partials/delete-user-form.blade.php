<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-nav-pink">
            {{ __('Usuń konto') }}
        </h2>
    <hr>
        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Po usunięciu konta wszystkie powiązane z nim zasoby i dane zostaną trwale usunięte. Przed usunięciem konta pobierz wszelkie dane lub informacje, które chcesz zachować.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Usuń konto') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Czy jesteś pewny(a), że chcesz usunąć konto?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Po usunięciu konta wszystkie powiązane z nim zasoby i dane zostaną trwale usunięte. Wprowadź swoje hasło, aby potwierdzić, że chcesz trwale usunąć swoje konto.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Hasło') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Zamknij') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Usuń konto') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
