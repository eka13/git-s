﻿﻿<?php
// load configuration file
require_once('config.php');
require_once('function.php');

class events
{
  // database handler
  private $mMysqli;  
      
  // class constructor
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);   
  }
  function getEvents()
  {
    // what SQL query you want executed?
    $query = "SELECT event_name,  event_startdate,  event_city, event_address, event_id FROM events WHERE event_startdate >= CURDATE( )";
    // execute the query
    $result = $this->mMysqli->query($query);  
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
          $event_id = $row['event_id'];
          $event_names = $row['event_name'];
          $url = "event.php?event_id=".($event_id);
          $title = $event_names;
          do_html_url($url, $title);
          $this->event_startdate = $row['event_startdate'];	
          $this->event_city = $row['event_city'];
          $this->event_address = $row['event_address'];	
          echo ' '.$row['event_startdate'] . '<br/>';
		  echo ' '.$row['event_city'] . ' ' .$row['event_address']. '<br/>';
		  $a = $row['event_startdate'];
		  $b = $row['event_city'];
          echo $a.$b;
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