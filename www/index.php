<?php

function myAutoLoader(string $className)
{
    require_once __DIR__ . '/../src/' . $className . '.php';
}

spl_autoload_register('myAutoLoader');

$controller = new \MyProject\Controllers\MainController();

if (!empty($_GET['name'])) {
	$controller->sayHello($_GET['name']);
} else {
	$controller->main();
}
