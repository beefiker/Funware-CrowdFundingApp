<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT

if (! empty( $_POST[f_div] )){
  $q4= $db->query("UPDATE tbl_payment SET f_div ='$_POST[f_div]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_date] )){
    $f_date = str_replace('-','',$_POST[f_date]);
    $q4= $db->query("UPDATE tbl_payment SET f_date =$f_date WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_asi] )){
  $q4= $db->query("UPDATE tbl_payment SET f_asi ='$_POST[f_asi]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_invest] )){
  $q4= $db->query("UPDATE tbl_payment SET f_invest ='$_POST[f_invest]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_spon] )){
  $q4= $db->query("UPDATE tbl_payment SET f_spon ='$_POST[f_spon]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_cardbank] )){
  $q4= $db->query("UPDATE tbl_payment SET f_cardbank ='$_POST[f_cardbank]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_cardnum] )){
  $q4= $db->query("UPDATE tbl_payment SET f_cardnum ='$_POST[f_cardnum]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_cardpw] )){
  $q4= $db->query("UPDATE tbl_payment SET f_cardpw ='$_POST[f_cardpw]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

if (! empty( $_POST[f_halbu] )){
  $q4= $db->query("UPDATE tbl_payment SET f_halbu ='$_POST[f_halbu]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_name] )){
  $q4= $db->query("UPDATE tbl_payment SET f_name ='$_POST[f_name]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_num] )){
  $q4= $db->query("UPDATE tbl_payment SET f_num ='$_POST[f_num]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_sf_desc] )){
  $q4= $db->query("UPDATE tbl_payment SET f_sf_desc ='$_POST[f_sf_desc]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}
if (! empty( $_POST[f_paykey] )){
  $q4= $db->query("UPDATE tbl_payment SET f_paykey ='$_POST[f_paykey]' WHERE ai_payment_id = $_POST[ai_payment_id]");
}else{
  echo '';
}

//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/payment.php");
die();
?>

