<?php
try {
  require '../dbInfo.php';
  include '../isSession.php';

  $email = $_REQUEST["email"];
  $name  = $_REQUEST["name"];

  $q1= $db->prepare('SELECT ai_id, f_user_name FROM funware_user WHERE f_email = ? AND f_user_name = ? AND f_div = "Y";');
  $q1->execute(array($email, $name));

  if($row = $q1->fetch(PDO::FETCH_ASSOC)){
    $_SESSION['userId'] = $row['ai_id'];
    $_SESSION["userName"] = $row_user["f_user_name"];
    $result['success'] = true;
    $result['msg'] = 'exist';
  }else{
    $result['msg'] = '존재하지 않는 회원 정보입니다.';
  }

  


}catch(Exception $e) {
  $result['success'] = false;
  $result['msg'] = '죄송합니다. 서버 오류입니다.';
}finally{
  echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>