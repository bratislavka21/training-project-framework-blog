<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Блог</title>
  <link href="/styles.css" rel="stylesheet">
</head>
<body>
  <table class="layout">
    
	<tr>
	  <td colspan="2" class="header">
	    Майн блог
	  </td>
	</tr>
	
	<tr>
	  <td>
	    <?php foreach ($articles as $article): ?>
	      <h2><?= $article['name'] ?></h2>
		  <p><?= $article['text'] ?></p>
		  <hr>
		<?php endforeach; ?>  
	  </td>
	  
	  <td width="300px" class="sidebar">
	    <div class="sidebarHeader">Меню</div>
		<ul>
		  <li><a href="/">Главная страница</a></li>
		  <li><a href="/about-me">Обо мне</a></li>
		</ul>
	  </td>
	</tr>
	
    <tr>
      <td colspan="2" class="footer">Копирайт (с) Майн блог</td>
	</tr>
	
  </table>
</body>
</html>
