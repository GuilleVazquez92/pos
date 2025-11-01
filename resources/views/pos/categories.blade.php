@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Llamador #{{ $callNumber }}</h2>
    <h5 class="text-center text-muted mb-5">Seleccionar categoría</h5>

    <div class="row g-4 justify-content-center">
        {{-- Hamburguesas --}}
        <div class="col-6 col-md-3">
            <a href="{{ route('pos.category', 1) }}" class="text-decoration-none">
                <div class="card text-center shadow-lg border-0 rounded-4 bg-warning text-white p-4 card-select">
                    <div class="card-body">
                        <i class="fas fa-hamburger fa-4x mb-3"></i>
                        <h5 class="card-title fw-bold">Hamburguesas</h5>
                    </div>
                </div>
            </a>
        </div>

        {{-- Salsas --}}
        <div class="col-6 col-md-3">
            <a href="{{ route('pos.category', 2) }}" class="text-decoration-none">
                <div class="card text-center shadow-lg border-0 rounded-4 bg-danger text-white p-4 card-select">
                    <div class="card-body">
                        <i class="fas fa-bottle-droplet fa-4x mb-3"></i>
                        <h5 class="card-title fw-bold">Salsas</h5>
                    </div>
                </div>
            </a>
        </div>

        {{-- Bebidas --}}
        <div class="col-6 col-md-3">
            <a href="{{ route('pos.category', 3) }}" class="text-decoration-none">
                <div class="card text-center shadow-lg border-0 rounded-4 bg-primary text-white p-4 card-select">
                    <div class="card-body">
                        <i class="fas fa-glass-whiskey fa-4x mb-3"></i>
                        <h5 class="card-title fw-bold">Bebidas</h5>
                    </div>
                </div>
            </a>
        </div>

        {{-- Fries --}}
        <div class="col-6 col-md-3">
            <a href="{{ route('pos.category', 4) }}" class="text-decoration-none">
                <div class="card text-center shadow-lg border-0 rounded-4 bg-success text-white p-4 card-select">
                    <div class="card-body">
                        <i class="fas fa-french-fries fa-4x mb-3"></i>
                        <h5 class="card-title fw-bold">Fries</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary btn-lg rounded-4">
            <i class="fas fa-arrow-left me-2"></i> Volver a Llamadores
        </a>
    </div>
</div>

{{-- CSS adicional --}}
<style>
    .card-select {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        min-height: 180px;
        cursor: pointer;
    }
    .card-select:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
    }
</style>
@endsection
