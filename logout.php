<?php
  session_start();

  // сохранение для проверки, *входил ли* пользователь в систему
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  session_destroy();
?>

<html>
<body>
<h1>Выход</h1>
<?php
  if (!empty($old_user)) {
    echo 'Успешный выход.<br />';
  } else {
    // Если пользователь не входил в систему,
    // но каким-то образом попал на эту страницу
    echo 'Вы не входили в систему, потому и выходить из нее не нужно.<br />';
  }
?>
<a href="index.php">На главную страницу</a>
</body>
</html>
