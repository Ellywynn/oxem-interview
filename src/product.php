<?php

// animal product
class Product
{
    private $value = -1;
    private $type = "undefined";

    // this array is used to keep track of each new product type
    public static $types = array();

    public function __construct(string $type)
    {
        if (!$type) throw new Exception("Product type cannot be empty");
        $this->setType($type);
    }

    private static function addType($type)
    {
        // if type is the new one, add it to the array
        if (!in_array($type, Product::$types, true))
            array_push(Product::$types, $type);
    }

    // Getters and setters
    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value)
    {
        if ($value < 0)
            throw new Exception("Product value must be positive");
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        if (!$type)
            throw new Exception("Product type cannot be empty");
        $this->type = $type;
        $this->addType($type);
    }
}
