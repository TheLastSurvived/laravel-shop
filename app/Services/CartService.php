<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    public static function getCount(): int
    {
        $cart = Session::get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += is_array($item) ? $item['quantity'] : $item;
        }

        return $count;
    }
    
    // Другие методы работы с корзиной
}