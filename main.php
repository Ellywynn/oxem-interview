<?php
require_once __DIR__ . '/vendor/autoload.php';

// create Farm
$farm = new Farm();

// add cows
for ($i = 0; $i < 10; $i++)
    $farm->addAnimal(new Cow());

// add chickens
for ($i = 0; $i < 20; $i++)
    $farm->addAnimal(new Chicken());

echo "First test:\n";
$farm->getAndDisplayProducts();

echo "----------------\n";

echo "Second test:\n";
$farm->getProducts();
$farm->displayInfo();
