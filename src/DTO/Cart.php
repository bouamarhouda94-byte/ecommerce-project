<?php

namespace App\DTO;

class Cart
{
    private string $id;
    private \DateTime $createdAt;
    private array $cartItems = [];

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->createdAt = new \DateTime();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function setCartItems(array $cartItems): void
    {
        $this->cartItems = $cartItems;
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