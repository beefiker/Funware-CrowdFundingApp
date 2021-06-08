<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT

if (! empty( $_POST[c_div] )){
  $q4= $db->query("UPDATE tbl_category SET f_div ='$_POST[c_div]' WHERE ai_category = $_POST[ai_category]");
}else{
  echo '';
}
if (! empty( $_POST[f_category_name] )){
    $q4= $db->query("UPDATE tbl_category SET f_category_name ='$_POST[f_category_name]' WHERE ai_category = $_POST[ai_category]");
  }else{
    echo '';
  }

//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/main.php");
die();
?>
