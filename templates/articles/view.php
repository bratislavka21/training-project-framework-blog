<?php include __DIR__ . '/../header.php'; ?>
    <h2><?= $article->getName() ?></h2>
    <p><i><?= 'Автор: ' . $article->getAuthor()->getNickname(); ?></i></p>
    <p><?= $article->getParsedText() ?></p>
<?php include __DIR__ . '/../footer.php';
