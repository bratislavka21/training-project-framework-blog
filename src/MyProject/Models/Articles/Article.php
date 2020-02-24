<?php

namespace MyProject\Models\Articles;

use MyProject\Services\Db;

class Article
{
    private $id;

    private $name;

    private $text;

    private $authorId;

    private $createdAt;

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

    public function getName(): string
    {
        return $this->name;
    }

    public static function getTableName(): string
    {
        return '`articles`';
    }

    public function getText(): string
    {
        return $this->text;
    }

    private function underscoreToCamelCase(string $origin): string
    {
        return lcfirst(str_replace('_', '',ucwords($origin, '_')));
    }
}
