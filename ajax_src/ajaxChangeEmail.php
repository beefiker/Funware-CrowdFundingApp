<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  $ini = parse_ini_file('config.ini');

  $email = $_REQUEST["email"];
  $inputAuthNum = $_REQUEST["authNum"];
  $workNum = $_REQUEST["workNum"]; // 작업번호 (1. 인증번호전송 2. 인증번호확인 3. 이메일변경)
  $memberDiv = $_REQUEST["memberDiv"]; // 회원구분 (1. 기존비활성이메일 2. 기존활성이메일 3. 신규이메일)
  $agreeMarketing = $_REQUEST["agreeMarketing"];

  // return 값 초기화
  $mailSuccess = false;
  $authSuccess = false;

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
  // 메일 전송 function
  function SendMail($email, $authNum){
      require "../phpMailer/src/PHPMailer.php";
      require "../phpMailer/src/SMTP.php";
      require "../phpMailer/src/Exception.php";

      $mail = new phpMailer(true);
      
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
      // $mail->isHTML(true);
      $mail->Subject = 'Funware 인증코드입니다.';
      $mail->Body = '인증코드는 '.$authNum.' 입니다.';
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false
          ,'verify_peer_name' => false
          ,'allow_self_signed' => true
        )
      );
      // 메일 전송
      $mail->send();
  }

  try {
    require '../dbInfo.php';
    include '../isSession.php';

    // workNum = 1, 인증번호 전송
    if($workNum == 1){
      // 이메일 검사
    	$q1= $db->prepare('SELECT f_div FROM funware_user WHERE f_email = ?;');
      $q1->execute(array($email));

      // 디비에 이메일이 있을 경우
    	if($row = $q1->fetch(PDO::FETCH_ASSOC)){
          if($row["f_div"] == "N"){ // 디비에 있고 N : 기존비활성이메일
              // 인증번호 발급
              $authNum = GenerateString(10);
              
              // 인증번호 디비 저장
              $q2 = $db->prepare('UPDATE funware_user
                                    SET f_token = ?
                                  WHERE funware_user.ai_id = ?;');
              $q2->execute(array($authNum, $_SESSION['userId']));
              
              // 메일 인증번호 전송
              SendMail($email, $authNum);

              // return 값 설정
              $memberDiv = 1;
              $mailSuccess = true;
              $authSuccess = false;

              $result['memberDiv'] = $memberDiv;
              $result['mailSuccess'] = $mailSuccess;
              $result['authSuccess'] = $authSuccess;
              $result['msg'] = '기존비활성이메일';

          }else if($row["f_div"] == "Y"){ // 디비에 있고 Y : 기존활성이메일
              // 이미 가입된 회원임을 안내 << 자바스크립트에서

              // return 값 설정
              $memberDiv = 2;
              $mailSuccess = false;
              $authSuccess = false;

              $result['memberDiv'] = $memberDiv;
              $result['mailSuccess'] = $mailSuccess;
              $result['authSuccess'] = $authSuccess;
              $result['msg'] = '기존활성이메일';
          }

      // 디비에 이메일이 없을 경우
      }else{ // 신규이메일
        // 인증번호 발급 
        $authNum = GenerateString(10);

        // 디비 저장__이메일
        $q2 = $db->prepare('UPDATE funware_user
                              SET  f_token = ?
                            WHERE funware_user.ai_id = ?;');
        $q2->execute(array($authNum, $_SESSION['userId']));

        // 인증번호 전송
        SendMail($email, $authNum);
         
        // return 값 설정
        $memberDiv = 3;
        $mailSuccess = true;
        $authSuccess = false;

        $result['memberDiv'] = $memberDiv;
        $result['mailSuccess'] = $mailSuccess;
        $result['authSuccess'] = $authSuccess;
        $result['msg'] = '신규이메일';
      }

    // workNum = 2, 인증번호 확인__(1. 기존비활성이메일 2. 기존활성이메일 3. 신규이메일)
    }else if($workNum == 2){

      $q2 = $db->prepare('SELECT f_token FROM funware_user WHERE ai_id = ?');
      $q2->execute(array($_SESSION['userId']));  
      $row2 = $q2->fetch(PDO::FETCH_ASSOC);
      $token = $row2["f_token"];

      // $result['msg'] = 'workNum = 2';

    	if($memberDiv == 1 || $memberDiv == 3){
        
    		if($inputAuthNum == $token){ // 인증번호 일치

          // return 값 설정
          $mailSuccess = true;
          $authSuccess = true; // 얘만 있어도 되나?

          $result['memberDiv'] = $memberDiv;
          $result['mailSuccess'] = $mailSuccess;
          $result['authSuccess'] = $authSuccess;
          $result['msg'] = '인증번호 일치';

        }else{ // 인증번호 불일치

          // return 값 설정
          $mailSuccess = true;
          $authSuccess = false; // 얘만 있어도 되나?

          $result['memberDiv'] = $memberDiv;
          $result['mailSuccess'] = $mailSuccess;
          $result['authSuccess'] = $authSuccess;
          $result['msg'] = '인증번호 불일치';
        }
      }

    // workNum =  3, 이메일 변경
    }else if($workNum == 3){

      $q2 = $db->prepare('SELECT f_token FROM funware_user WHERE ai_id = ?');
      $q2->execute(array($_SESSION['userId']));  
      $row2 = $q2->fetch(PDO::FETCH_ASSOC);
      $token = $row2["f_token"];

      $result['msg'] = $agreeMarketing;

      $f_marketing = ($agreeMarketing == true) ? 1 : 0;

        
    	if($inputAuthNum == $token){ // 인증번호 일치
        // 디비 업뎃
        $q2 = $db->prepare('UPDATE funware_user
                              SET f_email = ?, f_marketing = ?
                            WHERE funware_user.f_token = ?;');
        $q2->execute(array($email, $f_marketing, $inputAuthNum));
        
        // return 값 설정
        $mailSuccess = true;
        $authSuccess = true;
        // 디비 잘 바뀌었다는 result가 있으면 좋겠음
        $result['memberDiv'] = $memberDiv;
        $result['mailSuccess'] = $mailSuccess;
        $result['authSuccess'] = $authSuccess;
        $result['msg'] = '인증번호 일치, email update';
      }
    }

    // $result['msg'] = '마이크테스트';

    }catch(Exception $e) {
      echo $e;
    }finally{
      // 있어보이게 json화
      echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
?>
