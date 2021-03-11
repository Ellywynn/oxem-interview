<?php

class Chicken extends Animal
{
    function __construct()
    {
        $this->id = ++parent::$globalId;    // get the id, increase global id
        $this->product = new Product("egg");
        $this->type = "chicken";
    }

    function updateProduct()
    {
        $this->product->setValue(rand(0, 1));
        return $this->product;
    }

    function getType(): string
    {
        return $this->type;
    }

    function getProduct(): Product
    {
        return $this->product;
    }
}
