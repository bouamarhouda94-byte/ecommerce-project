<?php

namespace App\Cart;

use App\Entity\Cart;
use App\Entity\CartItem;

class ApiCart implements CartInterface
{
    public function add(CartItem $item, Cart $cart): Cart
    {
        dd('ApiCart::add', $item, $cart);
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        dd('ApiCart::remove', $item, $cart);
    }

    public function getCart(string $identifier): Cart
    {
        dd('ApiCart::getCart', $identifier);
    }

    public function clearCart(string $identifier): void
    {
        dd('ApiCart::clearCart', $identifier);
    }
}