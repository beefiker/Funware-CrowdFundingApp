<?php
try {
    require '../dbInfo.php';
    include '../isSession.php';

    $q = $db->query('SELECT f_email FROM funware_user WHERE ai_id = '.$_SESSION["userId"].'');
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $email = $row["f_email"];
   
    if( isset($_FILES['profileImg']) ) {
        if ( !($_FILES['profileImg']['error'] > 0) ) {
            $profileImg =  array($_FILES['profileImg']['name'], $_FILES['profileImg']['tmp_name']);
            $dirPath = "../img/profileImg";
            $temp = explode(".", $profileImg[0]); 
            $extension = end($temp); 
            $fileName = $email."_".date("Y-m-d_H_i_s").".".$extension;

            if (file_exists($dirPath."/".$fileName)) { 
              unlink($dirPath."/".$fileName);
            }
            // move_uploaded_file : 서버로 전송된 파일을 저장.
            move_uploaded_file($profileImg[1], $dirPath."/".$fileName);

            $q1 = $db->prepare("UPDATE funware_user SET f_profile = ? WHERE ai_id = ?");
            $q1->execute(array("img/profileImg/".$fileName, $_SESSION['userId']));

            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <script>
    // history.back();
  </script>
</body>
</html>
<?php    
}catch(Exception $e){
  echo $e;
}finally{
  header("Location:../myPage.php");
  // header("../myPage.php"); 
}
?>