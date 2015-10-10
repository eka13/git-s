<?php
  session_start();
  require_once('class_event.php');
  if (isset($_SESSION['valid_user'])) {
  $user_email = $_SESSION['valid_user'];
  $event_id = $_GET['event_id'];
  echo '<h1>Событие</h1>';
  $evnt = new event();
  $evnt->getEvents($event_id).'<br/>';
  echo '<a href="index.php">На главную страницу</a>';
} else {
    echo '<p>Вы не вошли в систему.</p>';
	echo '<a href="index.php">На главную страницу</a>';
}
  
?>