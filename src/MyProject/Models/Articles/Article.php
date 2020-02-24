<?php
namespace MyProject\Models\Articles;

use MyProject\Models\Users\User;

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

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
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
