<?php

namespace MyProject\Cli;

use MyProject\Exceptions\CliException;

class Summator
{
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->checkParams();
    }

    public function execute()
    {
        return $this->getParam('a') + $this->getParam('b');
    }

    private function checkParams()
    {
        $this->ensureParamExists('a');
        $this->ensureParamExists('b');
    }

    private function ensureParamExists(string $paramName)
    {
        if (!isset($this->params[$paramName])) {
            throw new CliException('Param "' . $paramName . '" is not set');
        }
    }

    private function getParam(string $paramName)
    {
        return $this->params[$paramName] ?? null;
    }
}
