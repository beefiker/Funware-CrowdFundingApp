<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//PAYMENT

if (! empty( $_POST[f_etp_value] )){
  $x=	$_POST[f_etp_value_change] / $_POST[f_etp_value];
  $s= $_POST[f_invest] * $x;
  $q4= $db->query("UPDATE tbl_enterprise SET f_etp_value ='$_POST[f_etp_value_change]' WHERE ai_enterprise_id = $_POST[ai_enterprise_id]");
  $q4= $db->query("INSERT INTO tbl_etp_value_history(sys_enterprise_id,f_change_per,f_etp_new)VAlUES ('$_POST[ai_enterprise_id]','$x','$_POST[f_etp_value_change]')");
  $q4= $db->query("UPDATE tbl_payment SET f_invest_new = f_invest_new * '$x' WHERE sys_project_id = $_POST[sys_project_id]");
  $q4= $db->query("INSERT INTO tbl_invest_history
                   SELECT sys_User_ID
                          ,Sys_Project_ID
                          ,SUM(f_Invest)
                          ,SUM(f_Invest) * $x
                          ,$x
                          ,NOW()
                    FROM tbl_payment AS a
                    WHERE Sys_Project_ID = $_POST[sys_project_id]
                    GROUP BY sys_User_ID,Sys_Project_ID");
}else{
  echo '';
}
//PROJECT
?>

<?php
header("Location: http://funware.shop/admin/src/etp.php");
die();
?>
