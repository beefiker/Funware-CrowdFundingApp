<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
  require '../dbInfo.php';
  require "../phpMailer/src/PHPMailer.php";
  require "../phpMailer/src/SMTP.php";
  require "../phpMailer/src/Exception.php";
  include '../isSession.php';
  $ini = parse_ini_file('config.ini');

  $p_num = $_REQUEST["p_num"];
  $etp_name = $_REQUEST["etp_name"];
  $pathIR = $_REQUEST["pathIR"];

  $mail = new phpMailer(true);
  // find email
  $q1= $db->prepare('SELECT f_email FROM funware_user WHERE ai_id = ?;');
  $q1->execute(array($_SESSION['userId']));
  $row = $q1->fetch(PDO::FETCH_ASSOC);
  $email = $row["f_email"];

//   echo $email;

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = '<?=$ini["mail_email"]?>';
  $mail->Password = '<?=$ini["mail_password"]?>';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = '465';
  $mail->CharSet = 'utf-8';
  // 보내는 메일
  $mail->SetFrom("funware@gmail.com","FUNWARE");
  // 받는 메일
  $mail->AddAddress($email,"Funny");
  // 메일 내용
  $mail->isHTML(true);

  // find projectName
  $q2= $db->prepare('SELECT f_project_name FROM funware_project WHERE ai_project_id = ?;');
  $q2->execute(array($p_num));
  $row = $q2->fetch(PDO::FETCH_ASSOC);
  $pName = $row["f_project_name"];


  $mail->Subject = '[FUNWARE] '.$etp_name.' 사의 IR 자료입니다.';
  // 더미자료인지
  if(strpos($pathIR,'https://') !== false || strpos($pathIR,'http://') !== false){  
    //   더미자료임
    $mail->Body = $pathIR.'<br>프로젝트 '.$pName.'에 관심을 가져주셔서 감사합니다.';
  }else{
    //   더미 아님
    $mail -> addAttachment("../".$pathIR);
    $mail->Body = '프로젝트 '.$pName.'에 관심을 가져주셔서 감사합니다.';
  }
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

  }catch(Exception $e) {
    // "죄송 서버 오류"
    echo $e;
  }finally{
    // 있어보이게 json화
    // echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  }
?>
