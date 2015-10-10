<?php
  require_once('class_user.php');
  $user_name =  htmlspecialchars($_POST['user_name']);
  $family_name = htmlspecialchars($_POST['family_name']);
  $user_email = htmlspecialchars($_POST['user_email']);
  $password = htmlspecialchars($_POST['password']);
  $user_age = htmlspecialchars($_POST['user_age']);
  $user_birthday = htmlspecialchars($_POST['user_birthday']);
  $user_birthday_visibility_id = htmlspecialchars($_POST['user_birthday_visibility_id']);
  $user_telephone = htmlspecialchars($_POST['user_telephone']);
  $user_hobby = htmlspecialchars($_POST['user_hobby']);
  $favorite_music = htmlspecialchars($_POST['favorite_music']);
  $favorite_shows = htmlspecialchars($_POST['favorite_shows']);
  $favorite_movies = htmlspecialchars($_POST['favorite_movies']);
  $favorite_books = htmlspecialchars($_POST['favorite_books']);
  $favorite_games = htmlspecialchars($_POST['favorite_games']);
  $about_me = htmlspecialchars($_POST['about_me']);
  
  $iuser = new user();
  $iuser->insertProfile($user_name, $family_name, $password,  $user_email, $user_age, $user_birthday, $user_birthday_visibility_id, $user_telephone, $user_hobby, $favorite_music, $favorite_shows, $favorite_movies, $favorite_books, $favorite_games, $about_me).'<br/>';
  echo '<a href="index.php">На главную страницу</a>'
 
?>