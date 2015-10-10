﻿<?php
require_once('config.php');
session_start();

if (isset($_POST['user_email']) && isset($_POST['password'])) {
  // Если пользователь как раз пытался зарегистрироваться
  $user_email = htmlspecialchars($_POST['user_email']);
  $password = htmlspecialchars($_POST['password']);

  $db_conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_errno()) {
    echo 'Невозможно подключиться к базе данных: '.mysqli_connect_error();
    exit();
  }

 $query = 'select user_email, passwd from users '
           . "where user_email='$user_email' "
           . " and passwd='$password' ";

  $result = $db_conn->query($query);
  if ($result->num_rows > 0) {
    // Если пользователь найден в базе данных, регистрируем его идентификатор
    $_SESSION['valid_user'] = $user_email;
  }
  $db_conn->close();
}
?>
<!DOCTYPE html>
<html>
    <head>
       <title>Социальная сеть PartyGames</title>
       <meta charset="utf-8">
      
 <link href="style.css" rel="stylesheet" type="text/css">

    </head>
<body>
<div class="nav">
<ul>
<li><a href="my page1.php"><span>МОЯ СТРАНИЦА</span></a></li>
  <li><a href="events.php"><span>СОБЫТИЯ</span></a></li>
  <li><a href="users.php"><span>ЛЮДИ</span></a></li>
</ul>
</div>
<div class="con">
<div class="forma">
<?php 
  if (isset($_SESSION['valid_user'])) {
    echo 'Привет, '.$_SESSION['valid_user'].'<br />';
    echo '<a href="logout.php">Выход</a><br />';
  } else {
    if (isset($user_email)) {
      // Была предпринята неудачная попытка зарегистрироваться
      echo 'Вход невозможен.<br />';
    } else {
      // Пользователь либо не пытался войти, либо уже вышел
      echo 'Добро пожаловать!<br /><br />';
    }

    echo '<form method="post" action="index.php"><table>';
    echo '<tr><td>E-mail:</td>';
    echo   '<td><input type="text" name="user_email"></td></tr>';
    echo '<tr><td>Пароль:</td>';
    echo  '<td><input type="password" name="password"></td></tr>';
    echo  '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Вход"></td></tr>';
    echo '</table></form>';
  }
?>

</div>

<div class="container"> 
<div class="tem">БЛИЖАЙШИЕ СОБЫТИЯ</div>
  
<?php 
    require_once('class_comevents.php');
   $ev = new сomevents;
   $ev->getcomEvents().'<br/>';
?>
<div class="tem">РЯДОМ С ВАМИ</div>
        <div class="comment">
            <div class="comment-avatar"></div>
            <div class="comment-name">Название мероприятия</div>
            <div class="comment-text">
			            
<div class="comment-date">17.09.2013</div>
            </div>
            <a href="#reply" title="Ответить" class="comment-reply"></a>
        </div>
        <div class="comment">
            <div class="comment-avatar"></div>
            <div class="comment-name">Название мероприятияв</div>
            <div class="comment-text">
                Не согласен, лучше спаны.
                <div class="comment-date">17.09.2013</div>
            </div>
            <a href="#reply" title="Ответить" class="comment-reply"></a>
        </div>
  </div> 
</div>
</body>
</html>