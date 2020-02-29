<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticlesController
{

    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function add()
    {
        $article = new Article();
        $article->setName('New article');
        $article->setText('New article\'s text');
        $author = User::getById(1);
        $article->setAuthorId($author);

        $article->save();
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        
        if ($article == []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        
        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }
}
