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
		$articles = [
			['name' => 'Статья 1', 'text' => 'Текст первой статьи'],
			['name' => 'Статья 2', 'text' => 'Текст второй статьи'],
		];
		$this->view->renderHtml('main/main.php', ['articles' => $articles]);
	}
	
	public function sayHello(string $name)
	{
		echo "Привет, $name!";
	}
}
