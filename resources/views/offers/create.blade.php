@extends('offers.index')

@section('content')

<div class="py-12 pt-0 mt-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg sm:rounded-lg p-6">
            <form method="POST" action="{{route('offers.create')}}" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required placeholder="np. Biała koszulka H&M"
                    >
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Opis</label>
                    <textarea name="description" id="description" rows="4" placeholder="np. założone kilka razy, rozmiar zgodny z metką" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required
                    ></textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Cena</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" min="0" required placeholder="np. 0,00 zł"
                    >
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategoria</label>
                    <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required
                    >
                        <option value="">Wybierz kategorię</option>
                        <option value="clothing" {{ old('category') == 'clothing' ? 'selected' : '' }}>Odzież</option>
                        <option value="toys" {{ old('category') == 'toys' ? 'selected' : '' }}>Zabawki</option>
                    </select>
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Zdjęcie</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" accept="image/*" multiple
                    >
                </div>

                <div>
                    <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300"
                    >
                        Dodaj Ogłoszenie
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
