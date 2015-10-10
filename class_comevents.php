﻿<?php
// load configuration file
require_once('config.php');
require_once('function.php');

 // Ближайшие события - объект этого класса будет расположен на главной странице index, виден в том числе неавторизованным юзерам
class сomevents
{
  // database handler
  private $mMysqli;  
      
  // class constructor
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);  
   if 	(mysqli_connect_errno()) {
   printf("Подключение не возмможно", mysqli_connect_error() );
   exit();
   }
  }
  function getcomEvents()
  {
    // извлекаем события сегодняшнего дня и будущие,  которые пользователь разрешил показывать гостям,  формируем список и ссылки на них
    $query = "SELECT event_name,  event_startdate,  event_city, event_address, event_id FROM events WHERE event_startdate >= CURDATE( ) and event_show_guest = 'yes' limit 10";
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
          $event_id = $row['event_id'];
          $event_names = $row['event_name'];
          $url = "event.php?event_id=".($event_id);
          $title = $event_names;
		  ?>
		  <div class="comment">
		  <div class="comment-avatar"></div>
		  <div class="comment-name">Название мероприятия
		  <?php
          do_html_url($url, $title);?> </div>
          <div class="comment-text">
		  <?php
		  $this->event_city = $row['event_city'];
          $this->event_address = $row['event_address'];	
		   echo ' '.$row['event_city'] . ' ' .$row['event_address']. '<br/>';?>
		   <div class="comment-date">
		   <?php 
		   $this->event_startdate = $row['event_startdate'];
		   echo ' '.$row['event_startdate'] . '<br/>';?></div></div>
		   </div>
          <?php
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