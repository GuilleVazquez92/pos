@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3 text-center">Llamador #{{ $callNumber }}</h3>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Productos --}}
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-6 col-md-3">
                <div class="card text-center product-card shadow-lg border-0"
                     data-bs-toggle="modal"
                     data-bs-target="#productModal"
                     data-product-id="{{ $product->id }}"
                     data-product-name="{{ $product->name }}"
                     data-product-price="{{ number_format($product->price, 0, ',', '.') }}">
                    <div class="card-body p-4">
                        {{-- Ícono genérico o podés usar uno por categoría --}}
                        <i class="fa-solid fa-burger fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="text-muted mb-0">₲{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Carrito --}}
    <div class="mt-5">
        <h4>🛒 Carrito actual</h4>
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
                <button class="btn btn-primary w-100 btn-lg">Cobrar y enviar a cocina</button>
            </form>
        @endif
    </div>
</div>

{{-- Modal de selección --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="productModalLabel">Detalles del producto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="addToCartForm" action="{{ route('pos.addToCart', ['callNumber' => $callNumber]) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="modalProductId">

                <div class="modal-body">
                    <h4 class="text-center" id="modalProductName"></h4>
                    <p class="text-center text-muted mb-4">₲<span id="modalProductPrice"></span></p>

                    <div class="row">
                        {{-- Agregar --}}
                        <div class="col-md-6">
                            <h5 class="mb-3">Agregar</h5>
                            @foreach ($extras as $extra)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" value="{{ $extra->id }}" id="extra_{{ $extra->id }}">
                                    <label class="form-check-label" for="extra_{{ $extra->id }}">{{ $extra->name }}</label>
                                </div>
                            @endforeach

                        </div>

                        {{-- Quitar --}}
                        <div class="col-md-6">
                            <h5 class="mb-3">Quitar</h5>
                            @foreach ($staticIngredients as $ing)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="removed[]" value="{{ $ing }}" id="remove_{{ $loop->index }}">
                                    <label class="form-check-label" for="remove_{{ $loop->index }}">{{ $ing }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100 btn-lg">✅ Confirmar y agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .product-card {
        cursor: pointer;
        border-radius: 25px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        padding: 1rem;
    }
    .product-card:hover {
        transform: scale(1.05);
        background-color: #e9ecef;
    }
    .product-card .fa-solid {
        color: #0d6efd;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const productModal = document.getElementById('productModal')
    productModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const id = button.getAttribute('data-product-id')
        const name = button.getAttribute('data-product-name')
        const price = button.getAttribute('data-product-price')

        document.getElementById('modalProductId').value = id
        document.getElementById('modalProductName').textContent = name
        document.getElementById('modalProductPrice').textContent = price
    })
})
</script>
@endpush
