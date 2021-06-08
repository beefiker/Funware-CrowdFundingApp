<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
  require 'dbInfo.php';
  $ini = parse_ini_file('config.ini');
  // echo phpversion(); // 7.4.5

  $isSend = false;
  // 테스트 데이터 받기
  // $email = '0minsol0@g.shingu.ac.kr';
  $email = $_REQUEST["email"];
  $done = "입력하신 이메일로 임시 비밀번호를 발송했습니다.";
  $fail = "가입하지 않은 이메일입니다.";
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

  // phpMailer setting
  // use PHPMailer\PHPMailer\PHPMailer;
  // use PHPMailer\PHPMailer\Exception;

  require "phpMailer/src/PHPMailer.php";
  require "phpMailer/src/SMTP.php";
  require "phpMailer/src/Exception.php";

  $mail = new phpMailer(true);

  // 이메일 값 검사

    $q1= $db->prepare('SELECT f_user_pw FROM funware_user WHERE f_email = ?;');
    $q1->execute(array($email));

    if($row = $q1->fetch(PDO::FETCH_ASSOC)){
      // 토큰 발급
      $token = GenerateString(10);
      // 유저 테이블 update
      $q2 = $db->prepare('UPDATE funware_user
                            SET f_user_pw = "" , f_token = ?
                          WHERE funware_user.f_email = ?;');
      $q2->execute(array($token, $email));
      // 이메일 보내기
      $mail->isSMTP();

      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = $ini["mail_email"];
      $mail->Password = $ini["mail_password"];
      $mail->SMTPSecure = 'ssl';
      $mail->Port = '465';

      $mail->CharSet = 'utf-8';

      // 보내는 메일
      $mail->SetFrom("funware@gmail.com","FUNWARE");

      // 받는 메일
      $mail->AddAddress($email,"Funny");

      // 메일 내용
      // $mail->isHTML(true);
      $mail->Subject = 'Funware 임시 비밀번호입니다.';
      $mail->Body = '회원님의 임시 비밀번호는 '.$token.' 입니다. 비밀번호를 반드시 변경 후 서비스를 이용해주세요.';

      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false
          ,'verify_peer_name' => false
          ,'allow_self_signed' => true
        )
      );

      // 메일 전송
      $mail->send();
      // 리턴 값 전송
      $isSend = true;
      // result라는 이름의 배열 생성
      $result['isSend'] = $isSend;
      $result['done'] = $done;
      $result['fail'] = $fail;
    }else{
    // 없으면 안 보냄 "가입되지 않은 이메일"
      $result['isSend'] = $isSend;
      $result['done'] = $done;
      $result['fail'] = $fail;
    }

  }catch(Exception $e) {
    // "죄송 서버 오류"
    $result['isSend'] = $isSend;
    $result['done'] = $done;
    $result['fail'] = $fail;
  }finally{
    // 있어보이게 json화
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  }
?>
