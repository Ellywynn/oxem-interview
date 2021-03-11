<?php

class Cow extends Animal
{
    function __construct()
    {
        $this->id = ++parent::$globalId;    // get the id, increase global id
        $this->product = new Product("milk");
        $this->type = "cow";                // set animal types
    }

    function updateProduct()
    {
        $this->product->setValue(rand(8, 12));
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
