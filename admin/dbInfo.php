<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=beefiker","beefiker","asd85592680");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
 ?>
