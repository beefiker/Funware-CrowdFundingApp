<?php 
try{
    require '../dbInfo.php';
    include '../isSession.php';
    $ini = parse_ini_file('config.ini');

    // $currentPW = '1234';
    // $newPW = 'asdfg';
    // $checkNewPW = 'asdfg';

    // $workNum = 2;
    // $agreeMarketing = 1;
    $currentPW = $_REQUEST["currentPW"];
    $newPW = $_REQUEST["newPW"];
    $checkNewPW = $_REQUEST["checkNewPW"];
    $workNum = $_REQUEST["workNum"]; // 작업번호 (1. 현재 비밀번호 확인 2. 새 비밀번호로 변경)
    $agreeMarketing = $_REQUEST["agreeMarketing"];

    $currChecked = false;
    $pwChanged = false;

    // 암호화 function
    function Encrypt($str){
        $key = hash('sha256', 'funware');
        $iv = substr(hash('sha256', 'tlsrn815'), 0, 16);
        return str_replace("=", "", base64_encode(
                    openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
        );
    }
    $q1= $db->prepare('SELECT f_user_pw, f_token FROM funware_user WHERE ai_id = ?;');
    $q1->execute(array($_SESSION['userId']));
    $row_user = $q1->fetch(PDO::FETCH_ASSOC);


    // 1. 현재 비밀번호 확인
    if($workNum == 1){
        // echo "token is ".$row_user['f_token'],"<br><br>";
        // 현재 비밀번호 일치여부
        if($row_user['f_user_pw'] == Encrypt($currentPW.$row_user['f_token'])){
            // 일치
            $currChecked = true;
            $result['currChecked'] = $currChecked;
        }else{
            if(($row_user['f_user_pw'].$row_user['f_token']) == $currentPW){
                // 일치
                $currChecked = true;
                $result['currChecked'] = $currChecked;
            }else{
            // 불일치
                $result['currChecked'] = $currChecked;
            }
        }

    // 2. 새 비밀번호로 변경
    }else if($workNum == 2){

        // echo "token is ".$row_user['f_token'],"<br><br>";
        $f_marketing = ($agreeMarketing === true) ? 1 : 0;

        // 비번 변경

        $newPW = Encrypt($newPW.$row_user['f_token']);
        // echo "encryption(only newPW) : <br>",Encrypt($newPW), "<br><br>";
        // echo "encryption(newPW + token) : <br>", Encrypt($newPW.$row_user['f_token']), "<br>";
        // echo "not-encrypt : ",$newPW, "<br>";

        $q2 = $db->prepare('UPDATE funware_user
                                SET f_user_pw = ?, f_marketing = ?
                            WHERE funware_user.ai_id = ?;');
        $q2->execute(array($newPW, $f_marketing, $_SESSION['userId']));

        // return
        $pwChanged = true;
        $result['pwChanged'] = $pwChanged;
    }else{
        // 잘못된 접근방식입니다.
        $result['currChecked'] = $currChecked;
        $result['pwChanged'] = $pwChanged;
    }

    

}catch(Exception $e){
    echo $e;
}finally{
  // 있어보이게 json화
  echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>