<?php
try {
    require '../dbInfo.php';
    include '../isSession.php';
    $ini = parse_ini_file('config.ini');

    $inputPW = $_REQUEST["pw"];

    // 암호화 function
    function Encrypt($str){
        $key = hash('sha256', 'funware');
        $iv = substr(hash('sha256', 'tlsrn815'), 0, 16);
        return str_replace("=", "", base64_encode(
                    openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
        );
    }

    if(!$inputPW == ""){
        // 비번 입력 받았을 때
        $q1= $db->prepare('SELECT f_user_pw, f_token FROM funware_user WHERE ai_id = ?;');
        $q1->execute(array($_SESSION['userId']));
        $row_pw = $q1->fetch(PDO::FETCH_ASSOC);

        // 비밀번호 일치
        if($row_pw['f_user_pw'] == Encrypt($inputPW.$row_pw['f_token'])){
            // 테이블 업데이트
            $q2= $db->prepare("UPDATE funware_user SET f_div = 'N' WHERE ai_id = ?");
            $q2->execute(array($_SESSION['userId']));
            // 세션 삭제(로그아웃), 
            unset($_SESSION["userId"]);
            unset($_SESSION["userName"]);

            $result['msg'] = '탈퇴되었습니다.';
        
        // 비밀번호 불일치
        }else{
            $result['msg'] = '비밀번호를 잘못 입력하셨습니다.';
        }
    }else{
        // 입력이 공란일 때
        $result['msg'] = '비밀번호를 입력해주세요.';
    }

}catch(Exception $e){
    echo $e;
    $result['msg'] = '죄송합니다. 서버 오류입니다.';
}finally{
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>