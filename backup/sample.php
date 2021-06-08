<?php

    $servername = "localhost";

    $user = "junseok816";

    $password = "tlsrn815";

    $dbname = "junseok816";

    $email = $_POST['useremail'];

    $userPW= $_POST['userPW'];

    $connect = mysqli_connect($servername, $user, $password, $dbname);

    if (!$connect) {

        die("서버와의 연결 실패! : ".mysqli_connect_error());

    }

    echo "서버와의 연결 성공!</br>";

    echo "이메일".$email;
    echo "비번".$userPW;


    $sql= "call sign(@v_success,@v_Message,'$email','$userPW')";

    //call sign(@v_success, @v_Message,'junseok816@google.com', 'ah43281');
	//select * from user_table
 
    $result = mysqli_query($connect,$sql);

    $row = mysqli_fetch_row($result);
        
    

    if (mysqli_query($connect, $sql)) {

        echo "레코드 수정 성공!";

    } else {

        echo "레코드 수정 실패! : ".$row[1];

    }

    mysqli_close($connect);

?>