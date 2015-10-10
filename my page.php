﻿<?php
  require_once('class_meuser.php');
  if (isset($_SESSION['valid_user'])) {
  $user_email = $_SESSION['valid_user'];
  ?>
  <div class="comment">
		  <div class="comment-avatar"></div>
		  <div class="comment-name">
﻿<?php
  $my = new meuser();
  $my->getMyNames($user_email).'<br/>';
   ?>
    </div>
    <div class="comment-text">
 ﻿<?php  
  echo 'Профиль пользователя'.'<br/>';
  $my->getMyProfile($user_email).'<br/>'; ?></div>
      <div class="comment-text">
   ﻿<?php echo 'Друзья'.'<br/>';
  $my->getMyFriends($user_email).'<br/>';?></div>
  </div>
  <?php
} else {
    echo '<p>Вы не вошли в систему.</p>';
}
  
  echo '<a href="index.php">На главную страницу</a>';
?>