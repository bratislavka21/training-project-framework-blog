<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;

class MainController
{
    private $view;

    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

    public function main()
	{
	    $title = 'Главная страница';

        $articles = $this->db->query("SELECT * FROM `articles`");
		$this->view->renderHtml('main/main.php', ['articles' => $articles, 'title' => $title]);
	}
	
	public function sayHello(string $name)
	{
	    $title = 'Страница приветствия';
		$this->view->renderHtml('hello/hello.php', ['name' => $name, 'title' => $title]);
	}
}
