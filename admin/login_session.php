
<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_pw'])) {
	echo "<meta http-equiv='refresh' content='0; url=http://beefiker.cafe24.com/funware/admin/login.php'>";
	exit;
}else{
	
}
?>