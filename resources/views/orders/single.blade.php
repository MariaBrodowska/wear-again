@extends('orders.show')

@section('content')
    <div class="max-w-4xl mx-auto px-8 py-4">
        <div class="bg-white shadow-lg sm:rounded-lg p-6">
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

                @if($order->order_status == 'oczekujące')
                    <a href="{{ route('orders.show') }}"
                       class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition duration-300">
                        Edytuj zamówienie
                    </a>
                @endif

            </div>
        </div>
    </div>
@endsection
