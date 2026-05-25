<?php

namespace App\Cart;

use App\Entity\Cart;
use App\Entity\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    private function getSession()
    {
        return $this->requestStack->getSession();
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        $existingItems = $cart->getCartItems();

        foreach ($existingItems as $existingItem) {
            if ($existingItem->getProduct()->getId() === $item->getProduct()->getId()) {
                $existingItem->setQuantity($existingItem->getQuantity() + $item->getQuantity());
                $this->getSession()->set('cart_' . $cart->getId(), $cart);
                return $cart;
            }
        }

        $cart->addCartItem($item);
        $this->getSession()->set('cart_' . $cart->getId(), $cart);

        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        $items = array_filter(
            $cart->getCartItems(),
            fn($i) => $i->getProduct()->getId() !== $item->getProduct()->getId()
        );

        $cart->setCartItems(array_values($items));
        $this->getSession()->set('cart_' . $cart->getId(), $cart);

        return $cart;
    }

    public function getCart(string $identifier): Cart
    {
        $cart = $this->getSession()->get('cart_' . $identifier);

        if (!$cart instanceof Cart) {
            $cart = new Cart();
            $this->getSession()->set('cart_' . $identifier, $cart);
        }

        return $cart;
    }

    public function clearCart(string $identifier): void
    {
        $this->getSession()->remove('cart_' . $identifier);
    }
}