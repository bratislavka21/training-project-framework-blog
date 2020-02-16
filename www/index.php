<?php

function myAutoLoader(string $className)
{
    require_once __DIR__ . '/../src/' . $className . '.php';
}

spl_autoload_register('myAutoLoader');

$author = new MyProject\Models\Users\User('Tigran');
$article = new MyProject\Models\Articles\Article('some title', 'some text', $author);

var_dump($article);
