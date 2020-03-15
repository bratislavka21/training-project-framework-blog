<?php

try {

    spl_autoload_register(
        function ($className) {
            require_once __DIR__ . '/../src/' . $className . '.php';
        }
    );

    unset($argv[0]);

    $className = '\\MyProject\\Cli\\' . array_shift($argv);

    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Class "' . $className . '" is not found');
    }

    $params = [];

    foreach ($argv as $arg) {
        preg_match('~^-(.+)=(.+)$~', $arg, $matches);
        if (!empty($matches)) {
            $paramName = $matches[1];
            $paramValue = $matches[2];
            $params[$paramName] = $paramValue;
        }
    }

    $obj = new $className($params);
    echo $obj->execute();
} catch (\MyProject\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage();
}
