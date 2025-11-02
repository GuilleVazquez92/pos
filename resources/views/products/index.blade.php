@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Productos</h2>
        <a href="{{ route('products.create') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
           + Nuevo Producto
        </a>
    </div>

    {{-- Mostrar mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6 relative">
            {{ session('success') }}
            <button type="button" 
                    onclick="this.parentElement.remove()" 
                    class="absolute top-2 right-3 text-green-700 hover:text-green-900 font-bold">
                ×
            </button>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Precio</th>
                    <th class="px-4 py-2 text-left">Stock</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $p->id }}</td>
                        <td class="px-4 py-2">{{ $p->name }}</td>
                        <td class="px-4 py-2">₲{{ number_format($p->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $p->stock }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('products.edit', $p) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm transition">
                               Editar
                            </a>

                            <form action="{{ route('products.destroy', $p) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm transition">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
