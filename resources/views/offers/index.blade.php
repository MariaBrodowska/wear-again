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
                <div class="relative flex flex-wrap gap-4 w-2/3 justify-center items-center mx-44">

                <!--kategorie-->
                <select name="category" class="ml-4 sm:px-3 sm:py-2 lg:px-4 lg:pr-8 lg:py-2 border text-sm text-black border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-300 hover:bg-pink-100 rounded-xl">
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
            </form>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Jesteś zalogowany!") }}
                </div>
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
