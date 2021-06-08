<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT

if (! empty( $_POST[f_div] )){
  $q4= $db->query("UPDATE tbl_notice SET f_div ='$_POST[f_div]' WHERE ai_notice = $_POST[ai_notice]");
}else{
  echo '';
}
if (! empty( $_POST[f_ne] )){
  $q4= $db->query("UPDATE tbl_notice SET f_ne ='$_POST[f_ne]' WHERE ai_notice = $_POST[ai_notice]");
}else{
  echo '';
}
if (! empty( $_POST[f_notice_title] )){
  $q4= $db->query("UPDATE tbl_notice SET f_notice_title ='$_POST[f_notice_title]' WHERE ai_notice = $_POST[ai_notice]");
}else{
  echo '';
}
if (! empty( $_POST[f_notice_contents] )){
  $q4= $db->query("UPDATE tbl_notice SET f_notice_contents ='$_POST[f_notice_contents]' WHERE ai_notice = $_POST[ai_notice]");
}else{
  echo '';
}
if( true ) {
  echo '돌아갔는지<br>';
    if ( !($_FILES['f_notice_img']['error'] > 0) ) {
      echo '돌아갔는지지지지<br>';
        $profileImg =  array($_FILES['f_notice_img']['name'], $_FILES['f_notice_img']['tmp_name']);
        $dirPath = "../../../img/notice";
        $temp = explode(".", $profileImg[0]); 
        $extension = end($temp); 
        $fileName = "notice_".date("Y-m-d_H_i_s").".".$extension;

        echo $_FILES['f_notice_img']['name'].'<br>';
        echo $_FILES['f_notice_img']['tmp_name'].'<br>';
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
        $q4 = $db->prepare("UPDATE tbl_notice SET f_notice_img = (?) WHERE ai_notice = $_POST[ai_notice]");
        $q4->execute(array("img/notice/".$fileName));
      } 
}
if (! empty( $_POST[f_date] )){
  $q4= $db->query("UPDATE tbl_notice SET f_date ='$_POST[f_date]' WHERE ai_notice = $_POST[ai_notice]");
}else{
  echo '';
}

if (! empty( $_POST[p_div] )){
  $q4= $db->query("UPDATE tbl_notice_dat SET p_div ='$_POST[p_div]' WHERE ai_dat_id = $_POST[ai_dat_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_dat] )){
  $q4= $db->query("UPDATE tbl_notice_dat SET f_dat ='$_POST[f_dat]' WHERE ai_dat_id = $_POST[ai_dat_id]");
}else{
  echo '';
}
if (! empty( $_POST[auto_date] )){
  $q4= $db->query("UPDATE tbl_notice_dat SET auto_date ='$_POST[auto_date]' WHERE ai_dat_id = $_POST[ai_dat_id]");
}else{
  echo '';
}
//PROJECT

?>

<?php
header("Location: http://funware.shop/admin/src/notice.php");
die();
?>