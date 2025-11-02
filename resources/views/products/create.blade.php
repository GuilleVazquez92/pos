@extends('layouts.app')

@section('content')
<h2 class="mb-4 text-2xl font-semibold">Crear Producto</h2>

<form action="{{ route('products.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf

    <div>
        <label for="name" class="block text-gray-700 font-medium mb-1">Nombre del producto</label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
            value="{{ old('name') }}" 
            required
        >
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price" class="block text-gray-700 font-medium mb-1">Precio</label>
        <input 
            type="number" 
            name="price" 
            id="price" 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
            value="{{ old('price') }}" 
            required
        >
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="stock" class="block text-gray-700 font-medium mb-1">Stock</label>
        <input 
            type="number" 
            name="stock" 
            id="stock" 
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror"
            value="{{ old('stock') }}" 
            required
        >
        @error('stock')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex space-x-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
        <a href="{{ route('products.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancelar</a>
    </div>
</form>
@endsection
