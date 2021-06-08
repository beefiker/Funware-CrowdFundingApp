<?php 
try{
    require '../dbInfo.php';
    include '../isSession.php';

    $d_num = $_REQUEST["modifyHiddenInput"];
    $modifyContent = $_REQUEST["modifyContent"];
    // echo $d_num."<br>";
    // echo $modifyContent."<br>";

    $q1= $db->prepare('UPDATE funware_notice_dat SET f_dat = ? WHERE ai_dat_id = ?;');
    $q1->execute(array($modifyContent, $d_num));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <script>
        history.back();
        // location.replace(history);
    </script>
</body>
</html>
<?php
}catch(Exception $e){
    echo $e;
}
?>
