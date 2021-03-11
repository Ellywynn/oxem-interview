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

$farm->getAndDisplayProducts();

echo "----------------\n";

$farm->getAndDisplayProducts();
