<?php
// animal product
class Product
{
    public $value = -1;
    public $type = "";
}

// parent class Animal
abstract class Animal
{
    public $product;
    public $type = "";                  // type of an animal(cow, chicken, etc.)
    public static $globalId = 0;        // used for unique animal identifiers
    public $id = 0;                     // id of an animal object
    abstract function getProduct();     // update product and return it
}

class Cow extends Animal
{
    function __construct()
    {
        $this->id = ++parent::$globalId;    // get the id, increase global id
        $this->product = new Product();
        $this->type = "cow";                // set animal types
        $this->product->type = "milk";
    }

    function getProduct()
    {
        $this->product->value = rand(8, 12);
        return $this->product;
    }
}

class Chicken extends Animal
{
    function __construct()
    {
        $this->id = ++parent::$globalId;    // get the id, increase global id
        $this->product = new Product();
        $this->type = "chicken";            // set animal types
        $this->product->type = "egg";
    }

    function getProduct()
    {
        $this->product->value = rand(0, 1);
        return $this->product;
    }
}

class Farm
{
    private $products = array();    // animal products
    private $animals = array();     // farm animals

    // returns farm products
    public function getProducts()
    {
        // clear an array
        $products = array();

        foreach ($this->animals as $animal) {
            // get a new product value
            $animal->getProduct();
            // add a new product to the product array
            $products[$animal->id] = $animal->product;
        }

        return $products;
    }

    public function getAndDisplayProducts()
    {
        $result = $this->getProducts();
        $this->displayInfo();

        return $result;
    }

    // add animal to the farm and products
    public function addAnimal($animal)
    {
        array_push($this->animals, $animal);
        $this->products[$animal->id] = $animal->product;
    }

    // display farm information
    public function displayInfo()
    {
        $milkSum = 0;
        $eggSum = 0;

        echo "Animal:\t\t\tProduct:\n";
        // display info about each animal
        foreach ($this->animals as $animal) {
            // shortcut
            $product = $animal->product;

            // display information
            if ($product->type === "egg")
                $eggSum += $product->value;
            else if ($product->type === "milk")
                $milkSum += $product->value;
            echo "#" . $animal->id . ': ' . $animal->type;

            // output formatting
            if ($animal->type === "cow" && $animal->id < 10)
                echo "\t\t\t";
            else
                echo "\t\t";

            echo 'value = ' . $animal->product->value . '; type: ' . $animal->product->type . "\n";
        }

        // display results
        echo "Results:\n";
        echo "Milk: " . $milkSum . "\n";
        echo "Eggs: " . $eggSum . "\n";
        echo "Total: " . ($milkSum + $eggSum) . "\n\n";
    }
}

// create Farm
$farm = new Farm();

// add cows
for ($i = 0; $i < 10; $i++)
    $farm->addAnimal(new Cow());

// add chickens
for ($i = 0; $i < 20; $i++)
    $farm->addAnimal(new Chicken());

// get the result and display it
$products = $farm->getProducts();
$farm->displayInfo();

echo "-----Get and display products-----\n";

$products = $farm->getAndDisplayProducts();
