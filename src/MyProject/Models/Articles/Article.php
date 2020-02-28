<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $name;

    protected $text;

    protected $authorId;

    protected $createdAt;
    
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }
    
    public function getAuthorId(): int
    {
        return (int) $this->authorId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected static function getTableName(): string
    {
        return '`articles`';
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }
}
