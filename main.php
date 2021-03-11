<?php
// animal product
class Product
{
    private $value = -1;
    private $type = "undefined";

    public function __construct($type)
    {
        $this->type = $type;
    }


    // Getters and setters
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if (!is_int($value))
            throw new Exception("Product value must be an integer");
        if ($value < 0)
            throw new Exception("Product value must be positive");
        $this->value = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (!$type) throw new Exception("Type cannot be empty");
        $this->type = $type;
    }
}

// parent class Animal
abstract class Animal
{
    public $product;
    public $type = "";                  // type of an animal(cow, chicken, etc.)
    public static $globalId = 0;        // used for unique animal identifiers
    public $id = 0;                     // id of an animal object
    abstract function updateProduct();     // update product and return it
}

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
}

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
}

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
    public function addAnimal($animal)
    {
        // check for valid data type
        if ($animal instanceof Cow || $animal instanceof Chicken)
            array_push($this->animals, $animal);
        else throw new Error("Wrong animal type");
    }

    // display farm information
    public function displayInfo()
    {
        $milkSum = 0;
        $eggSum = 0;

        echo "Id:\tAnimal type:\tProduct Value:\tProduct type:\n";
        // display info about each animal
        foreach ($this->animals as $animal) {
            // shortcut
            $product = $animal->product;

            if ($product->getType() === "egg")
                $eggSum += $product->getValue();
            else if ($product->getType() === "milk")
                $milkSum += $product->getValue();

            // display information
            echo "#" . $animal->id . "\t" . $animal->type . "\t\t";
            echo $animal->product->getValue() . "\t\t" . $animal->product->getType() . "\n";
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

$farm->getAndDisplayProducts();

echo "----------------\n";

$farm->getAndDisplayProducts();
