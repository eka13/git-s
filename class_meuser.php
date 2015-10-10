<?php
require_once('config.php');
require_once('function.php');


class meuser
{
  // database handler
  private $mMysqli;  
      
  // class constructor
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);   
  }
  
  // получаем свое ФИО из базы email взяли из массива сессии
  function getMyNames($user_email)
  {
    // what SQL query you want executed?
    $query = "select user_name, family_name from  users where user_email=\"$user_email\" "; 
    // execute the query
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_assoc()) 
    {
        $this->user_name = $row['user_name'];
        $this->family_name = $row['family_name'];
	echo $row['user_name'] . ' '. $row['family_name'];
    }
    // close the input stream
    $result->close();
  }
  
  function getMyProfile($user_email)
  {
    $query = "select user_birthday, user_hobby, favorite_music, favorite_movies, favorite_books, favorite_games, about_me from  users where user_email=\"$user_email\" "; 
    $result = $this->mMysqli->query($query);  
    // loop through the results
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
  // Список друзей авторизованного юзера
  function getMyFriends($user_email)
  {
    $user_email;
    $query = "SELECT concat (user_name, ' ', family_name) AS fr, user_id from users"
	         . " WHERE user_id IN "
			 . "(SELECT friend_number FROM friends" 
			 . " WHERE user_number  IN "
			 . "(SELECT @id := user_id FROM users"
			 . " WHERE user_email =\"$user_email\"))";
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
  
    function insertPhoto ($user_email)
  {
 $uploaddir = './upload/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
	$uploadfile=$this->mMysqli->real_escape_string($uploadfile);
	 $request = "INSERT INTO users (user_photos) VALUES (\"$uploadfile\")"
	 . " WHERE user_email =\"$user_email\")";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";

  }
  
  function printPhoto ($user_email)
  {
   $query = "select user_photos where user_email=\"$user_email\" "; 
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