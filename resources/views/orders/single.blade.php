@extends('orders.show')

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
    <div class="max-w-4xl mx-auto px-8 py-4">
        <div class="bg-white shadow-lg sm:rounded-lg p-6">
            @if($order->order_status == 'zrealizowane' && auth()->user()->hasReviewed(Auth::id(),$offer->user_id))
                <div id="Review" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Dodaj opinię</h3>
                        <form action="{{ route('orders.addReview', $order->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rating" class="block text-sm text-gray-700">Ocena (1-5)</label>
                                <input type="number" id="rating" name="rating" min="1" max="5" required class="w-full p-2 mt-2 border rounded-md" value="{{ old('rating') }}" placeholder="5">
                            </div>
                            <div class="mb-4">
                                <label for="review" class="block text-sm text-gray-700">Opinia</label>
                                <textarea id="review" name="review" rows="4" class="w-full p-2 mt-2 border rounded-md" placeholder="Jestem zadowolona z zakupu, polecam użytkownika :)">{{ old('review') }}</textarea>
                            </div>
                            <div class="flex justify-between mt-4">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="toggleReview()">Anuluj</button>
                                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Zapisz opinię</button>
                            </div>
                        </form>
                    </div>
                </div>
            @elseif(!auth()->user()->hasReviewed(Auth::id(),$offer->user_id))
                <div id="Review" class="fixed inset-0 flex justify-center items-center bg-gray-500 bg-opacity-50 z-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                        <h3 class="text-2xl font-bold text-gray-700 mb-4">Edytuj opinię</h3>
                        <form action="{{ route('orders.updateReview', $offer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="rating" class="block text-sm text-gray-700">Ocena (1-5)</label>
                                <input type="number" id="rating" name="rating" min="1" max="5" required class="w-full p-2 mt-2 border rounded-md" value="{{ old('rating') }}" placeholder="5">
                            </div>
                            <div class="mb-4">
                                <label for="review" class="block text-sm text-gray-700">Opinia</label>
                                <textarea id="review" name="review" rows="4" class="w-full p-2 mt-2 border rounded-md" placeholder="Jestem zadowolona z zakupu, polecam użytkownika :)">{{ old('review') }}</textarea>
                            </div>
                            <div class="flex justify-between mt-4">
                                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="toggleReview()">Anuluj</button>
                                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Edytuj opinię</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <h3 class="text-2xl font-bold text-gray-700 mb-3">Dane Kupującego</h3>
            <div class="mb-4 text-sm text-gray-600">
                <p>Imię i nazwisko: {{ $order->first_name }} {{ $order->last_name }}</p>
                <p>Email: {{ $order->email }}</p>
                <p>Telefon: {{ $order->phone ?? 'Brak' }}</p>
                <p>Adres: {{ $order->address }}, {{ $order->postal_code }} {{ $order->city }}</p>
                <p>Dodatkowe informacje: {{ $order->notes ?? 'Brak' }}</p>
            </div>
            <div class="flex justify-around">
                <div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-6 mt-8 text-center">Zakupiony produkt</h3>
                    <div class="flex">
                        <div class="p-4 border rounded-lg hover:bg-gray-50 transition duration-300">
                            <h4 class="font-medium text-gray-700">{{ $offer->name }}</h4>
                            <p>Rozmiar: {{ $offer->size->name ?? 'Brak' }}</p>
                            <p>Kategoria: {{ $offer->category->name ?? 'Brak' }}</p>
                            <p>Cena: {{ $offer->price }} zł</p>
                            <p>Stan: {{ $offer->condition }}</p>
                        </div>
                        <a href="{{ route('offers.show', ['id' => $offer->id]) }}" class="h-40">
                            @if ($offer->image_path)
                                <img src="{{ asset('assets/img/paths/' . $offer->image_path) }}"
                                     class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105"
                                     alt="{{ $offer->name }}">
                            @else
                                <img src="{{ asset('assets/img/paths/default.png') }}"
                                     class="w-full h-full object-cover transition-transform duration-300 ease-in-out transform hover:scale-105"
                                     alt="default image">
                            @endif
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-4 mt-8 text-center">Dane Sprzedającego</h3>
                    <div class="mb-4 text-sm text-gray-600 flex flex-col items-center">
                        <a href="{{ route('users.show', ['id' => $offer->user->id]) }}" class="h-3/4">
                            <ion-icon name="person-circle-outline"
                                      class="size-12 text-nav-pink transition-transform duration-300 ease-in-out transform hover:scale-110"></ion-icon>
                        </a>
                        <p><strong>Nazwa użytkownika:</strong> {{$offer->user->name}}</p>
                        <p><strong>Email:</strong> {{$offer->user->email}}</p>
                    </div>
                    @if($order->order_status == 'zrealizowane')
                        <div class="mt-4 text-center">
                            <button onclick="toggleReview()"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-md transition duration-300">
                                Oceń Sprzedającego
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-1 mt-8">Szczegóły Zamówienia</h3>
            <div class="mb-4 text-xs text-gray-500">
                <p>Data złożenia zamówienia: {{ $order->created_at->format('d.m.Y H:i') }}</p>
                <p>Data ostatniej edycji: {{ $order->updated_at->format('d.m.Y H:i') }}</p>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                <p>Status Zamówienia: <span class="font-medium">{{ $order->order_status }}</span></p>
                <p>Status Płatności: <span class="font-medium">{{ $order->payment_status }}</span></p>
                <p>Metoda Płatności: <span class="font-medium">{{ $order->payment_method->name }}</span></p>
                <p>Metoda Dostawy: <span class="font-medium">{{ $order->delivery_method->name }}</span></p>
                <p>Łączna Cena Zamówienia: <span class="font-bold text-nav-pink">{{ $order->total_price }} zł</span></p>
            </div>

            <div class="fixed bottom-6 right-6 flex space-x-4">
                <a href="{{ route('orders.show') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition duration-300">
                    Wróć do listy
                </a>
            </div>
        </div>
    </div>
    <script>
        function toggleReview() {
            const modal = document.getElementById('Review');
            modal.classList.toggle('hidden');
        }

            function closeAlert() {
            const alert = document.getElementById('alert-5');
            alert.style.transition = 'opacity 1s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => { alert.style.display = 'none';}, 300);
        }
    </script>
@endsection
