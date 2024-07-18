<?php

class Ingredient
{
    public string $ingredient;
    public string $taste;
    public int $quantity;

    public function __construct(string $taste, string $ingredient, int $quantity)
    {
        $this->ingredient = $ingredient;
        $this->taste = $taste;
        $this->quantity = $quantity;
    }
}
