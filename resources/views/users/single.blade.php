@extends('users.index')

@section('content')
<div class="max-w-7xl mx-auto px-3">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                <div class="w-24 h-24 overflow-hidden rounded-full bg-gray-200 flex items-center justify-center">
                    <ion-icon name="person-circle-outline" class="w-full h-full text-nav-pink"></ion-icon>
                </div>
                <div class="ml-6">
                    <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <p class="text-sm text-gray-500">Dołączył(a): {{ $user->created_at->format('d.m.Y') }}</p>
                </div>
                </div>
                <div class="text-right">
                    <h4 class="text-lg font-semibold text-gray-800">Oceny użytkowników</h4>
                    <div>
                        @for($i=1; $i<=5; $i++)
                            @if($average >= $i)
                                <ion-icon name="star"></ion-icon>
                            @elseif($average >= $i -0.5)
                                <ion-icon name="star-half-outline"></ion-icon>
                            @else
                                <ion-icon name="star-outline"></ion-icon>
                            @endif
                        @endfor
                    </div>
                        <p class="text-md font-bold text-nav-pink">
                        Średnia: {{ number_format($average,1) }}
                        <span class="text-sm text-gray-500">(z {{$count}} opinii)</span>
                    </p>
                </div>
            </div>
            @if(auth()->id() === $user->id)
                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}"
                       class="px-4 py-2 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition">
                        Edytuj profil
                    </a>
                </div>
            @endif
        </div>
    </div>
<div class="flex ">
    <div class="mt-8 mr-5">
        <h3 class="text-xl text-white font-bold mb-4">Oferty użytkownika</h3>
        @if($offers->count())
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($offers as $offer)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                        <a href="{{ route('offers.show', $offer->id) }}">
                            <img src="{{ $offer->image_path ? asset('assets/img/paths/' . $offer->image_path) : asset('assets/img/paths/default.png') }}"
                                 class="w-full h-48 object-cover transition-transform transform hover:scale-105"
                                 alt="{{ $offer->name }}">
                        </a>
                        <div class="p-4">
                            <h5 class="font-semibold text-gray-800 text-lg">{{ $offer->name }}</h5>
                            <p class="text-sm text-gray-500">Cena: {{ $offer->price }} zł</p>
                            <p class="text-sm text-gray-500">Stan: {{ $offer->condition }}</p>
                            <p class="text-sm text-gray-400 mt-2">Dodano: {{ $offer->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400">Użytkownik nie dodał jeszcze żadnych ofert.</p>
        @endif
    </div>

    <div class="mt-8 ml-5">
        <h3 class="text-xl text-white font-bold mb-4">Opinie o użytkowniku</h3>
        @if($reviews->count())
            @foreach($reviews as $review)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 mb-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="font-semibold text-gray-800">{{ $review->reviewer->name }}</h5>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-yellow-500 text-lg font-bold">{{ $review->rating }}</span>
                            <span class="text-sm text-gray-500">/ 5</span>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-600">{{ $review->comment }}</p>
                </div>
            @endforeach
        @else
            <p class="text-gray-400">Użytkownik nie ma jeszcze żadnych opinii.</p>
        @endif
    </div>
</div>
</div>
@endsection
