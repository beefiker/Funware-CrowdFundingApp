<?php
        try {
                require 'dbInfo.php';
        }catch(Exception $e){
                echo $e;
        }
        
        function Encrypt($str){
                // secreat key = 'funware', secreat iv = 'tlsrn815'
                $key = hash('sha256', 'funware');
                $iv = substr(hash('sha256', 'tlsrn815'), 0, 16);
                return str_replace("=", "", base64_encode(
                             openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
                );
        }

if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

$q_user= $db->prepare('SELECT ai_id, f_user_pw, f_token FROM funware_user WHERE f_email = ? AND f_div = "Y";');
$q_user->execute(array($user_id));
$row_user = $q_user->fetch(PDO::FETCH_ASSOC);
$db_id = $row_user["ai_id"];
$db_pw = $row_user["f_user_pw"];
$db_token = $row_user["f_token"];

if($db_pw == Encrypt($user_pw.$db_token)) {
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_pw'] = $user_pw;       
}else{
        echo "<script>alert('이메일 또는 패스워드가 잘못되었습니다.');history.back();</script>";
        exit;
}
?>
<meta http-equiv='refresh' content='0; url=http://beefiker.cafe24.com/funware/admin/'>
