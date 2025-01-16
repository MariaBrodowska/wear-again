<x-app-layout>
    <x-slot name="header">
        <nav class="my-6">
            <form action="{{route('offers.index')}}"  method="GET" class="flex flex-col items-center justify-start w-full">
                {{--pole search--}}
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
                @if(Route::is('offers.index') or Route::is('users.index'))
                <div id="filters-section" class="relative flex flex-wrap gap-4 w-2/3 justify-center items-center mt-2 mb-7 max-h-0 overflow-hidden transition-all duration-1000 ease-in-out">
                    <!--kategorie-->
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
                @if(Route::is('offers.index') or Route::is('users.index'))
                    @if(request()->hasAny(['category','size', 'min_price', 'max_price', 'date_from', 'date_to', 'sort']))
                        <div class="my-4 text-sm">
                            <span class="font-bold text-white">Aktywne filtry:</span>
                            @if(request('category'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">Kategoria: {{ $categories->firstWhere('id', request('category'))->name }}</span>
                            @endif
                            @if(request('size'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">Rozmiar: {{ $sizes->firstWhere('id', request('size'))->name }}</span>
                            @endif
                            @if(request('min_price'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">Cena od: {{ request('min_price') }} zł</span>
                            @endif
                            @if(request('max_price'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">Cena do: {{ request('max_price') }} zł</span>
                            @endif
                            @if(request('date_from'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">Od: {{ request('date_from') }}</span>
                            @endif
                            @if(request('date_to'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">Do: {{ request('date_to') }}</span>
                            @endif
                            @if(request('sort'))
                                <span class="bg-pink-100 text-pink-600 py-1 px-3 rounded-lg mx-1">
                                Sortowanie:
                                @switch(request('sort'))
                                    @case('newest') Od najnowszych @break
                                    @case('oldest') Od najstarszych @break
                                    @case('price_low') Cena: od najniższej @break
                                    @case('price_high') Cena: od najwyższej @break
                                @endswitch
                                </span>
                            @endif
                        </div>
                    @endif
                    @if(Route::is('offers.index') or Route::is('users.index'))
                    <div class="px-4 bg-nav-gray1 pb-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 pt-4">
                            @foreach($offers as $offer)
                                <div class="flex flex-col pt-0 bg-gray-100 rounded-sm">
                                        <a href="{{route('users.show', ['id' => $offer->user->id]) }}" class="flex items-center p-1 text-sm text-gray-600 hover:text-gray-900">
                                            <ion-icon name="person-circle-outline" class="size-6"></ion-icon>
                                            <span class="ml-1">{{ $offer->user->name }}</span>
                                        </a>
                                    <a href="{{ route('offers.show', ['id' => $offer->id]) }}" class="h-3/4">
                                        @if ($offer->image_path)
                                            <img src="{{ asset('assets/img/paths/' . $offer->image_path) }}" class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" alt="{{ $offer->name }}">
                                        @else
                                            <img src="{{ asset('assets/img/paths/default.png') }}" class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" alt="default image">
                                        @endif
                                    </a>
                                    <div class="p-2 flex flex-col justify-center items-start">
                                       <button type="button" id="toggle-favorite" class="self-end flex justify-center items-center">
                                        <ion-icon
                                            name="{{ auth()->user()->hasFavorite($offer->id) ? 'heart' : 'heart-outline' }}"
                                            class="size-5 mr-1" id="heart"
                                            data-offer-id="{{ $offer->id }}">
                                        </ion-icon>
                                        {{ $offer->favoritesCount() }}
                                       </button>
                                        <h5 class="text-sm font-medium text-gray-700">{{ $offer->name }}</h5>
                                        <h5 class="text-xs font-medium text-gray-700">{{ $offer->size->name }}, {{ $offer->condition }}</h5>
                                        @if($offer->status == 'dostępny')
                                            <h5 class="text-xs font-medium text-gray-700 flex items-center justify-start">
                                                <ion-icon name="checkmark-done-circle-outline" class="text-green-600 pr-1 w-6 h-6"></ion-icon>
                                                Dostępny</h5>
                                            <p class="mt-2 text-md font-bold text-nav-pink">{{ $offer->price }} zł</p>
                                        @else
                                            <h5 class="text-xs font-medium text-gray-700 flex items-center justify-start">
                                                <ion-icon name="close-circle-outline" class="text-red-600 pr-1 w-6 h-6"></ion-icon>

                                                Sprzedany</h5>
                                            <p class="mt-2 text-md font-bold line-through text-nav-pink">{{ $offer->price }} zł</p>
                                        @endif
                                        <h5 class="text-xs font-medium text-gray-500 self-end">Dodane: {{ $offer->created_at->format('d.m.Y H:i') }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-links mt-4 flex justify-center">
                            {{ $offers->links() }}
                        </div>
                    </div>
                    @endif
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

    const favorite = document.getElementById('toggle-favorite');
    const heart = document.getElementById('heart');
    favorite.addEventListener('click', () => {
        if(heart.name === 'heart'){
            heart.name = 'heart-outline';
        }
        else{
            heart.name = 'heart';
        }
    }
</script>
