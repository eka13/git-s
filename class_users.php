﻿<?php
// load configuration file
require_once('config.php');
require_once('function.php');

class users
{
  // database handler
  private $mMysqli;  
      
  // class constructor
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);   
  }
  function getUsers()
  {
    // получаем список пользователей и их номер
    $query = "SELECT concat (user_name, ' ', family_name) AS fr, user_id from users";
    // execute the query
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
          $user_id = $row['user_id'];
          $spisok = $row['fr'];
          $url = "user.php?user_id=".($user_id);
          $title = $spisok;
	// функция из библиотеки функций, формирует страницы пользователей и ссылки на них
          do_html_url($url, $title);           
    }
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