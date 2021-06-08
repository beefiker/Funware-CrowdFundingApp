<?php

    $servername = "http://junseok816.cafe24.com/";

    $user = "junseok816";

    $password = "tlsrn815";

    $dbname = "junseok816";

    
    $request_id = $_REQUEST('/signup_api');

    $connect = mysqli_connect($servername, $user, $password, $dbname);

  
    mysqli_select_db($connection, $dbname)or die('DB 선택 실패');

    $que = "insert into projectname_0 value ('1',2','3')";

    mysqli_query($connect,$que);

    echo $que;
?>   