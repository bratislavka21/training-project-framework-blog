<?php


namespace MyProject\Controllers;


use MyProject\Services\Db;
use MyProject\View\View;

class ArticlesController
{
    private $db;

    private $view;

    public function __construct()
    {
        $this->db = new Db();
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId)
    {
        $result = $this->db->query(
            "SELECT * FROM `articles` WHERE id = :id",
            ['id' => $articleId]
        );

        if ($result == []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $author = $this->db->query(
            "SELECT `nickname` FROM `users` WHERE `id` = {$result[0]['author_id']}"
        )[0];

        $result[0]['nickname'] = $author['nickname'];

        $this->view->renderHtml('articles/view.php', ['article' => $result[0]]);
    }
}
