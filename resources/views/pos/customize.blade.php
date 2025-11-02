@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">
    <h3 class="text-3xl font-bold text-center text-black mb-6">
        Llamador 
        <span class="bg-red-600 text-yellow-300 px-6 py-3 rounded-2xl shadow-lg">
            {{ $callNumber }}
        </span>
    </h3>

    <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">
        Personalizar: {{ $product->name }}
    </h2>
    <h2 class="text-center text-gray-600 mb-8 text-lg">
        Total: ₲<span id="totalPrice">{{ number_format($product->price, 0, ',', '.') }}</span>
    </h2>

    <form action="{{ route('pos.addToCart', ['callNumber' => $callNumber]) }}" method="POST" id="customizeForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="total" id="hiddenTotal" value="{{ $product->price }}">

        {{-- SECCIÓN AGREGAR --}}
        <div class="mb-10">
            <h4 class="text-xl font-bold text-gray-800 mb-4 text-center">Agregar</h4>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 justify-items-center">
                @foreach ($extras as $extra)
                    <label class="relative cursor-pointer w-36 h-36 bg-green-500 text-white rounded-2xl flex flex-col items-center justify-center text-center shadow-md transform hover:scale-105 transition">
                        <input type="checkbox" name="extras[]" value="{{ $extra->id }}" data-price="{{ $extra->price ?? 0 }}" class="hidden peer extra-checkbox">
                        <i class="fa-solid fa-plus fa-2x mb-2"></i>
                        <span class="font-semibold">{{ $extra->name }}</span>
                        <span class="text-sm">₲{{ number_format($extra->price ?? 0, 0, ',', '.') }}</span>
                        <div class="hidden peer-checked:flex absolute inset-0 bg-green-700/80 rounded-2xl justify-center items-center">
                            <i class="fa-solid fa-check fa-2x text-white"></i>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- SECCIÓN QUITAR --}}
        <div class="mb-10">
            <h4 class="text-xl font-bold text-gray-800 mb-4 text-center">Quitar</h4>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 justify-items-center">
                @foreach ($staticIngredients as $ing)
                    <label class="relative cursor-pointer w-36 h-36 bg-red-500 text-white rounded-2xl flex flex-col items-center justify-center text-center shadow-md transform hover:scale-105 transition">
                        <input type="checkbox" name="removed[]" value="{{ $ing }}" class="hidden peer removed-checkbox">
                        <i class="fa-solid fa-ban fa-2x mb-2"></i>
                        <span class="font-semibold">{{ $ing }}</span>
                        <div class="hidden peer-checked:flex absolute inset-0 bg-red-700/80 rounded-2xl justify-center items-center">
                            <i class="fa-solid fa-check fa-2x text-white"></i>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- BOTONES --}}
        <div class="flex justify-center gap-4 mt-8">
            <a href="{{ route('pos.categories') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-3 rounded-xl transition">
               Cancelar
            </a>

            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-yellow-300 font-bold px-8 py-3 rounded-xl transition">
                Confirmar y agregar
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const basePrice = {{ $product->price }};
    const totalPriceSpan = document.getElementById('totalPrice');
    const hiddenTotalInput = document.getElementById('hiddenTotal');

    const extraCheckboxes = document.querySelectorAll('.extra-checkbox');

    function updateTotal() {
        let total = basePrice;

        extraCheckboxes.forEach(cb => {
            if(cb.checked) {
                total += parseFloat(cb.dataset.price);
            }
        });

        totalPriceSpan.textContent = total.toLocaleString('es-PY');
        hiddenTotalInput.value = total;
    }

    extraCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateTotal);
    });
});
</script>
@endsection
