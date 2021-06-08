<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);


//PAYMENT

if(! empty( $_POST[f_div])){
  if ( $_POST[f_div] == 'N' ){
    $q4= $db->query("UPDATE tbl_user SET f_div ='$_POST[f_div]', f_email='NULL' WHERE ai_id = $_POST[ai_id]");
  }else{
    $q4= $db->query("UPDATE tbl_user SET f_div ='$_POST[f_div]' WHERE ai_id = $_POST[ai_id]");
  }
}else{
  echo '';
}

if (! empty( $_POST[f_email] )){
  $q4= $db->query("UPDATE tbl_user SET f_email ='$_POST[f_email]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_user_pw] )){
  $q4= $db->query("UPDATE tbl_user SET f_user_pw ='$_POST[f_user_pw]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_user_name] )){
  $q4= $db->query("UPDATE tbl_user SET f_user_name ='$_POST[f_user_name]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if( ! empty($_FILES['f_profile']) ) {
  echo '돌아갔는지<br>';
    if ( !($_FILES['f_profile']['error'] > 0) ) {
      echo '돌아갔는지지지지<br>';
        $project_id = $_POST['f_email'];
        $profileImg =  array($_FILES['f_profile']['name'], $_FILES['f_profile']['tmp_name']);
        $temp = explode(".", $profileImg[0]); 
        $extension = end($temp); 
        $fileName = "$project_id"."_".date("Y-m-d_H_i_s").".".$extension;
        $dirPath = "../../../img/profileImg";
        mkdir($dirPath, 0777, true);

        echo $_FILES['f_profile']['name'].'<br>';
        echo $_FILES['f_profile']['tmp_name'].'<br>';
        echo $profileImg.'<br>';
        echo $dirPath.'<br>';
        echo $temp.'<br>';
        echo $extension.'<br>';
        echo $fileName.'<br>';

        if (file_exists($dirPath."/".$fileName)) { 
          echo '페스안에 이프문';
          unlink($dirPath."/".$fileName);
        }
        // move_uploaded_file : 서버로 전송된 파일을 저장.
        move_uploaded_file($profileImg[1], $dirPath."/".$fileName);
        echo "실행?";
        $q4 = $db->prepare("UPDATE tbl_user SET f_profile = (?) WHERE ai_id = $_POST[ai_id]");
        $q4->execute(array("img/profileImg/".$fileName));
      } 
}
if (! empty( $_POST[auto_date] )){
  $q4= $db->query("UPDATE tbl_user SET auto_date ='$_POST[auto_date]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_token] )){
  $q4= $db->query("UPDATE tbl_user SET f_token ='$_POST[f_token]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_marketing] )){
  $q4= $db->query("UPDATE tbl_user SET f_marketing ='$_POST[f_marketing]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_user_address] )){
  $q4= $db->query("UPDATE tbl_user SET f_user_address ='$_POST[f_user_address]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}

//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/user.php");
die();
?>

