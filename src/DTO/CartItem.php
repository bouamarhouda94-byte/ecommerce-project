<?php

namespace App\DTO;

use App\Entity\Product;

class CartItem
{
    private int $id;
    private Product $product;
    private float $price;
    private int $quantity;

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getProduct(): Product { return $this->product; }
    public function setProduct(Product $product): void { $this->product = $product; }

    public function getPrice(): float { return $this->price; }
    public function setPrice(float $price): void { $this->price = $price; }

    public function getQuantity(): int { return $this->quantity; }
    public function setQuantity(int $quantity): void { $this->quantity = $quantity; }
}