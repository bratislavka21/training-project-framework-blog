<?php


namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
    private $id;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public static function findAll(): array
    {
        $db = new Db();

        return $db->query("SELECT * FROM " . static::getTableName(), [], static::class);
    }

    public function getId(): string
    {
        return $this->id;
    }

    abstract protected static function getTableName(): string;

    private function underscoreToCamelCase(string $origin): string
    {
        return lcfirst(str_replace('_', '',ucwords($origin, '_')));
    }
}
