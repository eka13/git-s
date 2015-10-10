<?php
  require_once('shab.php');
  require_once('class_users.php');
  ?>
 <div class="container">  
 <?php 
  if (isset($_SESSION['valid_user'])) {
  $user_email = $_SESSION['valid_user'];
  echo '<h1>Люди</h1>';
  $my = new users();
  $my->getUsers().'<br/>';
} else {
    echo '<p>Вы не вошли в систему.</p>';
}
  echo '<a href="index.php">На главную страницу</a>';
?>
 </div>