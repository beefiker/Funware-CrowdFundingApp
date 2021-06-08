<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT

if (! empty( $_POST[f_etp_name] )){
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_name ='$_POST[f_etp_name]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_etp_desc] )){
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_desc ='$_POST[f_etp_desc]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_etp_logo] )){
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_logo ='$_POST[f_etp_logo]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_etp_url] )){
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_url ='$_POST[f_etp_url]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_etp_value] )){
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_value ='$_POST[f_etp_value]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_etp_ir] )){
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_ir ='$_POST[f_etp_ir]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
}else{
  echo '';
}
//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/etp.php");
die();
?>
