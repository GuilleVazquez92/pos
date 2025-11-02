@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Producto</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nombre del producto
            </label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $product->name) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                Precio
            </label>
            <input type="number" name="price" id="price"
                   value="{{ old('price', $product->price) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                Stock
            </label>
            <input type="number" name="stock" id="stock"
                   value="{{ old('stock', $product->stock) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" 
                    class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
                Actualizar
            </button>

            <a href="{{ route('products.index') }}" 
               class="bg-gray-300 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
               Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
