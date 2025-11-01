@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Seleccionar Llamador</h2>

    <div class="row">
        @for ($i = 1; $i <= 17; $i++)
            <div class="col-6 col-md-3 col-lg-2 mb-3">
                <a href="{{ route('pos.caller', $i) }}" 
                   class="btn btn-primary w-100 py-4 fw-bold">
                     {{ $i }}
                </a>
            </div>
        @endfor
    </div>
</div>
@endsection
