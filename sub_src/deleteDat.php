<?php 
try{
    require '../dbInfo.php';
    include '../isSession.php';

    $d_num = $_REQUEST["d_num"];

    $q = $db->query("UPDATE funware_notice_dat SET f_div = 'N' WHERE ai_dat_id = ".$d_num.";");
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
    </script>
</body>
</html>
<?php

}catch(Exception $e){
    echo $e;
} 
?>
