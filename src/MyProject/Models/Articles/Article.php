<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
    private $name;

    private $text;

    private $authorId;

    private $createdAt;

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
}
