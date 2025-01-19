<x-app-layout>
    <x-slot name="header" class="bg-white">
        <h2 class="font-bold text-2xl text-white">
            Złożone zamówienia
        </h2>
        <h3 class="text-gray-400 font-thin text-md">
            {{$count}} znalezione zamówienia
        </h3>
    </x-slot>
    @yield('content')
    @if(Route::is('orders.show'))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    @if ($orders->isEmpty())
                        <p class="text-gray-700">Nie masz jeszcze żadnych zamówień.</p>
                    @else
                        <div class="space-y-6">
                            <div
                                class="grid grid-cols-9 gap-4 text-sm font-semibold text-nav-pink2 border-b py-2 bg-gray-100 items-center rounded-md px-2">
                                <div class="col-span-1">Zamówienie</div>
                                <div class="col-span-2">Adres dostawy</div>
                                <div class="col-span-1">Data</div>
                                <div class="col-span-1">Metoda płatności</div>
                                <div class="col-span-1">Metoda dostawy</div>
                                <div class="col-span-1">Całkowita cena</div>
                                <div class="col-span-1">Status dostawy</div>
                                <div class="col-span-1"></div>
                            </div>

                            @foreach ($orders as $order)
                                <div class="grid grid-cols-9 gap-3 text-sm text-gray-700 border-b pb-3 items-center">
                                    <div class="col-span-1 text-center">#{{ $order->id }}</div>
                                    <div class="col-span-2">{{ $order->address }}</div>
                                    <div class="col-span-1">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                                    <div class="col-span-1">{{ $order->paymentMethod->name }}</div>
                                    <div class="col-span-1">{{ $order->deliveryMethod->name }}</div>
                                    <div class="col-span-1">{{ number_format($order->total_price, 2) }} zł</div>
                                    <div class="col-span-1 text-green-500">{{ $order->order_status }}</div>
                                    <div class="col-span-1">
                                        <a href="{{ route('orders.single', $order->id) }}"
                                           class="inline-flex text-center items-center px-3 py-2 mx-0 my-0 border-none bg-nav-gray2 text-sm font-medium text-nav-pink hover:text-white hover:bg-nav-pink focus:outline-none rounded-3xl hover:rounded-md focus:text-white focus:border-gray-300 transition-all duration-800 ease-linear">
                                            Wyświetl szczegóły
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
