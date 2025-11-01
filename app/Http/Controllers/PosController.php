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
        return redirect()->route('pos.products', ['order' => $number]);
    }


    public function showProducts()
    {
        $callNumber = session('call_number');
        $products = Product::all();
        $cart = Cart::where('call_number', $callNumber)->get();

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

        return view('pos.products', compact('products', 'cart', 'callNumber', 'staticIngredients'));
    }

    public function addToCart(Request $request)
    {
        $callNumber = session('call_number');
        $product = Product::findOrFail($request->product_id);

        Cart::create([
            'user_id' => Auth::id() ?? 1, // o null si no hay login
            'product_id' => $product->id,
            'call_number' => $callNumber,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'tax' => 0,
            'added' => json_encode($request->extras ?? []),
            'removed' => json_encode($request->removed ?? []),
        ]);

        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function checkout()
    {
        $callNumber = session('call_number');
        $cartItems = Cart::where('call_number', $callNumber)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No hay productos en el carrito.');
        }

        // Crear la orden
        $order = Order::create([
            'call_number' => $callNumber,
            'total' => $cartItems->sum('price'),
            'status' => 'cobrado',
        ]);

        // Pasar los items del carrito al pedido
        foreach ($cartItems as $item) {
            $orderItem = $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);

            $added = json_decode($item->added, true) ?? [];
            $removed = json_decode($item->removed, true) ?? [];

            foreach ($added as $extra) {
                $orderItem->addons()->create([
                    'name' => $extra,
                    'price' => 0,
                    'type' => 'extra'
                ]);
            }

            foreach ($removed as $r) {
                $orderItem->addons()->create([
                    'name' => $r,
                    'price' => 0,
                    'type' => 'remove'
                ]);
            }
        }

        // Vaciar carrito
        Cart::where('call_number', $callNumber)->delete();

        return redirect()->route('pos.index')->with('success', 'Pedido cobrado y enviado a cocina.');
    }
}
