<?php
try {
require 'dbInfo.php';
include 'isSession.php';
$ini = parse_ini_file('config.ini');

$p_num = $_REQUEST['p_num'];
$i_week = $_REQUEST['i_week'];
$rewardID = $_REQUEST['rewardID'];

$paymentKey = $_REQUEST['paymentKey'];
$orderId = $_REQUEST['orderId'];
$amount = $_REQUEST['amount'];

$saveAddr = $_REQUEST['saveAddr'];
$postcode = $_REQUEST['postcode'];
$address = $_REQUEST['address'];
$detailAddress = $_REQUEST['detailAddress'];
$phoneNum = $_REQUEST['phoneNum'];

// 이 페이지에서 ini의 tossPayments_key를 불러와 쓰질 못해서 넘겨받음 -문자열 인식이 안되는 듯
$sk = $_REQUEST['sk'];

// echo $phoneNum;
// echo "<br>주문번호 : ".$orderId;
$secretKey = $sk; 
// $secretKey = 'test_sk_ADpexMgkW36bljvKOO93GbR5ozO0';

$url = 'https://api.tosspayments.com/v1/payments/' . $paymentKey;

$data = ['orderId' => $orderId, 'amount' => $amount];

$credential = base64_encode($secretKey . ':');

$curlHandle = curl_init($url);

curl_setopt_array($curlHandle, [
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' . $credential,
        'Content-Type: application/json'
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($curlHandle);

$httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
$isSuccess = $httpCode == 200;
$responseJson = json_decode($response);
if ($isSuccess) {

    $payAmount = json_encode($responseJson->totalAmount, JSON_UNESCAPED_UNICODE);
    $cardCompany = json_encode($responseJson->card->company, JSON_UNESCAPED_UNICODE);
    $cardNumber = json_encode($responseJson->card->number, JSON_UNESCAPED_UNICODE);
    $payMonth = json_encode($responseJson->card->installmentPlanMonths, JSON_UNESCAPED_UNICODE);

    // echo "리워드 : ".$rewardID;
    
    if($payAmount == $amount){

        if($rewardID == 0){
            // asi = i
            // echo "asi = i";
            $q1 = $db->prepare("CALL up_payment_insert(@v_success ,@v_Message, ?, ?, ?, NULL, ?, ?, ?, ?, ?, ?, ?);");
            $q1->execute(array($_SESSION['userId'], $p_num, $i_week, $cardCompany, $cardNumber, $payMonth, $_SESSION['userName'], $phoneNum, $httpCode, $paymentKey));
            $q1->closeCursor();
        }else{
            // asi = a | s
            // echo "asi = a | s";
            $q1 = $db->prepare("CALL up_payment_insert(@v_success ,@v_Message, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $q1->execute(array($_SESSION['userId'], $p_num, $i_week, $rewardID, $cardCompany, $cardNumber, $payMonth, $_SESSION['userName'], $phoneNum, $httpCode, $paymentKey));
            $q1->closeCursor();
        }

        $q2 = $db->prepare("SELECT ai_enterprise_id, f_etp_name, f_etp_ir FROM funware_enterprise WHERE sys_project_id = ?");
        $q2->execute(array($p_num));
        if($row = $q2->fetch(PDO::FETCH_ASSOC)){
            $etp_name = $row["f_etp_name"];
            $pathIR = $row["f_etp_ir"];
        }
        $q2->closeCursor();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>결제중</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
</head>
<body style="display: flex; flex-direction: column; margin: 100px;">
    <h1 style="margin: 0 auto;">결제가 완료되면 이메일로 IR자료가 전송됩니다.</h1>
    <img src="img/loading.gif" style="margin: 0 auto; width: 50%">
<script src="../js/jquery/jquery-3.6.0.min.js"></script>
<script>
        $.ajax({
            url: "ajax_src/ajaxpayMail.php",
            type: "post",
            // dataType: "json",
            data: { 
                p_num : '<?=$p_num?>',
                etp_name : '<?=$etp_name?>',
                pathIR : '<?=$pathIR?>'
             },
            success: () => {
                alert("결제가 정상적으로 진행되었습니다.");
                location.replace('myPage.php');
            }
        });
</script>
</body>
</html>

<?php
        
    }


} else {
    echo "<br>message ".json_encode($responseJson->message, JSON_UNESCAPED_UNICODE);
    echo "<br>card ".json_encode($responseJson->code, JSON_UNESCAPED_UNICODE);
}

// 기본 배송지 변경
if($saveAddr == "Y"){
    $q3 = $db->prepare("UPDATE funware_user SET f_post_num = ?, f_roadname = ?, f_address_detail = ? WHERE ai_id = ?;"); 
    $q3->execute(array($postcode, $address, $detailAddress, $_SESSION['userId']));
}
?>

<?php
}catch(Exception $e){
  echo $e;
}