@extends('offers.index')

@section('content')
    <div class="max-w-4xl mx-auto px-8 py-4">
        <div class="bg-white shadow-lg sm:rounded-lg p-6">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="w-1/2">
                    @if ($offer->image_path)
                        <img src="{{ asset('assets/img/paths/' . $offer->image_path) }}" class="w-full h-full object-cover" alt="{{ $offer->name }}">
                    @else
                        <img src="{{ asset('assets/img/paths/default.png') }}" class="w-full h-full object-cover" alt="default image">
                    @endif
                </div>
                <div class="flex flex-col w-2/3 pl-6 mt-4 mt-0 h-full">
                    <h1 class="text-2xl font-bold text-gray-700 mb-2 underline">{{ $offer->name }}</h1>
                    <form action="{{ route('favorites.change', ['id' => $offer->id]) }}" method="POST" class="self-end">
                        @csrf
                        <button type="submit" id="toggle-favorite" class="flex justify-center items-center" onclick="toogleFavorite({{$offer->id}})">
                            <ion-icon
                                name="{{ auth()->user()->hasFavorite($offer->id) ? 'heart' : 'heart-outline' }}"
                                class="size-5 mr-1" id="heart"
                                data-offer-id="{{ $offer->id }}">
                            </ion-icon>
                            {{ $offer->favoritesCount() }}
                        </button>
                    </form>
                    <p class="text-xs font-medium text-gray-500">Dodane: {{ $offer->created_at->format('d.m.Y H:i') }}</p>
                    <p class="text-xs font-medium text-gray-500 mb-7">Edytowane: {{ $offer->updated_at->format('d.m.Y H:i') }}</p>
                    <p class="text-md text-gray-600">Kategoria: <span class="font-medium">{{ $offer->category->name }}</span></p>
                    <p class="text-md text-gray-600">Rozmiar: <span class="font-medium">{{ $offer->size->name }}</span></p>
                    <p class="text-md text-gray-600">Stan: <span class="font-medium">{{ $offer->condition }}</span></p>
                    <p class="text-md text-gray-600">Cena: <span class="text-nav-pink font-bold">{{ $offer->price }} zł</span></p>

                    @if ($offer->description)
                        <p class="mt-8 text-sm text-gray-700">Opis: {{ $offer->description }}</p>
                    @else
                        <p class="mt-8 mb-5 text-sm text-gray-400 italic">Brak opisu dla tego ogłoszenia.</p>
                    @endif

                    <div class="mt-6 flex items-center space-x-3">
                        <a href="{{route('users.show', ['id' => $offer->user->id]) }}" class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                            <ion-icon name="person-circle-outline" class="size-6"></ion-icon>
                            <span class="ml-1">{{ $offer->user->name }}</span>
                        </a>
                    </div>

                    <div class="relative pt-10 text-sm text-gray-600 self-end">
                        <span class="font-medium">{{ $offer->getFavoritesCount() }}</span> osób polubiło to ogłoszenie.
                    </div>

                    <div class="absolute bottom-6 right-6 flex space-x-4">
                        <a href="{{ route('offers.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition duration-300">
                            Wróć do listy
                        </a>
                        @if($offer->seller_id == Auth::id())
                            <a href="{{ route('offers.user') }}">
                                <button
                                    class="bg-nav-pink hover:bg-nav-pink2 text-white py-2 px-4 rounded-md transition duration-300">
                                    Otwórz moje ogłoszenia
                                </button>
                            </a>
                        @else
{{--                            <form action="{{route("orders.index", ['id' => $offer->id]) }}" method="POST">--}}
{{--                                @csrf--}}
                        <a href="{{route('orders.index', ['id' => $offer->id]) }}">
                            <button
                                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition duration-300">
                                Kup teraz
                            </button>
                        </a>
{{--                            </form>--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    const favorite = document.getElementById('toggle-favorite');
    const heart = document.getElementById('heart');
    favorite.addEventListener('click', () => {
        if(heart.name === 'heart'){
            heart.name = 'heart-outline';
        }
        else{
            heart.name = 'heart';
        }
    });
</script>
@endsection
