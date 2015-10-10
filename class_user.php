<?php
require_once('config.php');
require_once('function.php');

class user
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
  function getNames($user_id)
  {
    $query = "select user_name, family_name from  users where user_id=\"$user_id\" "; 
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_assoc()) 
    {
      // extract user id and name
        $this->user_name = $row['user_name'];
        $this->family_name = $row['family_name'];
	echo $row['user_name'] . ' '. $row['family_name'];
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
  
  function getFriends($user_id)
  {
  // друзья пользователя
    $query = "SELECT concat (user_name, ' ', family_name) AS fr, user_id from users"
	         . " WHERE user_id IN "
			 . "(SELECT friend_number FROM friends" 
			 . " WHERE user_number  =\"$user_id\")";
    $result = $this->mMysqli->query($query);   
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
          $user_id = $row['user_id'];
          $spisok = $row['fr'];
          $url = "user.php?user_id=".($user_id);
          $title = $spisok;
          do_html_url($url, $title);           
    }
    $result->close();
  }
  
  function insertProfile($user_name, $family_name, $password,  $user_email, $user_age, $user_birthday, $user_birthday_visibility_id, $user_telephone, $user_hobby, $favorite_music, $favorite_shows, $favorite_movies, $favorite_books, $favorite_games, $about_me)
  {
  // class внесение данных о пользователе в базу данных
  $user_name = $this->mMysqli->real_escape_string($user_name);
  $family_name = $this->mMysqli->real_escape_string($family_name);
  $password = $this->mMysqli->real_escape_string($password);
  $user_email = $this->mMysqli->real_escape_string($user_email);
  $user_age = $this->mMysqli->real_escape_string($user_age);
  $user_birthday = $this->mMysqli->real_escape_string($user_birthday);
  $user_birthday_visibility_id = $this->mMysqli->real_escape_string($user_birthday_visibility_id);
  $user_telephone = $this->mMysqli->real_escape_string($user_telephone);
  $user_hobby = $this->mMysqli->real_escape_string($user_hobby);
  $favorite_music = $this->mMysqli->real_escape_string($favorite_music);
  $favorite_shows = $this->mMysqli->real_escape_string($favorite_shows);
  $favorite_movies = $this->mMysqli->real_escape_string($favorite_movies);
  $favorite_books = $this->mMysqli->real_escape_string($favorite_books);
  $favorite_games = $this->mMysqli->real_escape_string($favorite_games);
  $about_me = $this->mMysqli->real_escape_string($about_me);
  $request = "INSERT INTO users (user_name, family_name, passwd,  user_email, user_age, user_birthday_visibility_id, user_birthday,  user_telephone, user_hobby, favorite_music, favorite_shows, favorite_movies, favorite_books, favorite_games, about_me) VALUES (\"$user_name\", \"$family_name\", \"$password\",  \"$user_email\", \"$user_age\", \"$user_birthday_visibility_id\", \"$user_birthday\",  \"$user_telephone\", \"$user_hobby\", \"$favorite_music\", \"$favorite_shows\", \"$favorite_movies\", \"$favorite_books\", \"$favorite_games\", \"$about_me\")";
  if ($result = $this->mMysqli->query($request))
  {
   echo "Вы зарегистрированы! Больше радостных событий!";
  }
  else
  {
   echo "Запись не выполнена, пожалуйста, попробуйте еще раз.";
  }
  
  }
  
  
  function insertPhoto ($user_id)
  {
 $uploaddir = './upload/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
	$uploadfile=$this->mMysqli->real_escape_string($uploadfile);
	 $request = "INSERT INTO users (user_photos) VALUES (\"$uploadfile\")"
	 . " WHERE user_number =\"$user_id\")";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";

  }
  
  function printPhoto ($user_id)
  {
   $query = "select user_photos where user_id=\"$user_id\" "; 
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_assoc()) 
    {
      // extract user id and name
        $this->user_photos = $row['user_photos'];
        
	echo '<img src="'. $row['user_photos'].'width="125" height="150">';
    
    // close the input stream
    $result->close();
  }
  }
  // class destructor, closes database connection  
  public function __destruct() 
  {
    // close the database connection
    $this->mMysqli->close();
  }
}
?>