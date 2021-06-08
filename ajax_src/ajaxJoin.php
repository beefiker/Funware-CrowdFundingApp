<?php
try {
  require '../dbInfo.php';
  $ini = parse_ini_file('config.ini');

  // 데이터 받기
  $name     = $_REQUEST["name"];
  $email    = $_REQUEST["email"];
  $chkMkt = ($_REQUEST["chkMkt"]) ? 1 : 0;

  // 토큰 발급 function
  function GenerateString($length){
     $characters  = "0123456789";
     $characters .= "abcdefghijklmnopqrstuvwxyz";
     $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $characters .= "_";

     $string_generated = "";

     $nmr_loops = $length;
     while ($nmr_loops--)
     {
         $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
     }

     return $string_generated;
  }
  // 암호화 function
  function Encrypt($str){
    $key = hash('sha256', 'funware');
    $iv = substr(hash('sha256', 'tlsrn815'), 0, 16);
    return str_replace("=", "", base64_encode(
                 openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
    );
  }

  // 이메일 값 검사
  $q1= $db->prepare('SELECT f_user_pw FROM funware_user WHERE f_email = ? AND f_div = "Y";');
  $q1->execute(array($email));
  // 신규회원
  if(!($row = $q1->fetch(PDO::FETCH_ASSOC))){
    // 토큰 발급
    $token = GenerateString(10);
    // PW, token 암호화
    // $password = Encrypt($_REQUEST["password"]);
    $password = Encrypt($_REQUEST["password"].$token);
    // insert user
    $q2 = $db->query("INSERT INTO funware_user (f_email, f_user_pw, f_user_name, auto_date, f_token, f_marketing, f_div)
                      VALUES ('".$email."', '".$password."', '".$name."', CURRENT_TIMESTAMP, '".$token."', '".$chkMkt."', 'Y');");

    $result['msg'] = true;
  // 기존 회원
  }else{
    $result['msg'] = false;
  }

}catch(Exception $e) {
  $result['msg'] = '죄송합니다. 서버 오류입니다.';
}finally{
  // 있어보이게 json화
  echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
