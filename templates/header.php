<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Мой блог' ?></title>
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
    <td colspan="2" style="text-align: right">
      <?php if (!empty($user)): ?>
        <?= 'Добро пожаловать, ' . $user->getName() . '!' . ' | '; ?>
        <a href="/users/logout/">Выйти</a>
      <?php else: ?>
        <a href="/users/login/">Авторизуйтесь</a>
        <?= ' | ' ?>
        <a href="/users/register/">Зарегистрируйтесь</a>
      <?php endif; ?>
    </td>
  </tr>

	<tr>
	  <td>