<x-app-layout>
    <x-slot name="header">
        <nav class="my-6">
            <form action="" method="GET" class="flex-row items-center justify-center w-full">

                {{--pole search--}}
                <div class="relative w-full flex justify-center my-6">
                <input class="sm:py-1.5 lg:!max-w-5xl w-2/3 overlay_search-input text-black focus:border-none focus:ring-0" name="query" placeholder="Wyszukaj przedmioty" type="text">
                <button
                    type="submit"
                    class="mr-2 lg:px-10 sm:px-5 sm:py-2 border text-sm text-white border-pink-300 px-4 py-4 hover:text-black/70 hover:bg-pink-300 hover:rounded-xl transition-all duration-500"
                >Szukaj
                </button>
                </div>
                @if(Route::is('offers.index'))
                <div class="w-full flex justify-center">
                    <button
                        type="button"
                        id="toggle-filters-btn"
                        class="mb-1 px-5 py-1 text-sm bg-nav-pink text-white hover:text-nav-pink hover:bg-nav-gray2 rounded-xl transition-all duration-500"
                    >Pokaż filtry</button>
                </div>
                <div id="filters-section" class="hidden relative flex flex-wrap gap-4 w-2/3 justify-center items-center mx-44 mt-5">
                    <!--kategorie-->
                    <select name="category" class="sm:px-3 sm:py-2 lg:px-4 lg:pr-8 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl">
                        <option value="">Wybierz kategorię</option>
                        <option value="clothing" {{ request('category') == 'clothing' ? 'selected' : '' }}>Odzież</option>
                        <option value="toys" {{ request('category') == 'toys' ? 'selected' : '' }}>Zabawki</option>
                    </select>

                    <!--cena-->
                    <input name="min_price" type="number" placeholder="Min Cena" class="ml-4 sm:px-3 sm:py-2 lg:px-5 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('min_price') }}">
                    <input name="max_price" type="number" placeholder="Max Cena" class="ml-4 sm:px-3 sm:py-2 lg:px-5 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('max_price') }}">

                    <!--data-->
                    <input name="date_from" type="date" class="ml-4 sm:px-3 sm:py-2 lg:px-5 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('date_from') }}">
                    <input name="date_to" type="date" class="ml-4 sm:px-3 sm:py-2 lg:px-5 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl" value="{{ request('date_to') }}">

                    <!--filtruj-->
                    <button
                        type="submit"
                        class="relative self-center sm:px-5 sm:py-2 lg:px-10 lg:py-2 border text-sm text-white border-pink-300 px-4 py-4 hover:text-black/70 hover:bg-pink-300 hover:rounded-xl transition-all duration-500"
                    >Filtruj</button>
                    </div>
                @endif
            </form>
        </nav>
    </x-slot>

    <div class="py-6 pb-10">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @yield('content')
                @if(Route::is('offers.index'))
                    <div class="px-4 bg-nav-gray1 pb-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 pt-4">
                            @foreach($offers as $offer)
                                <div class="pt-1 bg-gray-100 rounded-sm">
                                    <p class="text-sm text-gray-500 pl-1">{{$offer->user->name}}</p>
                                    @if ($offer->image_path)
                                        <img src="{{ asset('assets/img/paths/' . $offer->image_path) }}" class="w-full h-3/4 pt-1 object-cover" alt="{{ $offer->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/paths/default.png') }}" class="w-full h-3/4 object-cover" alt="default image">
                                    @endif
                                    <button
                                        class="absolute top-2 right-2 bg-red-600 rounded-full p-1 shadow-md hover:bg-pink-100"
                                        onclick="toggleFavorite(this)"
                                    >
                                        <ion-icon name="heart-outline" class="w-6 h-6 text-pink-500"></ion-icon>
                                    </button>
                                    <div class="m-2">
                                        <h5 class="text-sm font-medium text-gray-700">{{ $offer->name }}</h5>
                                        <h5 class="text-xs font-medium text-gray-700">{{ $offer->size->name }}, {{ $offer->condition }}</h5>
{{--                                        <h5 class="text-xs font-medium text-gray-700">{{ $offer->condition }}</h5>--}}
{{--                                        <p class="text-sm text-gray-600">{{ Str::limit($offer->description, 60) }}</p>--}}
                                        @if($offer->status == 'dostępny')
                                            <h5 class="text-xs font-medium text-gray-700 flex items-center justify-start">
                                                <ion-icon name="checkmark-done-circle-outline" class="text-green-600 pr-1 w-6 h-6"></ion-icon>
                                                Dostępny</h5>
                                        @else
                                            <h5 class="text-xs font-medium text-gray-700 flex items-center justify-start">
                                                <ion-icon name="close-circle-outline" class="text-red-600 pr-1 w-6 h-6"></ion-icon>
                                                Sprzedany</h5>
                                        @endif
                                            <p class="mt-2 text-md font-bold text-nav-pink">{{ $offer->price }} zł</p>
{{--                                        <a href="{{ route('offers.show', $offer->id) }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800">Zobacz więcej</a>--}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif
{{--                <!--wyniki-->--}}
{{--                @if($results->isEmpty())--}}
{{--                    <p>Brak wyników wyszukiwania</p>--}}
{{--                @else--}}
{{--                    <ul>--}}
{{--                        @foreach ($results as $result)--}}
{{--                            <li>{{ $result->name }} - {{ $result->price }} zł</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                @endif--}}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const toggleFiltersBtn = document.getElementById('toggle-filters-btn');
    const filtersSection = document.getElementById('filters-section');

    toggleFiltersBtn.addEventListener('click', () => {
        if (filtersSection.classList.contains('hidden')) {
            filtersSection.classList.remove('hidden');
            toggleFiltersBtn.textContent = 'Schowaj filtry';
        } else {
            filtersSection.classList.add('hidden');
            toggleFiltersBtn.textContent = 'Pokaż filtry';
        }
    });
</script>
