<?php

require './vendor/autoload.php';


use HTL3R\Flags\Flags\TriangleFlag as TriangleFlag;
use HTL3R\Flags\Flags\RectangleFlag as RectangleFlag;


$myFlags[] = new RectangleFlag("England", 24.5, 2.0, 0.5, "#F00", "GB");
$myFlags[] = new TriangleFlag("Cocos Islands", 32.5, 4.0, 0.2, "#00F", "CC");
$myFlags[] = new RectangleFlag("Spanien", 20.5, 2.0, 0.5, "#F0F", "ES");

// because flag properties are protected - this next step is necessary
foreach ($myFlags as $flag) {
    $flagSortiment[] = [
        "name" => $flag->getName(),
        "price" => $flag->getPrice(),
        "width" => $flag->getWidth(),
        "height" => $flag->getHeight(),
        "color" => $flag->getColor(),
        "langcode" => $flag->getLangcode()
    ];
}

if(isset($_GET["mode"]) && !empty($_GET["mode"]) && $_GET["mode"] == "json"){
    header('Content-Type: application/json');
    die(json_encode($flagSortiment));
}


$view = new \TYPO3Fluid\Fluid\View\TemplateView();
$paths = $view->getTemplatePaths();
$paths->setTemplatePathAndFilename(__DIR__ . '/templates/flag-template.html');

$view->assignMultiple(
    array(
        "Flags" => $flagSortiment
    )
);

$output = $view->render();
echo $output;
