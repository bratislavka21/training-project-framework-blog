<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main()
	{
	    $title = 'Главная страница';

        $articles = Article::findAll();

		$this->view->renderHtml('main/main.php', ['articles' => $articles, 'title' => $title]);
	}
	
	public function sayHello(string $name)
	{
	    $title = 'Страница приветствия';
		$this->view->renderHtml('hello/hello.php', ['name' => $name, 'title' => $title]);
	}
}
