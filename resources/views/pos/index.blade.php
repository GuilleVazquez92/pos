@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Seleccionar Llamador</h2>

    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4">
        @foreach ($callers as $caller)
            <a href="{{ route('pos.caller', $caller) }}" 
               class="bg-blue-500 text-white rounded-xl py-6 text-center text-xl font-bold hover:bg-blue-600 transition">
                {{ $caller }}
            </a>
        @endforeach
    </div>
</div>
@endsection
