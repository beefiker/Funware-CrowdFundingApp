<?php
  try {
  require 'dbInfo.php';
  }catch(Exception $e){
    echo $e;
  }

//PAYMENT

if(! empty( $_POST[f_div])){
  if ( $_POST[f_div] == 'N' ){
    $q4= $db->query("UPDATE funware_user SET f_div ='$_POST[f_div]', f_email='NULL' WHERE ai_id = $_POST[ai_id]");
  }else{
    $q4= $db->query("UPDATE funware_user SET f_div ='$_POST[f_div]' WHERE ai_id = $_POST[ai_id]");
  }
}else{
  echo '';
}

if (! empty( $_POST[f_email] )){
  $q4= $db->query("UPDATE funware_user SET f_email ='$_POST[f_email]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_user_pw] )){
  $q4= $db->query("UPDATE funware_user SET f_user_pw ='$_POST[f_user_pw]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_user_name] )){
  $q4= $db->query("UPDATE funware_user SET f_user_name ='$_POST[f_user_name]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_profile] )){
  $q4= $db->query("UPDATE funware_user SET f_profile ='$_POST[f_profile]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[auto_date] )){
  $q4= $db->query("UPDATE funware_user SET auto_date ='$_POST[auto_date]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_token] )){
  $q4= $db->query("UPDATE funware_user SET f_token ='$_POST[f_token]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_marketing] )){
  $q4= $db->query("UPDATE funware_user SET f_marketing ='$_POST[f_marketing]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_user_address] )){
  $q4= $db->query("UPDATE funware_user SET f_user_address ='$_POST[f_user_address]' WHERE ai_id = $_POST[ai_id]");
}else{
  echo '';
}

//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/user.php");
die();
?>

