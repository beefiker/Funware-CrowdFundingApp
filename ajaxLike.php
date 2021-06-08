<?php 
try{
    require 'dbInfo.php';
    include 'isSession.php';

    $userID = $_REQUEST["userId"];
    $p_num = $_REQUEST["p_num"];

    $q_isLike= $db->query('SELECT * FROM funware_pj_bookmark WHERE sys_user_id = '.$userID.' AND sys_project_id = '.$p_num.';');

    if($row = $q_isLike->fetch(PDO::FETCH_ASSOC)){
        // 1 : 좋아요 취소
        $q = $db->query('DELETE FROM funware_pj_bookmark WHERE sys_user_id = '.$userID.' AND sys_project_id = '.$p_num.';');
        // 2 : echo 빈 하트 
        echo "<img src='img/like.png'>";
    }else{
        // 1 : 좋아요
        $q2 = $db->query('INSERT INTO funware_pj_bookmark (sys_user_id, sys_project_id) VALUES ('.$userID.', '.$p_num.');');
        // 2 : echo 꽉 찬 하트 
        echo "<img src='img/liked.png'>";
    }
    

}catch(Exception $e){
    echo $e;
} 
?>
