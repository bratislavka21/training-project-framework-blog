<?php include __DIR__ . '/../header.php'; ?>
  <div style="text-align: center;">
    <h1>Регистрация</h1>
    <?php if (!empty($error)): ?>
      <div style="background-color: red; margin: 15px; padding: 5px;"><?= $error ?></div>
    <?php endif; ?>
    <form action="http://myproject.loc/users/register" method="post">
      <label>Nickname <input type="text" name="nickname" value="<?= $_POST['nickname'] ?? ''; ?>"></label>
      <br><br>
      <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? ''; ?>"></label>
      <br><br>
      <label>Password <input type="password" name="password" value="<?= $_POST['password'] ?? ''; ?>"></label>
      <br><br>
      <input type="submit" value="Зарегистрироваться">
    </form>
  </div>
<?php include __DIR__ . '/../footer.php'; ?>