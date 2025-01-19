@extends('offers.index')

@section('content')
    <div class="py-8 pt-0 mt-2">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700 mb-2">Edytuj ofertę: {{ $offer->name }} ({{ $offer->id }})</h2>
                <h3 class="text-sm text-gray-700">Data utworzenia: <span class="text-nav-pink">{{ $offer->created_at->format('d.m.Y H:i') }}</span></h3>
                <h3 class="text-sm text-gray-700 mb-5">Data ostatniej edycji: <span class="text-nav-pink">{{ $offer->updated_at->format('d.m.Y H:i') }}</span></h3>
                <form action="{{ route('offers.update', ['id' => $offer->id]) }}" method="POST" class="space-y-4" id="editOfferForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Tytuł*</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $offer->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('title') border-red-500 @enderror" required>
                        @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Opis</label>
                        <textarea name="description" id="description" rows="4" placeholder="np. założone kilka razy, rozmiar zgodny z metką" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('description') border-red-500 @enderror">{{ old('description', $offer->description) }}</textarea>
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700">Stan*</label>
                        <textarea name="condition" id="condition" rows="4" class="mt-1 block w-full h-11 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('condition') border-red-500 @enderror" required>{{ old('condition', $offer->condition) }}</textarea>
                        @error('condition')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Cena*</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $offer->price) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('price') border-red-500 @enderror" min="0" required>
                        @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategoria*</label>
                        <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('category') border-red-500 @enderror" required>
                            <option value="">Wybierz kategorię</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category', $offer->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Rozmiar*</label>
                        <select name="size" id="size" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('size') border-red-500 @enderror" required>
                            <option value="">Wybierz rozmiar</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}" {{ old('size', $offer->size_id) == $size->id ? 'selected' : '' }}>
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('size')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Zdjęcie</label>
                        @if($offer->image_path)
                            <div class="mb-2">
                                <img src="{{ asset('assets/img/paths/' . $offer->image_path) }}" alt="{{ $offer->name }}" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 @error('photo') border-red-500 @enderror" accept="image/*">
                        @error('photo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('offers.user') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 text-center mr-4">
                            Anuluj
                        </a>
                        <button type="submit" class="w-full bg-nav-pink hover:bg-nav-pink2 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                            Zapisz zmiany
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
