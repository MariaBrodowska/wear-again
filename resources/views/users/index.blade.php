<x-app-layout>
    <x-slot name="header">
        <nav class="my-6">
            <form action="{{route('users.index')}}" method="GET" class="flex flex-col items-center justify-start w-full">
                <div class="relative w-full flex justify-center my-6">
                <select name="search_type" class="pl-4 pr-8 py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option value="items" id="items">przedmioty</option>
                    <option value="users" id="users">użytkownicy</option>
                </select>
                <input class="sm:py-1.5 lg:!max-w-5xl w-2/3 overlay_search-input text-black focus:border-none focus:ring-0" name="query" placeholder="Wyszukaj przedmioty lub użytkowników" type="text">
                <button
                    type="submit"
                    class="mr-2 lg:px-10 sm:px-5 sm:py-2 border text-sm text-white border-pink-300 px-4 py-4 hover:text-black/70 hover:bg-pink-300 hover:rounded-xl transition-all duration-500"
                >Szukaj
                </button>
                </div>
                @if(Route::is('users.index') or Route::is('offers.index') )
                    <div id="filters-section" class="relative flex flex-wrap gap-4 w-2/3 justify-center items-center mt-2 mb-7 max-h-0 overflow-hidden transition-all duration-1000 ease-in-out">
                        <select name="category" class="pl-4 pr-8 py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl">
                            <option value="">Wybierz kategorię</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <select name="size" class="pl-4 pr-8 py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl">
                            <option value="">Wybierz rozmiar</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}" {{ old('size') == $size->id ? 'selected' : '' }}>
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        <!--cena-->
                        <input name="min_price" type="number" placeholder="Min cena (zł)" class="ml-4 sm:px-3 sm:py-2 lg:px-5 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('min_price') }}">
                        <input name="max_price" type="number" placeholder="Max cena (zł)" class="ml-4 sm:px-3 sm:py-2 lg:px-5 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('max_price') }}">
                        <!--data-->
                        <div class="flex flex-col items-start gap-3 pb-2">
                            <div class="flex items-center">
                                <label for="date_from" class="text-sm font-medium text-nav-pink">Data od:</label>
                                <input name="date_from" type="date" class="ml-4 sm:py-2 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('date_from') }}">
                            </div>
                            <div class="flex items-center">
                                <label for="date_to" class="text-sm font-medium text-nav-pink">Data do:</label>
                                <input name="date_to" type="date" class="ml-4 sm:py-2 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('date_to') }}">
                            </div>
                        </div>
                        <div class="flex flex-col items-center gap-3 pb-2 ml-3">
                            <!-- Sortowanie -->
                            <select name="sort" class="relative py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl">
                                <option value="">Sortuj według</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Od najnowszych</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Od najstarszych</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Cena: od najniższej</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Cena: od najwyższej</option>
                            </select>
                            <div class="flex items-center">
                                <button
                                    type="button"
                                    onclick="window.location.href='{{ route('offers.index') }}'"
                                    class="relative self-center sm:px-5 sm:py-2 lg:px-10 lg:py-2 border text-sm text-white border-pink-300 px-4 py-4 hover:text-black/70 hover:bg-pink-300 hover:rounded-xl transition-all duration-500"
                                >Wyczyść filtry</button>
                                <!--filtruj-->
                                <button
                                    type="submit"
                                    class="relative self-center ml-5 sm:px-5 sm:py-2 lg:px-10 lg:py-2 border text-sm text-white border-pink-300 px-4 py-4 hover:text-black/70 hover:bg-pink-300 hover:rounded-xl transition-all duration-500"
                                >Filtruj</button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-center">
                        <button
                            type="button"
                            id="toggle-filters-btn"
                            class="px-4 py-1 text-sm flex items-center justify-center bg-nav-pink text-white hover:text-nav-pink hover:bg-nav-gray2 rounded-xl transition-transform duration-300"
                        >Pokaż filtry<ion-icon name="arrow-down-outline" class="ml-1"></ion-icon></button>
                    </div>
                @endif
            </form>
        </nav>
    </x-slot>

    <div class="py-6 pb-10">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @yield('content')
                @if(request('search_type') == 'users')
                    <div class="px-4 bg-nav-gray1 pb-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 pt-4">
                            @foreach($users as $user)
                                <div class="flex flex-col pt-2 bg-gray-100 rounded-sm items-center">
                                    <a href="{{ route('users.show', ['id' => $user->id]) }}" class="h-3/4">
                                        <ion-icon name="person-circle-outline" class="size-12 text-nav-pink"></ion-icon>
                                    </a>
                                    <div class="p-2 text-center">
                                        <h5 class="text-lg font-medium text-gray-700">{{ $user->name }}</h5>
                                        <h5 class="text-sm font-medium text-gray-500">{{ $user->email }}</h5>
                                        <h5 class="text-xs font-medium text-gray-700">Oceny kupujących: </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const toggleFiltersBtn = document.getElementById('toggle-filters-btn');
    const filtersSection = document.getElementById('filters-section');

    toggleFiltersBtn.addEventListener('click', () => {
        if (filtersSection.classList.contains('max-h-0')) {
            filtersSection.style.maxHeight = filtersSection.scrollHeight + "px";
            filtersSection.classList.remove('max-h-0');
            toggleFiltersBtn.innerHTML = 'Schowaj filtry<ion-icon name="arrow-up-outline" class="ml-1"></ion-icon>';
            toggleFiltersBtn.classList.add('translate-y-[-10px]');
        } else {
            filtersSection.style.maxHeight = "0px";
            filtersSection.classList.add('max-h-0');
            toggleFiltersBtn.innerHTML = 'Pokaż filtry<ion-icon name="arrow-down-outline" class="ml-1"></ion-icon>';
            toggleFiltersBtn.classList.remove('translate-y-[-10px]');
        }
    });
</script>
