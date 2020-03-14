<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;


class ArticlesController extends AbstractController
{
    public function add()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Добавлять статьи могут только пользователи с правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createArticle($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
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
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('Редактировать статьи могут только пользователи с правами администратора');
        }

        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException('Статья с таким id не существует');
        }

        if (!empty($_POST)) {
            try {
                $article->updateArticle($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['article' => $article, 'error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);
        
        if ($article == []) {
            throw new NotFoundException();
        }
        
        $this->view->renderHtml('articles/view.php', ['article' => $article, 'user' => $this->user]);
    }
}
