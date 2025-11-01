@extends('layouts.app')

@section('content')
<h2 class="mb-4">Ventas del Día</h2>

<form method="GET" action="{{ route('dashboard') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="date" name="fecha" value="{{ request('fecha', date('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filtrar</button>
    </div>
</form>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ number_format($v->total_price, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">No hay ventas para esta fecha.</td></tr>
        @endforelse
        <tr>
            <td><strong>TOTAL GENERAL</strong></td>
            <td><strong>{{number_format($totalVentas, 0, ',', '.')  }}</strong></td>
            <td></td>
        </tr>
    </tbody>
</table>
@endsection
