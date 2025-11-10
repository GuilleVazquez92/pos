@extends('layouts.app')

@section('content')
<div class="flex max-w-7xl mx-auto px-6 py-8 gap-6">
    {{-- Productos --}}
    <div class="flex-1 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach ($products as $product)
            <a href="{{ route('pos.customize', ['callNumber' => $callNumber, 'product' => $product->id]) }}"
               class="bg-yellow-400 text-white rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center transform transition duration-200 hover:scale-105 hover:bg-yellow-500">
                <i class="fa-solid fa-burger fa-3x mb-3"></i>
                <h5 class="text-lg font-bold text-gray-800">{{ $product->name }}</h5>
                <p class="text-gray-700 mt-1 font-semibold">
                    ₲{{ number_format($product->price, 0, ',', '.') }}
                </p>
            </a>
        @endforeach
    </div>

    {{-- Carrito lateral --}}
    <div class="w-80 bg-white rounded-2xl shadow p-6 sticky top-6 h-[calc(100vh-2rem)] overflow-y-auto">
        <h4 class="text-2xl font-bold mb-4 flex items-center gap-2">🛒 Carrito</h4>

        @if($cart->isEmpty())
            <p class="text-gray-500">No hay productos en el carrito.</p>
        @else
            @php
                $total = 0;
            @endphp

            <ul class="divide-y divide-gray-200 mb-4">
                @foreach($cart as $item)
                    @php
                        $extras = json_decode($item->added, true) ?? [];
                        $extrasTotal = collect($extras)->sum('price');
                        $subtotal = $item->price + $extrasTotal;
                        $total += $subtotal;
                    @endphp

                    {{-- Producto principal --}}
                    <li class="flex justify-between py-2">
                        <span>{{ $item->name }}</span>
                        <span>₲{{ number_format($item->price, 0, ',', '.') }}</span>
                    </li>

                    {{-- Extras agregados --}}
                    @if(!empty($extras))
                        <li class="flex flex-col pl-4 text-green-700 text-sm">
                            Agregado:
                            @foreach($extras as $extra)
                                <span>- {{ $extra['name'] }} (₲{{ number_format($extra['price'], 0, ',', '.') }})</span>
                            @endforeach
                        </li>
                    @endif

                    {{-- Quitados --}}
                    @if($item->removed)
                        <li class="flex flex-col pl-4 text-red-700 text-sm">
                            Quitado: 
                            @foreach(json_decode($item->removed) as $r)
                                <span>- {{ $r }}</span>
                            @endforeach
                        </li>
                    @endif

                    {{-- Subtotal del producto --}}
                    <li class="pl-4 text-gray-600 text-sm flex justify-between">
                        <span class="font-semibold">Subtotal:</span>
                        <span>₲{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            {{-- Total general --}}
            <div class="font-bold mb-4 flex justify-between text-lg">
                <span>Total:</span>
                <span>₲{{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form action="{{ route('pos.checkout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 text-yellow-300 font-bold py-3 rounded-xl text-lg transition">
                    Cobrar y enviar a cocina
                </button>
            </form>
        @endif
    </div>
</div>

{{-- Volver a categorías --}}
<div class="text-center mt-8">
    <a href="{{ route('pos.categories') }}"
       class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-xl transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Volver a Categorías
    </a>
</div>
@endsection
