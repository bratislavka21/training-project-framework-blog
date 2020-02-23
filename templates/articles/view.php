<?php include __DIR__ . '/../header.php'; ?>
    <h2><?= $article['name'] ?></h2>
    <p><i>Автор: <?= $article['nickname'] ?? '' ?></i></p>
    <p><?= $article['text'] ?></p>
<?php include __DIR__ . '/../footer.php';
