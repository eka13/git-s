<?php
require_once('config.php');
require_once('function.php');

class event
{
  // database handler
  private $mMysqli;  
      
  // class constructor
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);   
  }
  
  // получаем ФИО пользователя с определенным номером, который получили в массиве GET
  function getEvents($event_id)
  {
    $query = "select event_name,  event_startdate,  event_city, event_address  from events where event_id=\"$event_id\" "; 
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_assoc())
    {
      // extract user id and name
        $this->event_name = $row['event_name'];
        $this->event_startdate = $row['event_startdate'];
		$this->event_city = $row['event_city'];
		$this->event_address = $row['event_address'];
	echo $row['event_name'] . ' '. $row['event_startdate']. '<br/>';
	echo 'Город: '. $row['event_city']. '<br/>';
	echo 'Адрес: '. $row['event_address']. '<br/>';
    }
    // close the input stream
    $result->close();
  }
  
  function getProfile($user_id)
  {
  // профиль пользователя с определенным номером, который получили в массиве GET
    $query = "select user_birthday, user_hobby, favorite_music, favorite_movies, favorite_books, favorite_games, about_me from  users where user_id=\"$user_id\" "; 
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_assoc()) 
    {
	  $this->user_birthday = $row['user_birthday'];
      $this->user_hobby = $row['user_hobby'];
	  $this->favorite_music = $row['favorite_music'];
      $this->favorite_movies = $row['favorite_movies'];
	  $this->favorite_books = $row['favorite_books'];
      $this->favorite_games = $row['favorite_games'];
	  $this->about_me = $row['about_me'];
	  echo 'День рождения: '. $row['user_birthday']. '<br/>';
	  echo 'Интересы: '. $row['user_hobby']. '<br/>';
	  echo 'Любимая музыка: '.$row['favorite_music']. '<br/>';
	  echo 'Любимые телешоу: '.$row['favorite_movies']. '<br/>';
	  echo 'Любимые книги: '.$row['favorite_books']. '<br/>';
	  echo 'Любимые игры: '.$row['favorite_games']. '<br/>';
	  echo 'О себе: '.$row['about_me']. '<br/>';
    }
    // close the input stream
    $result->close();
  }
   // class destructor, closes database connection  
  public function __destruct() 
  {
    // close the database connection
    $this->mMysqli->close();
  }
  }
?>