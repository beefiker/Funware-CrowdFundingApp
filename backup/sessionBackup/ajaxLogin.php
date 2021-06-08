<?php
try {
  require 'dbInfo.php';

  // 데이터 받기
  // $email    = '0minsol0@g.shingu.ac.kr';
  $email    = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  // $password = 'minsol';
  // 암호화 function
  function Encrypt($str){
    // secreat key = 'funware', secreat iv = 'tlsrn815'
    $key = hash('sha256', 'funware');
    $iv = substr(hash('sha256', 'tlsrn815'), 0, 16);
    return str_replace("=", "", base64_encode(
                 openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
    );
  }

  $q1= $db->query('SELECT ai_id FROM tbl_user WHERE f_email = "'.$email.'";');
  // 이메일 있다~
  if($row = $q1->fetch(PDO::FETCH_ASSOC)){
    // PW, token 확인
    $q2= $db->query('SELECT f_user_name, f_user_pw, f_token FROM tbl_user WHERE f_email = "'.$email.'";');
    $row_user = $q2->fetch(PDO::FETCH_ASSOC);

    if($row_user['f_user_pw'].$row_user['f_token'] == Encrypt($password).$row_user['f_token']){
      // 로그인 성공
      $result['success'] = true;
      $result['msg'] = $row_user['f_user_name'].'님 로그인 되었습니다.';
      // echo $row_user['f_user_name'].'님 로그인 되었습니다.';
    }else{
      $result['success'] = false;
      $result['msg'] = '비밀번호를 잘못 입력하셨습니다.';
      // echo '비밀번호를 잘못 입력하셨습니다.';
    }
  // 이메일 없다!
  }else{
    $result['success'] = false;
    $result['msg'] = '존재하지 않는 이메일입니다.';
    // echo '존재하지 않는 이메일입니다.';
  }

}catch(Exception $e) {
  $result['success'] = false;
  $result['msg'] = '죄송합니다. 서버 오류입니다.';
}finally{
  echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
