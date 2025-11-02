<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Ventas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- layouts.app, dentro del <head> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-gray-800 mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-white font-semibold text-lg">Panel</a>
        <div class="flex space-x-2">
            <a href="{{ route('products.index') }}" 
               class="border border-gray-300 text-gray-100 px-3 py-1 rounded hover:bg-gray-700">
               Productos
            </a>
            <a href="{{ route('pos.index') }}" 
               class="border border-gray-300 text-gray-100 px-3 py-1 rounded hover:bg-gray-700">
               POS
            </a>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4">
    @yield('content')
</div>

</body>
</html>
