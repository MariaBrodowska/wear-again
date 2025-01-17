<x-app-layout>
    <div class="py-7 mt-2">
        <div class="mx-auto sm:max-w-3xl lg:max-w-4xl">
            <form action="{{ route('orders.store') }}" method="POST" class="space-y-6 flex flex-col">
                @csrf
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                <div class="bg-white shadow-lg p-6 text-nav-pink sm:rounded-lg">
                    <h2 class="text-lg font-bold">Twoje dane</h2>
                    <hr>
                    <div class="space-y-5">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mt-3">Imię</label>
                            <input type="text" name="first_name" id="first_name"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Imię" required>
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Nazwisko</label>
                            <input type="text" name="last_name" id="last_name"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Nazwisko" required>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Email"
                                   value="{{auth()->user()->email}}" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Numer telefonu
                                (opcjonalnie)</label>
                            <input type="text" name="phone" id="phone"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Numer telefonu">
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Adres dostawy</label>
                            <input type="text" name="address" id="address"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Adres dostawy" required>
                        </div>

                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">Kod
                                pocztowy</label>
                            <input type="text" name="postal_code" id="postal_code"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Kod pocztowy" required>
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">Miejscowość</label>
                            <input type="text" name="city" id="city"
                                   class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                   placeholder="Miejscowość"
                                   required>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Dodatkowe uwagi
                                (opcjonalnie)</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="orderInput text-nav-pink focus:ring-nav-pink focus:border-nav-pink"
                                      placeholder="Dodatkowe informacje"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg p-6 text-nav-pink sm:rounded-lg">
                    <h2 class="font-bold text-lg">Metody dostawy</h2>
                    <hr>
                    <div class="py-4 text-gray-800 text-sm font-medium space-y-3">
                        @foreach($deliveries as $delivery)
                            <div class="flex items-center justify-between border rounded-md p-2 hover:bg-gray-100">
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="delivery_{{$delivery->id}}" value="{{$delivery->id}}"
                                           name="delivery_method" data-price="{{$delivery->price}}"
                                           class="form-radio h-5 w-5 text-nav-pink focus:ring-nav-pink focus:ring-2" required>
                                    <label for="delivery_{{$delivery->id}}" class="text-gray-700 cursor-pointer">
                                        {{$delivery->name}}
                                    </label>
                                </div>
                                <span class="text-gray-600 font-medium">{{$delivery->price}} zł</span>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="bg-white shadow-lg p-6 text-nav-pink sm:rounded-lg">
                    <h2 class="text-lg font-bold">Sposoby płatności</h2>
                    <hr>
                    <div class="py-4 text-gray-800 text-sm font-medium space-y-3">
                        @foreach($payments as $payment)
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="payment_{{$payment->id}}" value="{{$payment->id}}"
                                       name="payment_method"
                                       class="form-radio h-5 w-5 text-nav-pink focus:ring-nav-pink focus:ring-2" required>
                                <label for="payment_{{$payment->id}}" class="text-gray-700 cursor-pointer">
                                    {{$payment->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-nav-gray1 shadow-lg p-6 text-white sm:rounded-lg w-2/3 self-center border-2">
                    <h2 class="text-2xl font-bold">Podsumowanie</h2>
                    <hr>
                    <div class="mt-4 space-y-3">
                        <p class="text-md text-white">
                            Wartość zamówienia: <span class="text-nav-pink font-bold">{{ $offer->price }} zł</span>
                        </p>
                        <p class="text-md text-white">
                            Dostawa: <span id="delivery_price" class="text-nav-pink font-bold">-- zł</span>
                        </p>
                        <hr>
                        <p class="text-md font-bold text-white">
                            Razem: <span id="total_price" class="text-nav-pink font-bold text-xl">-- zł</span>
                        </p>
                    </div>
                    <div class="fixed bottom-6 right-6 flex space-x-4">
                        <a href="{{ route('offers.show', $offer->id) }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition duration-300">
                            Anuluj
                        </a>
                    </div>
                </div>
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition duration-300">
                    Kupuję i płacę
                </button>
            </form>
        </div>
    </div>
    <script>
        document.querySelectorAll('input[name="delivery_method"]').forEach(input => {
            input.addEventListener('change', () => {
                const deliveryPrice = input.dataset.price || 0;
                document.getElementById('delivery_price').textContent = `${deliveryPrice} zł`;
                document.getElementById('total_price').textContent = `${+{{ $offer->price }} + +deliveryPrice} zł`;
            });
        });
    </script>
</x-app-layout>
