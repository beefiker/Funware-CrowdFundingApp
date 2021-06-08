<?php
    require 'dbInfo.php';
    include 'isSession.php';

     unset($_SESSION["user_id"]);
     unset($_SESSION["user_pw"]);

    header("Location:login.php");
    echo "<script>history.back();</script>";
    // echo "<script>window.location.reload();</script>";
?>
