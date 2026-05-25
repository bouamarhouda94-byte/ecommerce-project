<?php

namespace App\Entity;

class Cart
{
    private string $id;
    private \DateTime $createdAt;
    private array $cartItems = [];

    public function __construct()
    {
        $this->id = uniqid('cart_', true);
        $this->createdAt = new \DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function setCartItems(array $cartItems): self
    {
        $this->cartItems = $cartItems;
        return $this;
    }

    public function addCartItem(CartItem $item): self
    {
        $this->cartItems[] = $item;
        return $this;
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }
}