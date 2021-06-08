<?php 
try{
    require '../dbInfo.php';
    include '../isSession.php';

    $n_num = $_REQUEST["n_num"];
    $newDat = $_REQUEST["newDat"];
    // $n_num = 7;

    // 새 댓글
    if($user_login && $newDat != ''){
        $q = $db->query('INSERT INTO funware_notice_dat (sys_notice_id, sys_user_id, f_dat, f_div) VALUES ('.$n_num.', '.$_SESSION['userId'].', "'.$newDat.'", "Y");');
    }

    // 댓글 출력
    $q2 = $db->prepare('SELECT ai_dat_id, sys_user_id, f_dat, funware_notice_dat.auto_date, funware_user.f_profile, funware_user.f_user_name
                         FROM   funware_notice_dat 
                          LEFT JOIN funware_user 
                                          ON funware_user.ai_id = funware_notice_dat.sys_user_id
                         WHERE  sys_notice_id = ? AND  funware_notice_dat.f_div = "Y" ORDER BY funware_notice_dat.auto_date DESC;');

    $q2->execute(array($n_num));

    while($row = $q2->fetch(PDO::FETCH_ASSOC)){ 
        $row["f_profile"] = ($row["f_profile"] == NULL) ? "img/defaultProfile.jpg" : $row["f_profile"];

        echo '<div class="singleDat">';
            echo '<div class="datRightBox">';
                echo '<img class="dat_userImg" src="', $row["f_profile"], '" alt="">';
            echo '</div>';
            echo '<div class="datLeftBox">';
               
                echo '<div class="dat_info">';
                    echo '<div>';
                        echo '<span class="dat_nickname">', $row["f_user_name"], '</span>';
                        echo '<span class="dat_time">', $row["auto_date"], '</span>';
                    echo '</div>';

                    if(isset($_SESSION['userId']) && $row["sys_user_id"] === $_SESSION['userId']){
                        echo '<div>';
                            echo '<span class="modifyDat" id="modify'.$row["ai_dat_id"].'">수정</span>&nbsp;&nbsp;';
                            echo '<a href="sub_src/deleteDat.php?d_num='.$row["ai_dat_id"].'">';
                                echo '<span class="deleteDat">삭제</span>';
                            echo '</a>';
                        echo '</div>';
                    }

                echo '</div>';

                echo '<div class="dat_content" id="granma'.$row["ai_dat_id"].'"><p>', $row["f_dat"], '</p></div>';
                if(isset($_SESSION['userId']) && $row["sys_user_id"] === $_SESSION['userId']){
                    echo '<form action="sub_src/modifyDat.php"><p class="formModify" id="datNum'.$row["ai_dat_id"].'">';
                    // echo '<form action="sub_src/modifyDat.php?d_num='.$row["ai_dat_id"].'&"><p class="formModify" id="datNum'.$row["ai_dat_id"].'">';
                        echo '<input type="text" class="modifyHiddenInput" name="modifyHiddenInput" value="'.$row["ai_dat_id"].'">';
                        echo '<input type="text" class="inputModifyDat" name="modifyContent">';
                        echo '<button type="submit" class="btnSubmitModify">수정</button>';
                    echo '</p></form>';
                }
            echo '</div>';
        echo '</div>';
    }

?>
<script>
    // 댓글 수정 
    $(".modifyDat").click(function() {
        let temp = $(this).attr('id');
        temp = temp.replace("modify", "").trim();
        formModify = document.getElementById('datNum' + temp);
        grandma = document.getElementById('granma' + temp);

        $(grandma).css({"display" : "none"});
        $(formModify).css({"display" : "block"});
        console.log(grandma);
    });
</script>
<?php


}catch(Exception $e){
    echo $e;
} 
?>
