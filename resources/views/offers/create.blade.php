@extends('offers.index')

@section('content')
    <div class="py-12 pt-0 mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg p-6">
                <form method="POST" action="{{ route('offers.store') }}" class="space-y-4" id="createOfferForm">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Tytuł*</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" placeholder="np. Biała koszulka H&M" value="{{ old('title') }}">
                        @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Opis</label>
                        <textarea name="description" id="description" rows="4" placeholder="np. założone kilka razy, rozmiar zgodny z metką" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700">Stan*</label>
                        <textarea name="condition" id="condition" rows="4" placeholder="np. w dobrym stanie" class="mt-1 block w-full h-11 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>{{ old('condition') }}</textarea>
                        @error('condition')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Cena*</label>
                        <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" min="0" required placeholder="np. 0,00 zł" value="{{ old('price') }}">
                        @error('price')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategoria*</label>
                        <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>
                            <option value="">Wybierz kategorię</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Rozmiar*</label>
                        <select name="size" id="size" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" required>
                            <option value="">Wybierz rozmiar</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}" {{ old('size') == $size->id ? 'selected' : '' }}>
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('size')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Zdjęcie</label>
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" accept="image/*">
                        @error('photo')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-nav-pink hover:bg-nav-pink2 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                            Dodaj Ogłoszenie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
