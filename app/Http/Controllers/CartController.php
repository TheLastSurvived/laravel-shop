<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $products = [];
        $total = 0;

        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('cart', compact('products', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $request->quantity ?? 1;
        } else {
            $cart[$product->id] = $request->quantity ?? 1;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Товар удален из корзины');
    }

    public function update(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $currentQuantity = $cart[$product->id] ?? 1;

        if ($request->change === 'increase') {
            $cart[$product->id] = $currentQuantity + 1;
        } elseif ($request->change === 'decrease' && $currentQuantity > 1) {
            $cart[$product->id] = $currentQuantity - 1;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Количество обновлено');
    }

    public static function calculateTotal(array $cartItems): float
    {
        $total = 0;

        foreach ($cartItems as $productId => $item) {
            $product = Product::find($productId);

            // Проверяем структуру $item
            $quantity = is_array($item) ? ($item['quantity'] ?? 1) : $item;

            if ($product) {
                $total += $product->price * $quantity;
            }
        }

        return $total;
    }
}
