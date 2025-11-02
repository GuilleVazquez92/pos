@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex flex-col items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Llamador</h2>
        <div class="bg-black text-yellow-500 text-4xl font-extrabold px-8 py-4 rounded-2xl shadow-md">
            {{ $callNumber }}
        </div>
    </div>

    {{-- CATEGORÍAS --}}
    <h5 class="text-center text-gray-700 mb-6 text-lg">Seleccionar categoría</h5>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 justify-items-center mb-10">
        @php
            $categories = [
                ['name' => 'Hamburguesas', 'icon' => 'fa-solid fa-burger'],
                ['name' => 'Salsas', 'icon' => 'fa-solid fa-bottle-droplet'],
                ['name' => 'Bebidas', 'icon' => 'fa-solid fa-bottle-water'],
                ['name' => 'Fries', 'icon' => 'fa-solid fa-bowl-food'],
            ];
        @endphp

        @foreach ($categories as $index => $category)
            <a href="{{ route('pos.category', $index + 1) }}" class="transform transition duration-200 hover:scale-105">
                <div class="bg-yellow-400 text-white rounded-2xl shadow-lg flex flex-col items-center justify-center w-44 h-48">
                    <i class="{{ $category['icon'] }} fa-3x mb-3"></i>
                    <h5 class="text-lg font-bold text-gray-800 text-center">{{ $category['name'] }}</h5>
                </div>
            </a>
        @endforeach
    </div>

    {{-- CARRITO ABAJO --}}
    <div class="bg-white rounded-2xl shadow p-6 mt-10">
        <h4 class="text-2xl font-bold mb-4 flex items-center gap-2">🛒 Carrito actual</h4>

        @if ($cart->isEmpty())
            <p class="text-gray-500">No hay productos en el carrito.</p>
        @else
            <ul class="divide-y divide-gray-200 mb-4">
                @foreach ($cart as $item)
                    <li class="flex justify-between py-2 text-gray-700">
                        <span>{{ $item->name }}</span>
                        <span class="font-semibold">
                            ₲{{ number_format($item->price, 0, ',', '.') }}
                        </span>
                    </li>
                @endforeach
            </ul>

            <div class="flex justify-between font-bold text-gray-800 mb-4">
                <span>Total:</span>
                <span>
                    ₲{{ number_format($cart->sum('price'), 0, ',', '.') }}
                </span>
            </div>

            <form action="{{ route('pos.checkout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 text-yellow-300 font-bold py-3 rounded-xl text-lg transition">
                    Cobrar y enviar a cocina
                </button>
            </form>
        @endif
    </div>

    <div class="text-center mt-10">
        <a href="{{ route('pos.index') }}" 
           class="inline-flex items-center px-6 py-3 border border-gray-400 rounded-2xl text-gray-700 font-semibold hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver a Llamadores
        </a>
    </div>
</div>
@endsection
