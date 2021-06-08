<?php
    require 'dbInfo.php';
    include 'isSession.php';

     unset($_SESSION["userId"]);
     unset($_SESSION["userName"]);
     $user_login = false;

    // header("Location:index.php");
    echo "<script>history.back();</script>";
    // echo "<script>window.location.reload();</script>";
?>
