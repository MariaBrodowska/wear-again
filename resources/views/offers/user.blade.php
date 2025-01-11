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
    <div class="px-4 pt-7 pb-20 bg-nav-gray1">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
            @foreach($offers as $offer)
                <div class="flex flex-col pt-0 bg-gray-100 rounded-sm">
                    @if ($offer->image_path)
                        <img src="{{ asset('assets/img/paths/' . $offer->image_path) }}" class="w-full h-3/4 object-cover" alt="{{ $offer->name }}">
                    @else
                        <img src="{{ asset('assets/img/paths/default.png') }}" class="w-full h-3/4 object-cover" alt="default image">
                    @endif
                    <div class="p-2">
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
                        <div class="flex w-full justify-center">
                            @csrf
                                <a href="{{ route('offers.edit', $offer->id) }}"
                                   class="text-sm text-center mt-3 mr-2 px-5 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                    Edytuj
                                </a>
                            <form action="{{ route('offers.destroy', $offer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Czy na pewno chcesz usunąć to ogłoszenie?')"
                                        class="text-sm text-center mt-3 px-5 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                    Usuń
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

<script>
    function closeAlert() {
        const alert = document.getElementById('alert-5');
        alert.style.transition = 'opacity 1s ease-out';
        alert.style.opacity = '0';
        setTimeout(() => { alert.style.display = 'none';}, 300);
    }
</script>
@endsection
