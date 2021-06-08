<?php
    
    session_start();
    // $userID = 0;
    if(isset($_SESSION['user_id'])){
      $user_login = TRUE;
      // $userID = $_SESSION['userid'];
    }else{
      $user_login = false;
      // $_SESSION['userId'] = 0;
    }
?>
