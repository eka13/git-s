<?php
require_once('shab.php');
   ?>
 <div class="container">  
 <?php 
  require_once('class_user.php');
  if (isset($_SESSION['valid_user'])) {
  $user_email = $_SESSION['valid_user'];
  $user_id = $_GET['user_id'];
  echo '<h1>Страница пользователя</h1>';
} else {
    echo '<p>Вы не вошли в систему.</p>';
	echo '<a href="index.php">На главную страницу</a>';
}
  $us = new user();
  $us->getNames($user_id).'<br/>';
  echo 'Профиль пользователя'.'<br/>';
  $us->getProfile($user_id).'<br/>';
  echo 'Друзья'.'<br/>';
  $us->getFriends($user_id).'<br/>';
  echo '<a href="index.php">На главную страницу</a>'
?>
</div>