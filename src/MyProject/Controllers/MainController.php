<?php

namespace MyProject\Controllers;

class MainController
{
	public function main()
	{
		$articles = [
			['name' => 'Статья 1', 'text' => 'Текст первой статьи'],
			['name' => 'Статья 2', 'text' => 'Текст второй статьи'],
		];
		require __DIR__ . '/../../../templates/main/main.php';
	}
	
	public function sayHello(string $name)
	{
		echo "Привет, $name!";
	}
}
