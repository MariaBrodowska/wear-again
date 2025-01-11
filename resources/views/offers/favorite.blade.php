@extends('offers.index')

@section('content')
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
                <div class="m-2">
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
                    {{--                                            <p class="mt-2 text-md font-bold text-nav-pink">{{ $offer->price }} zł</p>--}}
                    {{--                                        <a href="{{ route('offers.show', $offer->id) }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800">Zobacz więcej</a>--}}
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsections
