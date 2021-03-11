<?php

class Farm
{
    private $animals = array();     // farm animals

    // returns farm products
    public function getProducts()
    {
        // get a new product value
        foreach ($this->animals as $animal)
            $animal->updateProduct();
    }

    public function getAndDisplayProducts()
    {
        $this->getProducts();
        $this->displayInfo();
    }

    // add animal to the farm and products
    public function addAnimal(Animal $animal)
    {
        // check for valid data type
        array_push($this->animals, $animal);
    }

    // display farm information
    public function displayInfo()
    {
        $sums = array(); // keeps the sum of every product type

        // initialize array with zero initial values
        foreach (Product::$types as $type)
            $sums[$type] = 0;

        echo "Id:\tAnimal type:\tProduct count:\tProduct type:\n";
        // display info about each animal
        foreach ($this->animals as $animal) {
            // shortcut
            $product = $animal->getProduct();

            // add sum of the value
            $sums[$product->getType()] += $product->getValue();

            // display information
            echo "#" . $animal->getId() . "\t" . $animal->getType() . "\t\t";
            echo $product->getValue() . "\t\t" . $product->getType() . "\n";
        }

        // display results
        echo "Results:\n";
        foreach ($sums as $product => $count) {
            echo $product . ": " . $count . "\n";
        }
        echo "Total: " . array_reduce($sums, function ($total, $product) {
            return $total += $product;
        }) . "\n";
    }
}
