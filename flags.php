<?php

require './vendor/autoload.php';


use HTL3R\Flags\Flags\TriangleFlag as TriangleFlag;
use HTL3R\Flags\Flags\RectangleFlag as RectangleFlag;


$myFlags[] = new RectangleFlag("England", 24.5, 2.0, 0.5, "#F00");
$myFlags[] = new TriangleFlag("Barbados Pirates", 32.5, 4.0, 0.2, "#00F");
$myFlags[] = new RectangleFlag("Spanien", 20.5, 2.0, 0.5, "#F0F");

header('Content-Type: application/json');

// because flag properties are protected - this next step is necessary
foreach ($myFlags as $flag) {
    $flagSortiment[] = [
        "name" => $flag->getName(),
        "price" => $flag->getPrice(),
        "width" => $flag->getWidth(),
        "height" => $flag->getHeight(),
        "color" => $flag->getColor()
    ];
}

die(json_encode($flagSortiment));