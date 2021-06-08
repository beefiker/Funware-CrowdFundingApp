<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT

if (! empty( $_POST[f_div] )){
  $q4= $db->query("UPDATE tbl_project SET f_div ='$_POST[f_div]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_project_name] )){
  $q4= $db->query("UPDATE tbl_project SET f_project_name ='$_POST[f_project_name]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_donate_limit] )){
  $q4= $db->query("UPDATE tbl_project SET f_donate_limit ='$_POST[f_donate_limit]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_cardbank] )){
  $q4= $db->query("UPDATE tbl_project SET f_cardbank ='$_POST[f_cardbank]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_cardnum] )){
  $q4= $db->query("UPDATE tbl_project SET f_cardnum ='$_POST[f_cardnum]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[auto_date] )){
  $q4= $db->query("UPDATE tbl_project SET auto_date ='$_POST[auto_date]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_date_limit] )){
  $q4= $db->query("UPDATE tbl_project SET f_date_limit ='$_POST[f_date_limit]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_par_value] )){
  $q4= $db->query("UPDATE tbl_project SET f_par_value ='$_POST[f_par_value]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_storyline] )){
  $q4= $db->query("UPDATE tbl_project SET f_storyline ='$_POST[f_storyline]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_summary] )){
  $q4= $db->query("UPDATE tbl_project SET f_summary ='$_POST[f_summary]' WHERE ai_project_id = $_POST[ai_project_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_reward_div] )){
  $q4= $db->query("UPDATE tbl_rewards SET f_reward_div ='$_POST[f_reward_div]' WHERE ai_rewards = $_POST[ai_rewards]");
}else{
  echo '';
}
if (! empty( $_POST[f_reward_desc] )){
  $q4= $db->query("UPDATE tbl_rewards SET f_reward_desc ='$_POST[f_reward_desc]' WHERE ai_rewards = $_POST[ai_rewards]");
}else{
  echo '';
}
if (! empty( $_POST[f_reward_cont] )){
  $q4= $db->query("UPDATE tbl_rewards SET f_reward_cont ='$_POST[f_reward_cont]' WHERE ai_rewards = $_POST[ai_rewards]");
}else{
  echo '';
}
if (! empty( $_POST[f_reward_money] )){
  $q4= $db->query("UPDATE tbl_rewards SET f_reward_money ='$_POST[f_reward_money]' WHERE ai_rewards = $_POST[ai_rewards]");
}else{
  echo '';
}
if (! empty( $_POST[r_div] )){
  $q4= $db->query("UPDATE tbl_rewards SET f_div ='$_POST[r_div]' WHERE ai_rewards = $_POST[ai_rewards]");
}else{
  echo '';
}
if( ! empty($_FILES['f_thumbnail']) ) {
  echo '돌아갔는지<br>';
    if ( !($_FILES['f_thumbnail']['error'] > 0) ) {
      echo '돌아갔는지지지지<br>';
        $project_id = $_POST['sys_project_id'];
        $profileImg =  array($_FILES['f_thumbnail']['name'], $_FILES['f_thumbnail']['tmp_name']);
        $temp = explode(".", $profileImg[0]); 
        $extension = end($temp); 
        $fileName = "$project_id"."_f_thumbnail_".date("Y-m-d_H_i_s").".".$extension;
        $dirPath = "../../../Projects/$fileName";
        mkdir($dirPath, 0777, true);

        echo $_FILES['f_thumbnail']['name'].'<br>';
        echo $_FILES['f_thumbnail']['tmp_name'].'<br>';
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
        $q4 = $db->prepare("UPDATE tbl_img SET f_thumbnail = (?) WHERE ai_img = $_POST[ai_img]");
        $q4->execute(array("Projects/$fileName/".$fileName));
      } 
}
if( ! empty($_FILES['f_thumbnail_big']) ) {
  echo '돌아갔는지<br>';
    if ( !($_FILES['f_thumbnail_big']['error'] > 0) ) {
      echo '돌아갔는지지지지<br>';
        $project_id = $_POST['sys_project_id'];
        $profileImg =  array($_FILES['f_thumbnail_big']['name'], $_FILES['f_thumbnail_big']['tmp_name']);
        $temp = explode(".", $profileImg[0]); 
        $extension = end($temp); 
        $fileName = "$project_id"."_f_thumbnail_big_".date("Y-m-d_H_i_s").".".$extension;
        $dirPath = "../../../Projects/$fileName";
        mkdir($dirPath, 0777, true);

        echo $_FILES['f_thumbnail_big']['name'].'<br>';
        echo $_FILES['f_thumbnail_big']['tmp_name'].'<br>';
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
        $q4 = $db->prepare("UPDATE tbl_img SET f_thumbnail_big = (?) WHERE ai_img = $_POST[ai_img]");
        $q4->execute(array("Projects/$fileName/".$fileName));
      } 
}
if( ! empty($_FILES['f_storyline_img']) ) {
  echo '돌아갔는지<br>';
    if ( !($_FILES['f_storyline_img']['error'] > 0) ) {
      echo '돌아갔는지지지지<br>';
        $project_id = $_POST['sys_project_id'];
        $profileImg =  array($_FILES['f_storyline_img']['name'], $_FILES['f_storyline_img']['tmp_name']);
        $temp = explode(".", $profileImg[0]); 
        $extension = end($temp); 
        $fileName = "$project_id"."_f_storyline_img_".date("Y-m-d_H_i_s").".".$extension;
        $dirPath = "../../../Projects/$fileName";
        mkdir($dirPath, 0777, true);

        echo $_FILES['f_storyline_img']['name'].'<br>';
        echo $_FILES['f_storyline_img']['tmp_name'].'<br>';
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
        $q4 = $db->prepare("UPDATE tbl_img SET f_storyline_img = (?) WHERE ai_img = $_POST[ai_img]");
        $q4->execute(array("Projects/$fileName/".$fileName));
      } 
}
if( ! empty($_FILES['f_summary_img']) ) {
  echo '돌아갔는지<br>';
    if ( !($_FILES['f_summary_img']['error'] > 0) ) {
      echo '돌아갔는지지지지<br>';
        $project_id = $_POST['sys_project_id'];
        $profileImg =  array($_FILES['f_summary_img']['name'], $_FILES['f_summary_img']['tmp_name']);
        $temp = explode(".", $profileImg[0]); 
        $extension = end($temp); 
        $fileName = "$project_id"."_f_summary_img_".date("Y-m-d_H_i_s").".".$extension;
        $dirPath = "../../../Projects/$fileName";
        mkdir($dirPath, 0777, true);

        echo $_FILES['f_summary_img']['name'].'<br>';
        echo $_FILES['f_summary_img']['tmp_name'].'<br>';
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
        $q4 = $db->prepare("UPDATE tbl_img SET f_summary_img = (?) WHERE ai_img = $_POST[ai_img]");
        $q4->execute(array("Projects/$fileName/".$fileName));
      } 
}


//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/project.php");
die();
?>

