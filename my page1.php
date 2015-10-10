<?php
require_once('config.php');
require_once('shab.php');
?>

<div class="container"> 

 <?php 
    require_once('my page.php');
	?>
<div class="tem">БЛИЖАЙШИЕ СОБЫТИЯ</div>
  
<?php 
    require_once('class_comevents.php');
   $ev = new сomevents;
   $ev->getcomEvents().'<br/>';
?>
<div class="tem">РЯДОМ С ВАМИ</div>
        <div class="comment">
            <div class="comment-avatar"></div>
            <div class="comment-name">Название мероприятия</div>
            <div class="comment-text">
			            
<div class="comment-date">17.09.2013</div>
            </div>
            <a href="#reply" title="Ответить" class="comment-reply"></a>
        </div>
        <div class="comment">
            <div class="comment-avatar"></div>
            <div class="comment-name">Название мероприятияв</div>
            <div class="comment-text">
                Не согласен, лучше спаны.
                <div class="comment-date">17.09.2013</div>
            </div>
            <a href="#reply" title="Ответить" class="comment-reply"></a>
        </div>
  </div>
