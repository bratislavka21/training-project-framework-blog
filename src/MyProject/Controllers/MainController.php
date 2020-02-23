<?php

namespace MyProject\Controllers;

use MyProject\View\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
	{
	    $title = 'Главная страница';
		$articles = [
			['name' => 'Статья 1', 'text' => 'Текст первой статьи'],
			['name' => 'Статья 2', 'text' => 'Текст второй статьи'],
		];
		$this->view->renderHtml('main/main.php', ['articles' => $articles, 'title' => $title]);
	}
	
	public function sayHello(string $name)
	{
	    $title = 'Страница приветствия';
		$this->view->renderHtml('hello/hello.php', ['name' => $name, 'title' => $title]);
	}
}
