<?php include __DIR__ . '/../header.php'; ?>
    <div style="text-align: center">
        <h1>Вход</h1>
            <?php if (!empty($error)): ?>
                <div style="background-color: red; margin: 15px; padding: 5px;"><?=$error?></div>
            <?php endif; ?>
        <form action="http://myproject.loc/users/login" method="post">
            <label>Email: <input type="text" name="email" value="<?=$_POST['email'] ?? '';?>"></label>
            <br><br>
            <label>Password: <input type="password" name="password" value="<?=$_POST['password'] ?? '';?>"></label>
            <br><br>
            <input type="submit" value="Войти на сайт">
        </form>
    </div>
<?php include __DIR__ . '/../footer.php';
