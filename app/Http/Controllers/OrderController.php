<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('profile.edit', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Ваша корзина пуста');
        }

        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Рассчитываем общую сумму
            $total = 0;
            foreach ($cartItems as $productId => $quantity) {
                $product = Product::find($productId);
                if ($product) {
                    $total += $product->price * $quantity;
                }
            }

            // Создаем заказ
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);

            // Добавляем товары в заказ
            foreach ($cartItems as $productId => $quantity) {
                $product = Product::findOrFail($productId);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            }

            // Очищаем корзину
            session()->forget('cart');

            DB::commit();

            return redirect()->route('profile.edit', $order)
                ->with('success', 'Заказ успешно оформлен!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Произошла ошибка при оформлении заказа: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}
