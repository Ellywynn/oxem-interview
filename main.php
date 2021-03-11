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
