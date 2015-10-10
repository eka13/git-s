﻿<?php
  require_once('shab.php');
  require_once('class_events.php');
   ?>
 <div class="container">  
 <?php 
  if (isset($_SESSION['valid_user'])) {
  $user_email = $_SESSION['valid_user'];
  echo '<h1>События</h1>';
  $ev = new events();
  $ev->getEvents().'<br/>';
} else {
    echo '<p>Вы не вошли в систему.</p>';
}
  echo '<a href="index.php">На главную страницу</a>';
?>
 </div>