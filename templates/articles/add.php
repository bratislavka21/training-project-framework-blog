<?php include __DIR__ . '/../header.php'; ?>
    <h1>Создание новой статьи</h1>
    <?php if (!empty($error)): ?>
        <div style="background-color: red; padding: 5px; text-align: center; margin-bottom: 10px"><?= $error ?></div>
    <?php endif; ?>
    <form action="/articles/add/" method="post">
        <label for="name">Название статьи</label><br>
        <input type="text" name="name" id="name" size="50" value="<?= $_POST['name'] ?? ''; ?>">
        <br><br>
        <label for="text">Текст статьи</label><br>
        <textarea type="text" name="text" id="text" cols="80" rows="10"><?= $_POST['text'] ?? ''; ?></textarea>
        <br><br>
        <input type="submit" value="Создать">
    </form>
<?php include __DIR__ . '/../footer.php';
