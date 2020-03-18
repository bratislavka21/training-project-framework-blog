<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $name;

    protected $text;

    protected $authorId;

    protected $createdAt;

    public static function createArticle(array $fields, User $author): self
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new self();

        $article->setName($fields['name']);
        $article->setText($fields['text']);
        $article->setAuthorId($author);

        $article->save();

        return $article;
    }
    
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
    
    public function getParsedText(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getText());
    }
    
    protected static function getTableName(): string
    {
        return '`articles`';
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setAuthorId(User $author): void
    {
        $this->authorId = (int) $author->getId();
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
