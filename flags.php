<?php

require './vendor/autoload.php';


use HTL3R\Flags\Flags\TriangleFlag as TriangleFlag;
use HTL3R\Flags\Flags\RectangleFlag as RectangleFlag;


$myFlag[] = new RectangleFlag("England", 24.5, 2.0, 0.5, "#F00");
$myFlag[] = new TriangleFlag("Barbados Pirates", 32.5, 4.0, 0.2, "#00F");
$myFlag[] = new RectangleFlag("Spanien", 20.5, 2.0, 0.5, "#F0F");