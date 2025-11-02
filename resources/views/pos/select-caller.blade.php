@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Seleccionar Llamador</h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @for ($i = 1; $i <= 17; $i++)
            <a href="{{ route('pos.caller', $i) }}"
               class="block bg-red-500 text-black font-bold text-xl rounded-xl py-8 text-center
                      hover:bg-red-600 hover:shadow-lg transition transform hover:scale-105">
                {{ $i }}
            </a>
        @endfor
    </div>
</div>
@endsection
