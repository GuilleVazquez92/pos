@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Llamador #{{ $callNumber }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Productos --}}
    <div class="row">
        @foreach ($products as $product)
            <div class="col-6 col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted mb-2">₲{{ number_format($product->price, 0, ',', '.') }}</p>
                        <form action="{{ route('pos.addToCart', ['callNumber' => $callNumber]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <details class="mb-2">
                                <summary>Extras</summary>
                                @foreach ($products as $extra)
                                    <div class="form-check text-start">
                                        <input class="form-check-input" type="checkbox" name="extras[]" value="{{ $extra->name }}">
                                        <label class="form-check-label small">{{ $extra->name }}</label>
                                    </div>
                                @endforeach
                            </details>

                            <details>
                                <summary>Quitar</summary>
                                @foreach ($staticIngredients as $ing)
                                    <div class="form-check text-start">
                                        <input class="form-check-input" type="checkbox" name="removed[]" value="{{ $ing }}">
                                        <label class="form-check-label small">{{ $ing }}</label>
                                    </div>
                                @endforeach
                            </details>

                            <button class="btn btn-success btn-sm mt-2 w-100">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Carrito --}}
    <h5 class="mt-5">Carrito actual</h5>
    @if ($cart->isEmpty())
        <p>No hay productos en el carrito.</p>
    @else
        <ul class="list-group mb-3">
            @foreach ($cart as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item->name }}
                    <span>₲{{ number_format($item->price, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>
        <form action="{{ route('pos.checkout') }}" method="POST">
            @csrf
            <button class="btn btn-primary w-100">Cobrar y enviar a cocina</button>
        </form>
    @endif
</div>
@endsection
