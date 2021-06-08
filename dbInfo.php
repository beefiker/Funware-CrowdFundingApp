<?php

  $ini = parse_ini_file('config.ini');

  $db = new PDO("mysql:host=localhost;port=3306;dbname=".$ini["db_name"],$ini["db_user"],$ini["db_password"]);  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
 ?>
