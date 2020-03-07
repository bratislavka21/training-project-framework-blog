<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class ArticlesController extends AbstractController
{
    public function add()
    {
        $article = new Article();
        $article->setName('New article');
        $article->setText('New article\'s text');
        $author = User::getById(1);
        $article->setAuthorId($author);

        $article->save();
    }

    public function delete(int $id)
    {
        $article = Article::getById($id);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->delete();
        var_dump($article);
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        
        if ($article == []) {
            throw new NotFoundException();
        }
        
        $this->view->renderHtml('articles/view.php', ['article' => $article]);
    }
}
