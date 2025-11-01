@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-sm">
    <h4>¿Seguro que deseas eliminar el producto "{{ $product->name }}"?</h4>

    <form action="{{ route('products.destroy', $product) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
