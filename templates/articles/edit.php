<?php include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование статьи</h1>
    <?php if (!empty($error)): ?>
        <div style="background-color: red; text-align: center; padding: 5px"><?= $error ?></div>
    <?php endif; ?>
    <form action="http://myproject.loc/articles/edit/<?= $article->getId() ?>" method="post">
        <label for="name">Название статьи</label><br>
        <input name="name" id="name" type="text" size="50" value="<?= empty($_POST['name']) ? $article->getName() : $_POST['name'] ?>">
        <br><br>
        <label for="text">Текст статьи</label><br>
        <textarea name="text" id="text" cols="80" rows="10"><?= empty($_POST['text']) ? $article->getText() : $_POST['text'] ?></textarea>
        <br><br>
        <input type="submit" value="Изменить">
    </form>
<?php include __DIR__ . '/../footer.php'; ?>