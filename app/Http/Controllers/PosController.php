<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        return view('pos.select-caller');
    }

    public function selectCaller($number)
    {
        session(['call_number' => $number]);
        return redirect()->route('pos.categories');
    }

    public function selectCategory()
    {
        $callNumber = session('call_number');

        if (!$callNumber) {
            return redirect()->route('pos.index')->with('error', 'Seleccione un llamador primero.');
        }

        $cart = Cart::all();

        // Definimos las categorías
        $categories = [
            1 => '🍔 Hamburguesas',
            2 => '🥫 Salsas',
            3 => '🥤 Bebidas',
            4 => '🍟 Fries',
        ];

        return view('pos.categories', compact('categories', 'callNumber', 'cart'));
    }
    public function showProducts($id_category)
    {
        $callNumber = session('call_number');

        // Productos filtrados por categoría elegida (por ejemplo category_id = 1)
        $products = Product::where('category', $id_category)->get();

        // Agregados (category_id = 5)
        $extras = Product::where('category', 5)->get();

        $cart = Cart::all();

        $staticIngredients = [
            'Salsa',
            'Pan',
            'Carne',
            'Queso',
            'Tomate',
            'Lechuga',
            'Cebolla',
            'Ketchup',
            'Mostaza',
            'Pepinillos'
        ];

        return view('pos.products', compact('products', 'extras', 'cart', 'callNumber', 'staticIngredients'));
    }


    public function addToCart(Request $request, $callNumber)
    {
        $product = Product::findOrFail($request->product_id);
        $extrasSeleccionados = $request->input('extras', []); // array de IDs seleccionados
        $extras = [];

        foreach ($extrasSeleccionados as $id) {
            $extra = Product::find($id);
            if ($extra) {
                $extras[] = [
                    'id' => $extra->id,
                    'name' => $extra->name,
                    'price' => $extra->price ?? 0,
                ];
            }
        }

        Cart::create([
            'user_id' => Auth::id() ?? 1, // o null si no hay login
            'product_id' => $product->id,
            'call_number' => $callNumber,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'tax' => 0,
            'added' => json_encode($extras ?? []),
            'removed' => json_encode($request->removed ?? []),
        ]);

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function checkout()
    {
        try {
            $callNumber = session('call_number');

            // ✅ Validar número de llamada
            if (!$callNumber) {
                return back()->with('error', 'No se encontró el número de llamada.');
            }

            // ✅ Obtener carrito
            $cartItems = Cart::all();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'No hay productos en el carrito.');
            }

            // ✅ Calcular total
            $total = 0;

            foreach ($cartItems as $item) {

                if (!isset($item->price)) {

                    return back()->with('error', 'Un producto no tiene precio definido.');
                }

                $extras = json_decode($item->added, true) ?? [];
                $extrasTotal = collect($extras)->sum('price');
                $total += $item->price + $extrasTotal;
            }

            // ✅ Crear orden
            $order = Order::create([
                'call_number' => $callNumber,
                'total_price' => $total,
                'status' => 'cobrado',
            ]);

            if (!$order) {
                return back()->with('error', 'No se pudo crear la orden.');
            }

            // ✅ Crear items
            foreach ($cartItems as $item) {

                if (!$item->product_id) {
                    \Log::error('Carrito con producto sin ID:', ['item' => $item]);
                    continue; // evita romper el proceso
                }

                $orderItem = $order->order_items()->create([
                    'name' => $item->name ?? 'Sin nombre',
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity ?? 1,
                    'price' => $item->price ?? 0,
                ]);

                if (!$orderItem) {
                    \Log::error('No se pudo crear el item del pedido:', ['item' => $item]);
                    continue;
                }

                // ✅ Crear addons
                $added = json_decode($item->added, true) ?? [];
                $removed = json_decode($item->removed, true) ?? [];


                foreach ($added as $extra) {
                    // Validar que sea un array y que tenga nombre y precio válidos
                    if (
                        !is_array($extra) ||
                        empty($extra['name']) ||
                        !isset($extra['price']) ||
                        !is_numeric($extra['price'])
                    ) {
                        \Log::warning('Extra sin datos válidos, no se insertará:', ['extra' => $extra]);
                        continue;
                    }

                    $orderItem->addons()->create([
                        'name' => trim($extra['name']),
                        'price' => (float) $extra['price'],
                        'type' => 'extra',
                    ]);
                }

                foreach ($removed as $r) {
                    // Validar que no esté vacío
                    if (empty($r)) {
                        \Log::warning('Ingrediente removido vacío, se omite:', ['removed' => $r]);
                        continue;
                    }

                    $name = is_array($r)
                        ? (!empty($r['name']) ? trim($r['name']) : 'Sin nombre')
                        : trim((string) $r);

                    // Validar que haya un nombre válido
                    if (empty($name)) {
                        \Log::warning('Ingrediente removido sin nombre, se omite:', ['removed' => $r]);
                        continue;
                    }

                    $orderItem->addons()->create([
                        'name' => $name,
                        'price' => 0,
                        'type' => 'remove',
                    ]);
                }
            }

            // ✅ Vaciar carrito
            Cart::query()->delete();

            return redirect()->route('pos.index')->with('success', 'Pedido cobrado y enviado a cocina.');
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Error en checkout:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Ocurrió un error al procesar el pedido.');
        }
    }



    public function customize($callNumber, $productId)
    {
        $product = Product::findOrFail($productId);
        $extras = Product::where('category', 5)->get();
        $staticIngredients = ['Queso', 'Lechuga', 'Tomate']; // ejemplo

        return view('pos.customize', compact('callNumber', 'product', 'extras', 'staticIngredients'));
    }
}
