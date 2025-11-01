@extends('layouts.app')

@section('content')
<h2 class="mb-3">Productos</h2>
<a href="{{ route('products.create') }}" class="btn btn-success mb-3">+ Nuevo Producto</a>

{{-- Mostrar mensaje de éxito --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif


<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ number_format($p->price ,0, ',', '.') }}</td>
            <td>{{ $p->stock }}</td>
            <td>
                <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-warning">Editar</a>
               <form action="{{ route('products.destroy', $p) }}" method="POST" class="d-inline"
                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Eliminar</button>
            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
