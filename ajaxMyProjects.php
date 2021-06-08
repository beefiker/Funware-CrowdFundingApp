<?php 
try{
    require 'dbInfo.php';
    include 'isSession.php';

  // 등록 프로젝트
  $q_regist = $db->query('SELECT sys_register_id
                                ,ai_project_id
                                ,f_project_name
                                ,f_donate_limit
                                ,f_thumbnail
                                ,f_etp_name
                                ,TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS f_percent
                              FROM funware_project
                                LEFT JOIN funware_img
                                ON funware_project.ai_project_id = funware_img.sys_project_id
                                LEFT JOIN funware_payment
                                ON funware_project.ai_project_id = funware_payment.sys_project_id	
                                LEFT JOIN funware_enterprise
                                ON funware_project.ai_project_id = funware_enterprise.sys_project_id	
                              WHERE sys_register_id = '.$_SESSION['userId'].' AND funware_project.f_div ="Y"
                              GROUP BY f_project_name');
  

  // 후원 프로젝트
  $q_spon = $db->query('SELECT ai_project_id
                              ,TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS f_percent
                              ,f_project_name
                              ,f_etp_name
                              ,f_thumbnail
                              ,sys_user_id
                          FROM funware_payment AS j_link
                          RIGHT JOIN(
                            SELECT ai_project_id
                                ,f_project_name
                                ,f_etp_name
                                ,f_thumbnail
                                ,f_donate_limit
                            FROM funware_payment
                            LEFT JOIN funware_project
                                ON funware_payment.sys_project_id = funware_project.ai_project_id
                            LEFT JOIN funware_enterprise
                                ON funware_payment.sys_project_id = funware_enterprise.sys_project_id
                            LEFT JOIN funware_img
                                ON funware_payment.sys_project_id = funware_img.sys_project_id
                            WHERE sys_user_id = '.$_SESSION['userId'].' AND (f_asi ="A" OR f_asi = "S")
                            
                            GROUP BY f_project_name
                            )AS j_invest
                            
                            ON j_invest.ai_project_id = j_link.sys_project_id
                          WHERE sys_user_id = '.$_SESSION['userId'].' AND j_link.f_div = "Y"	
                          GROUP BY f_project_name');
  

  // 투자 프로젝트
  $q_invest = $db->query('SELECT ai_project_id
                                ,TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS f_percent
                                ,f_project_name
                                ,f_etp_name
                                ,f_thumbnail
                                ,sys_user_id
                          FROM funware_payment AS j_link
                              RIGHT JOIN(
                                SELECT ai_project_id
                                    ,f_project_name
                                    ,f_etp_name
                                    ,f_thumbnail
                                    ,f_donate_limit
                                FROM funware_payment
                                    LEFT JOIN funware_project
                                        ON funware_payment.sys_project_id = funware_project.ai_project_id
                                    LEFT JOIN funware_enterprise
                                        ON funware_payment.sys_project_id = funware_enterprise.sys_project_id
                                    LEFT JOIN funware_img
                                        ON funware_payment.sys_project_id = funware_img.sys_project_id
                                WHERE sys_user_id = '.$_SESSION['userId'].' AND (f_asi ="A" OR f_asi = "I")
                                
                                GROUP BY f_project_name
                                )AS j_invest
                            
                            ON j_invest.ai_project_id = j_link.sys_project_id
                          WHERE sys_user_id = '.$_SESSION['userId'].'	 AND j_link.f_div = "Y"
                          GROUP BY f_project_name');
  

  // 북마크 프로젝트
  $q_bookmrk = $db->query('SELECT ai_project_id
                                 ,funware_pj_bookmark.sys_user_id
                                 ,f_project_name
                                 ,f_donate_limit
                                 ,f_thumbnail
                                 ,f_etp_name
                                 ,TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS f_percent
                            FROM funware_pj_bookmark
                                LEFT JOIN funware_project
                                ON funware_pj_bookmark.sys_project_id = funware_project.ai_project_id
                                LEFT JOIN funware_img
                                ON funware_pj_bookmark.sys_project_id = funware_img.sys_project_id
                                LEFT JOIN funware_payment
                                ON funware_pj_bookmark.sys_project_id = funware_payment.sys_project_id	
                                LEFT JOIN funware_enterprise
                                ON funware_pj_bookmark.sys_project_id = funware_enterprise.sys_project_id	
                            WHERE funware_pj_bookmark.sys_user_id = '.$_SESSION['userId'].'	AND funware_project.f_div="Y"
                            GROUP BY f_project_name');
?>
    <div id="myProjects">
    <div id="registProject" class="myProjectsItem">
      <p class="myProjectsTitle">등록한 프로젝트</p>
      <p class="myProjectsNum"><?=$q_regist->rowCount()?> 개</p>
    </div>
    <div id="sponProject" class="myProjectsItem">
      <p class="myProjectsTitle">후원 프로젝트</p>
      <p class="myProjectsNum"><?=$q_spon->rowCount()?> 개</p>
    </div>
    <div id="investProject" class="myProjectsItem">
      <p class="myProjectsTitle">투자한 프로젝트</p>
      <p class="myProjectsNum"><?=$q_invest->rowCount()?> 개</p>
    </div>
    <div id="likeProject" class="myProjectsItem">
      <p class="myProjectsTitle">찜한 프로젝트</p>
      <p class="myProjectsNum"><?=$q_bookmrk->rowCount()?> 개</p>
    </div>
  </div>

  <div id="myProjectList">
    <div class="pListBox">
      <div id="registList" class="listTitle">등록 프로젝트</div>
       <?php 
       echo '<div class ="oh_box">';
       echo'<span id="movieList_slideLeft_regist" class="material-icons md-18 prev">arrow_back_ios</span>';
        echo '<div id="regist_card" class="cards" >';
          while($row_regist = $q_regist->fetch(PDO::FETCH_ASSOC)){
            $projectSize = strlen($row_regist["f_project_name"]);
            $projectName = ($projectSize >= 17) ? $projectName = substr($row_regist["f_project_name"],0, 20).'...': $row_regist["f_project_name"] ;
            echo '<div class="wrapCategoryCard">';
              echo '<div class="cards_contents">';
                echo '<a href="projectDetail.php?p_num='.$row_regist["ai_project_id"].'">';
                  echo '<div class="p_thumnail"><img src="'.$row_regist["f_thumbnail"].'"></div>';
                  echo '<div class="p_infoBox">';
                    echo '<div class="enp_name">', $row_regist["f_etp_name"], '</div>';
                      echo '<div class="p_nameRateBox p_tip">';
                        echo '<div class="p_name">', $projectName, '</div>';
                        echo '<div class="d_rate">', $row_regist["f_percent"], '%</div>';
                        echo '<span>' , $row_regist["f_project_name"] ,'</sapn>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div></a>';
                echo '</div>';
          }
          if($q_regist->rowCount() == 0) echo '<div class="emptySearchedBox">아직 등록하신 프로젝트가 없네요 (ノω<。)..</div>';
        echo '</div>';
        echo '<span id="movieList_slideRight_regist" class="material-icons md-18 next">arrow_forward_ios</span>';
        echo '</div>';
       ?>
    </div>
    <div class="pListBox">
      <div id="spontList" class="listTitle">후원 프로젝트</div>
       <?php 
       echo '<div class ="oh_box">';
       echo'<span id="movieList_slideLeft_spon" class="material-icons md-18 prev">arrow_back_ios</span>';
        echo '<div id="spon_cards" class="cards" >';
          while($row_spon = $q_spon->fetch(PDO::FETCH_ASSOC)){
            $projectSize = strlen($row_spon["f_project_name"]);
            $projectName = ($projectSize >= 17) ? $projectName = substr($row_spon["f_project_name"],0, 20).'...': $row_spon["f_project_name"] ;
            echo '<div class="wrapCategoryCard">';
              echo '<div class="cards_contents">';
                echo '<a href="projectDetail.php?p_num='.$row_spon["ai_project_id"].'">';
                  echo '<div class="p_thumnail"><img src="'.$row_spon["f_thumbnail"].'"></div>';
                  echo '<div class="p_infoBox">';
                    echo '<div class="enp_name">', $row_spon["f_etp_name"], '</div>';
                      echo '<div class="p_nameRateBox p_tip">';
                        echo '<div class="p_name">', $projectName, '</div>';
                        echo '<div class="d_rate">', $row_spon["f_percent"], '%</div>';
                        echo '<span>' , $row_spon["f_project_name"] ,'</sapn>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div></a>';
                echo '</div>';
          }
          if($q_spon->rowCount() == 0) echo '<div class="emptySearchedBox">아직 후원하신 프로젝트가 없네요 (ノω<。)..</div>';
        echo '</div>';
        echo '<span id="movieList_slideRight_spon" class="material-icons md-18 next">arrow_forward_ios</span>';
        echo '</div>';
      ?>
    </div>
    <div class="pListBox">
      <div id="investList" class="listTitle">투자한 프로젝트</div>
       <?php
       echo '<div class ="oh_box">';
       echo'<span id="movieList_slideLeft_invest" class="material-icons md-18 prev">arrow_back_ios</span>'; 
        echo '<div id="invest_cards" class="cards">';
          while($row_invest = $q_invest->fetch(PDO::FETCH_ASSOC)){
            $projectSize = strlen($row_invest["f_project_name"]);
            $projectName = ($projectSize >= 17) ? $projectName = substr($row_invest["f_project_name"],0, 20).'...': $row_invest["f_project_name"] ;
            echo '<div class="wrapCategoryCard">';
              echo '<div class="cards_contents">';
                echo '<a href="projectDetail.php?p_num='.$row_invest["ai_project_id"].'">';
                  echo '<div class="p_thumnail"><img src="'.$row_invest["f_thumbnail"].'"></div>';
                  echo '<div class="p_infoBox">';
                    echo '<div class="enp_name">', $row_invest["f_etp_name"], '</div>';
                      echo '<div class="p_nameRateBox p_tip">';
                        echo '<div class="p_name">', $projectName, '</div>';
                        echo '<div class="d_rate">', $row_invest["f_percent"], '%</div>';
                        echo '<span>' , $row_invest["f_project_name"] ,'</sapn>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div></a>';
                echo '</div>';
          }
          if($q_invest->rowCount() == 0) echo '<div class="emptySearchedBox">아직 투자하신 프로젝트가 없네요 (ノω<。)..</div>';
        echo '</div>';
        echo '<span id="movieList_slideRight_invest" class="material-icons md-18 next">arrow_forward_ios</span>';
        echo '</div>';
       ?>
    </div>
    <div class="pListBox">
      <div id="likeList" class="listTitle">찜한 프로젝트</div>
       <?php 
       echo '<div class ="oh_box">';
       echo'<span id="movieList_slideLeft_bookmark" class="material-icons md-18 prev">arrow_back_ios</span>'; 
        echo '<div id="bookmark_cards" class="cards">';
          while($row_bookmrk = $q_bookmrk->fetch(PDO::FETCH_ASSOC)){
            $projectSize = strlen($row_bookmrk["f_project_name"]);
            $projectName = ($projectSize >= 17) ? $projectName = substr($row_bookmrk["f_project_name"],0, 20).'...': $row_bookmrk["f_project_name"] ;
            echo '<div class="wrapCategoryCard">';
              echo '<div class="cards_contents">';
                echo '<a href="projectDetail.php?p_num='.$row_bookmrk["ai_project_id"].'">';
                  echo '<div class="p_thumnail"><img src="'.$row_bookmrk["f_thumbnail"].'"></div>';
                  echo '<div class="p_infoBox">';
                    echo '<div class="enp_name">', $row_bookmrk["f_etp_name"], '</div>';
                      echo '<div class="p_nameRateBox p_tip">';
                        echo '<div class="p_name">', $projectName, '</div>';
                        echo '<div class="d_rate">', $row_bookmrk["f_percent"], '%</div>';
                        echo '<span>' , $row_bookmrk["f_project_name"] ,'</sapn>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div></a>';
                echo '</div>';
          }
          if($q_bookmrk->rowCount() == 0) echo '<div class="emptySearchedBox">아직 찜꽁하신 프로젝트가 없네요 (ノω<。)..</div>';
        echo '</div>';
        echo '<span id="movieList_slideRight_bookmark" class="material-icons md-18 next">arrow_forward_ios</span>';
        echo '</div>';
       ?>
    </div>
  </div>
<?php
    }catch(Exception $e){
        echo $e;
    } 
?>
