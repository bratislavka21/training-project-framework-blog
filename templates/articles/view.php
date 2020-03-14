<?php include __DIR__ . '/../header.php'; ?>
    <h2><?= $article->getName() ?></h2>
    <p><i><?= 'Автор: ' . $article->getAuthor()->getNickname(); ?></i></p>
    <p><?= $article->getText() ?></p>
    <?php if ($user !== null && $user->isAdmin() === true): ?>
        <a href="/articles/edit/<?= $article->getId() ?>">Редактировать</a>
    <?php endif; ?>
<?php include __DIR__ . '/../footer.php';
