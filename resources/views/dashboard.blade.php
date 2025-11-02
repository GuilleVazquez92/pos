@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Ventas del Día</h2>

    <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-4 mb-6">
        <div>
            <input type="date" 
                   name="fecha" 
                   value="{{ request('fecha', date('Y-m-d')) }}" 
                   class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition w-full">
                Filtrar
            </button>
        </div>
    </form>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $v)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $v->id }}</td>
                        <td class="px-4 py-2">₲{{ number_format($v->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">No hay ventas para esta fecha.</td>
                    </tr>
                @endforelse

                <tr class="bg-gray-100 font-semibold">
                    <td class="px-4 py-2">TOTAL GENERAL</td>
                    <td class="px-4 py-2">₲{{ number_format($totalVentas, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
