<?php
try{  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT


   
if(true) {
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
        $q1 = $db->prepare("INSERT INTO tbl_notice(f_div,f_ne,f_notice_title,f_notice_contents,f_notice_img)VAlUES (?,?,?,?,?)");
        $q1->execute(array($_POST['f_div'],$_POST['f_ne'],$_POST['f_notice_title'],$_POST['f_notice_contents'],"img/notice/".$fileName));

      }else{
        $q1 = $db->prepare("INSERT INTO tbl_notice(f_div,f_ne,f_notice_title,f_notice_contents,f_notice_img)VAlUES (?,?,?,?,?)");
        $q1->execute(array($_POST['f_div'],$_POST['f_ne'],$_POST['f_notice_title'],$_POST['f_notice_contents'],'NULL'));
      } 
}


  

header("Location: http://funware.shop/admin/src/notice.php");
die();


}catch(Exception $e){
  echo $e->getMessage();
}finally{
  
}

?>