<?php

namespace App\Cart;

use App\Entity\Cart;
use App\Entity\CartItem;

class CartHandler
{
    public function handle(CartItem $item, Cart $cart, CartInterface $strategy): Cart
    {
        return $strategy->add($item, $cart);
    }

    public function removeItem(CartItem $item, Cart $cart, CartInterface $strategy): Cart
    {
        return $strategy->remove($item, $cart);
    }

    public function clear(string $identifier, CartInterface $strategy): void
    {
        $strategy->clearCart($identifier);
    }
}