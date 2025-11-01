@extends('layouts.app')

@section('content')
<h2 class="mb-4">Crear Producto</h2>

<form action="{{ route('products.store') }}" method="POST" class="card p-4 shadow-sm">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre del producto</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
