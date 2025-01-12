@extends('offers.index')

@section('content')
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
                        <p class="self-end flex justify-center items-center">
                            <ion-icon
                                name="{{ auth()->user()->hasFavorite($offer->id) ? 'heart' : 'heart-outline' }}"
                                class="size-5 hover:cursor-pointer mr-1"
                                data-offer-id="{{ $offer->id }}">
                            </ion-icon>
                            {{ $offer->favoritesCount() }}
                        </p>
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
    </div>
@endsection
