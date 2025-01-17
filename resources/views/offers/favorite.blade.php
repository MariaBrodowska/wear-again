@extends('offers.index')

@section('content')
    @if (session()->has('message'))
        <div id="alert-5" class="flex items-center justify-center p-3 mb-2 rounded-lg bg-green-100 border-green-600 border-2" role="alert">
            <ion-icon name="checkmark-outline" class="text-green-700 text-xl m-0 p-0"></ion-icon>
            <span class="sr-only">Success</span>
            <div class="ms-3 text-sm font-medium text-green-700">
                {{session()->get('message')}}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-gray-400 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:text-gray-600 inline-flex items-center justify-center h-8 w-8" aria-label="Close" onclick="closeAlert()">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    <div class="px-4 bg-nav-gray1 pb-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 pt-4">
            @if($offers->isEmpty())
                <p>Nie masz jeszcze żadnych ulubionych ofert.</p>
            @else
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
            @endif
        </div>
        <div class="pagination-links mt-6 flex justify-center">
            {{ $offers->links() }}
        </div>
    </div>
<script>
    function closeAlert() {
        const alert = document.getElementById('alert-5');
        alert.style.transition = 'opacity 1s ease-out';
        alert.style.opacity = '0';
        setTimeout(() => { alert.style.display = 'none';}, 300);
    }

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
