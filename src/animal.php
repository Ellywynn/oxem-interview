<?php
// parent class Animal
abstract class Animal
{
    protected $product;
    protected $type = "";                   // type of an animal(cow, chicken, etc.)
    protected static $globalId = 0;         // used for unique animal identifiers
    protected $id = 0;                      // id of an animal object
    abstract function updateProduct();      // update product and return it
    abstract function getType(): string;
    abstract function getProduct(): Product;
    function getId(): int
    {
        return $this->id;
    }
}
