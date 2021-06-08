<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';
  
  if($user_login && $_SESSION["userId"]) {
    // echo $user_login;
    $q_user= $db->prepare('SELECT f_user_name, f_profile FROM funware_user WHERE ai_id = ? AND f_div = "Y";');
    $q_user->execute(array($_SESSION["userId"]));
    $row_user = $q_user->fetch(PDO::FETCH_ASSOC);
    $row_user["f_profile"] = ($row_user["f_profile"] == "") ? "img/defaultProfile.jpg" : $row_user["f_profile"];
  }
?>

<!doctype html>
  <head>
  <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/7637a8f104.js" crossorigin="anonymous"></script>

    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <link rel="stylesheet" href="css/funware_src/cards.css">
    <link rel="stylesheet" href="css/funware_src/footer.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>펀웨어</title>

    <style type="text/css">
      :root{
        --mainColor: #1a72ec;
        --width: 1280px;
        --gray0: #f8f9fa;
        --gray1: #f1f3f5;
        --gray2: #e9ecef;
        --gray3: #dee2e6;
      }

      /* 배경, 뉴모피즘 테스트 */
      body{
        background: var(--gray1);
      }

      /* 추가_재영 */

      *{font-family: 'Spoqa Han Sans Neo', 'sans-serif';}
      li {list-style: none;}
      a {text-decoration: none;}

      #wrap-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
      }

      #testWrapper{
        opacity:0;
      }

      #carousel-container{
        position: relative;
        max-width: var(--width);
        transform:scale(0.95);
        height: 455px;
        margin: 0 auto;
        /* 추가_재영 */
        border-radius:10px;
        margin-top: 30px;
        overflow:hidden;
        background: var(--gray1);
        box-shadow:  14px 14px 15px #caccce,
                    -14px -14px 15px #ffffff;
      }
      #slider{
        height:auto;
        background-color: red;
        margin:0;
        padding:0;
      }
      .slider_item{
        display: table;
        width: var(--width);
        float:left;
      }
      #indicateBox{
        margin:0;
        padding:0;
        position: absolute;
        z-index: 1;
        opacity: .99;
        background-color: rgba(0, 0, 0, 0.7);
        height: 100%;
        width: 33%;
        right: 0px;
        color: white;
        border-radius: 0 10px 10px 0;
      }
      #indicate_contents{
        position: absolute;
        left: 50px;
        top: 134px;
        display: flex;
        flex-direction: column;
      }
      #slide_title{
        display: flex;
        position: relative;
      }
      .explain_item{display: none; font-size: 1.25rem; font-weight: bold;}
      .title_item{display: none; font-size: 2.188rem; font-weight: bold;}

      #indicate_showing_title{display: block;}
      #indicate_showing_explan{display: block;}
      #btnGroup{
        position: absolute;
        left: 50px;
        top: 350px;
      }
      .c_btn{
        z-index: 1;
        border: solid 1px #fff;
        border-radius: 70%;
        margin-right: 10px;
        cursor: pointer;
      }

      .currentSlideNum{
        position:relative;
        bottom:0px;
        opacity: 0.7;
        background-color: black;
        font-size:0.75rem;
        padding:3px 10px 3px 10px;
        border-radius: 13px;
        color:white;
      }

      #main-container{
        width: var(--width);
        margin: 0 auto;
        margin-bottom: 200px;
      }

      .containers{
        display: flex;
        justify-content: center;
        align-items: center;
      }

      @media (max-width: 1300px) {
        #wrap-contents{
          width:1000px;
          margin: 0 auto;
        }
      }

      .main-content{
        margin-top: 80px;
      }

      #ourActivites{
        margin-bottom: 90px;
      }

      .main-titles{
        font-size: 2.125rem;
        font-weight: 500;
        margin-left:25px;
        color: #464646;
        margin-bottom : 0;
      }

      .main-subTitles{
        font-size: 1.25rem;
        margin-left:25px;
        letter-spacing: 1px;
        color: #575757;
      }

      .mainCards{max-width: var(--width);}

      #categoryTab{
        display: flex;
        justify-content: space-between;
        /* align-content: center; */
      }

      /* 탭메뉴 */
      ul.tabs {
        margin: 0 25px 0 0;
        list-style: none;
      }
      ul.tabs li {
        float: left;
        text-align:center;
        cursor: pointer;
        padding:5px;
        position: relative;
        font-size: 1.125rem;
        letter-spacing: -1.35px;
        color: #717171;
      }
      ul.tabs li .noneTab{
        pointer-events: none;
        cursor: none;
      }

      ul.tabs li.active {
        /* background: #FFFFFF; */
        /* border-bottom: 1px solid #FFFFFF; */
      }
      .tab_container {
        clear: both;
        /* float: left; */
        width: 100%;
      }
      .tab_content {
        display: none;
      }
      .tab_container .tab_content ul {
        width:100%;
        margin:0 auto;
        /* margin:0px; */
        padding:0px;
      }
      .tab_container .tab_content ul li {
        padding:5px;
        list-style:none
      }

      /* 더보기 버튼 */
      .btnBox{width: 100%; display: flex; justify-content: center;}
      .moreBtn{
        width: 462px;
        height: 44px;
        /* margin-top: 80px; */
        border-radius: 10px;
        border:0;
        background-image: linear-gradient(95deg, #e8ebf2, #f2f3f7);
        box-shadow: 20px 20px 30px 0 rgba(15, 41, 107, 0.12);
        font-size: 1.125rem;
        font-weight: 500;
        letter-spacing: -1.08px;
        color: #a1a2a3;
        text-align: center;
        transition: 0.5s ease;
      }
      .moreBtn:hover{
        background: var(--gray2);
        transition: 0.5s ease;
      }

      .btnCtg{
        width: 462px;
        height: 44px;
        margin: 0 auto;
        /* margin-top: 80px; */
        border-radius: 6px;
        border:0;
        background: var(--gray1);
        box-shadow:  14px 14px 15px #caccce,
                    -14px -14px 15px #ffffff;
        color: #a1a2a3;
        text-align: center;
        transition: 0.5s ease;
      }
      .btnCtg:hover{
        background: var(--gray2);
        transition: 0.5s ease;
      }

      #funwareBanner{
        width: var(--width);
        height: 172px;
        background-image: url('img/banner_index.png');
        border-radius: 4px;
        padding: 50px 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      #b_left{
        width: 50%;
        height: 100%;
        color: #fff;
      }
      #b_left p{
        font-size: 1.625rem;
        font-weight: bold;
        letter-spacing: -1.95px;
        margin-bottom: 6px;
      }
      #b_left span{font-size: 1.25rem; letter-spacing: -0.6px;}
      #b_right{
        width: 252px;
        height: 56px;
        background-color: #8db9f5;
        border: none;
        border-radius: 2px;
        font-size: 1.25rem;
        letter-spacing: -0.6px;
        color: #fff;
      }

      #notice-cards{
        width: 100%;
        height:auto;
        border-radius: 10px;
        box-shadow: 20px 20px 30px 0 rgba(15, 41, 107, 0.12);
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
        padding: 20px;
        display: grid;
        row-gap: 40px;
        column-gap: 190px;
        grid-template-columns: repeat(2, minmax(320px, auto));
        /* align-items: center;  */
      }
      .notice_box{
        /* background-color: LemonChiffon; */
        width: 526px;
        height: 100px;
        /* margin: 10px; */
        float:left;
        display: flex;
        align-items: center;
      }
      .noticeLeft{
        width: 150px;
        height: 99px;
      }
      .noticeLeft img{
        width: 100%;
        height: 100%;
        border-radius: 5px;
      }
      .noticeRight{
        width: 389px;
        height: 99px;
        margin-left: 12px;
      }
      

      .noticeInfo{
        width: 100%;
        height: 44px;
        font-size: 0.75rem;
        letter-spacing: -0.12px;
        color: #9f9f9f;
        display: flex;
        justify-content: space-between;
      }

      .noticw_ne{
        font-weight: 500;
        letter-spacing: -0.36px;
        color: #575757;
      }

      /* .noticeTitle{line-height: 94px;} */
      .noticeTitle p{
        /* vertical-align: middle; */
        font-size: 1.125rem;
        font-weight: 500;
        letter-spacing: -1.17px;
        color: #464646;
      }

      #btnTop{
        width: 40px;
        height:40px;
        position: fixed;
        right: 2%;
        bottom:100px;
        border:0px;
        cursor: pointer;
        border-radius: 50%;
        background: white;
        box-shadow:  3px 3px 5px var(--gray2);
      }

      #investment-risk-notice_bg{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 2;
      }
      #investment-risk-notice{
        position: absolute;
        left: calc(50% - 350px);
        /* bottom: calc(50% - 742px); */
        top: 100px;
        width: 700px;
        height: 600px;
        background: #fff;
        padding: 30px;
        z-index: 2;
      }
      #investment-risk-notice_top{display: flex;justify-content: space-between;}
      #rist_detail{
        margin-top: 10px;
        height: 490px;
        overflow-y: auto;
      }
      .carousels > img{
        width:100%;
      }

      .carousels{
        width:var(--width);
        height:455px;
        border-radius:10px;
        display:flex;
        justify-content:center;
        align-items:center;
        cursor:pointer;
      }

      .loginExpose{
        margin-top: 7px;
      }

      #topMenu{
        position:fixed;
        top:-200px;
        width:100%;
        z-index:-1;
        /* display:none; */
      }
      #topMenu ul{
        margin:0;
        padding:0;
      }
      .topMenuItems{
        width:100%;
        height:30px;
        display:flex;
        justify-content:center;
        align-items:center;
        background-color:var(--gray2);
      }
      .topMenuItems:nth-child(2n){
        background-color:var(--gray3);
      }
      #goNotice{
        color: #464646;
      }}
    </style>
    <link rel="stylesheet" href="css/jun_media/index_tablet.css">

  </head>
  <body>
    <div id="wrap-container">
      <!-- Navbar -->
      <div id="more-nav-container">
        <div id="nav-container">
          <!-- NavBar -->
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div id="leftBox">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <button class="nav-btnProject" onclick = "location.href='index.php'">프로젝트 둘러보기</button>
                      <button class="nav-btnProject" onclick = "location.href='newProject.php'">프로젝트 만들기</button>
                    </li>
                  </ul>
                </div>
                <div id="burgerMenu">
                  <div class="plate plate4" onclick="this.classList.toggle('active')">
                    <svg class="burger" version="1.1" height="100" width="100" viewBox="0 0 100 100">
                      <path class="line line1" d="M 50,35 H 30" />
                      <path class="line line2" d="M 50,35 H 70" />
                      <path class="line line3" d="M 50,50 H 30" />
                      <path class="line line4" d="M 50,50 H 70" />
                      <path class="line line5" d="M 50,65 H 30" />
                      <path class="line line6" d="M 50,65 H 70" />
                    </svg>
                    <svg class="x" version="1.1" height="100" width="100" viewBox="0 0 100 100">
                      <path class="line" d="M 34,32 L 66,68" />
                      <path class="line" d="M 66,32 L 34,68" />
                    </svg>
                  </div>
                </div>
                <div id="logo">
                    <a class="nav-brand" href="index.php"><b>FunWare</b></a>
                </div>
                  <div id="rightBox">
                  <form action="search.php" method="get" class="d-flex">
                    <input type="text" name="searchText" id="searchInput" class="hideInput">
                    <button class="btn-search-submit" type="button"><img src="img/search.png"></button>
                  </form>
                  <?php
                    if($user_login && isset($_SESSION["userId"])){
                  ?>
                    <button class="nav-btnMember" onclick="location.href='myPage.php'">
                        <img class="profileImg" src="<?=$row_user["f_profile"]?>">
                        <?php 
                        if(mb_strlen($row_user["f_user_name"]) > 5)
                          echo mb_substr($row_user["f_user_name"],0, 5,"utf-8")."...";
                        else
                          echo $row_user["f_user_name"];
                        ?>님
                    </button>
                    <button class="nav-btnMember" onclick="location.href='logout.php'">로그아웃</button>
                  <?php
                    }else{
                  ?>
                    <button class="nav-btnMember" onclick="location.href='login.php'">로그인</button>
                    <button class="nav-btnMember" onclick="location.href='join.php'">회원가입</button>
                  <?php
                    }
                    ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#696969;">더보기</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="notice.php">공지사항</a></li>
                      <li><a class="dropdown-item" href="landing.php">About Funware</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="helpCenter.html">Help Center</a></li>
                      <li><a class="dropdown-item" href="admin/index.php?uid=<?=$_SESSION['userId']?>">Admin Console</a></li>
                    </ul>
                  </li>
                </div>
               
              </div>
            </div>
          </nav>
        </div>
        <?php 
            if($user_login && isset($_SESSION["userId"])){
              ?>
            <div id="topMenu">
              <ul>
                  <a class='topMenuItems' href='index.php'><li><?=$row_user["f_user_name"]?>님,&nbsp; 어서오세요 :)</li></a>
                  <a class="topMenuItems" href="index.php"><li>프로젝트 둘러보기</li></a>
                  <a class="topMenuItems" href="newProject.php"><li>프로젝트 만들기</li></a>
                  <a class="topMenuItems isLoggedOut" href="logout.php"><li>로그아웃</li></a>
                  <a class="topMenuItems" href="notice.php"><li>공지사항</li></a>
                  <a class="topMenuItems" href="helpCenter.html"><li>헬프센터</li></a>
              </ul>
            </div>
            <?php
            }else{
            ?>
            <div id="topMenu">
              <ul>
                  <a class="topMenuItems" href="index.php"><li>프로젝트 둘러보기</li></a>
                  <a class="topMenuItems isLoggedIn" href="login.php"><li>로그인</li></a>
                  <a class="topMenuItems isLoggedIn" href="join.php"><li>회원가입</li></a>
                  <a class="topMenuItems" href="notice.php"><li>공지사항</li></a>
                  <a class="topMenuItems" href="helpCenter.html"><li>헬프센터</li></a>
              </ul>
            </div>
            <?php
            }
            ?>
      </div>
      
      <div id="testWrapper">
      <!-- carousel -->
      <div id="carousel-container">
        <div id="slider">
          <div id="carousel1" class="slider_item carousels">
            <img src="img/SLIDER1.png" alt="Battlefront II">
          </div>
          <div id="carousel2" class="slider_item carousels">
          <img src="img/SLIDER2.png" alt="Dead By Deadlight">
          </div>
          <div id="carousel3" class="slider_item carousels">
          <img src="img/SLIDER3.png" alt="Apex legend">
          </div>
          <div id="carousel4" class="slider_item carousels">
          <img src="img/SLIDER4.png" alt="The division 2">
          </div>
          <div id="carousel5" class="slider_item carousels">
          <img src="img/SLIDER5_2.png" alt="Battlefield V">
          </div>
        </div>
        <div id="indicateBox">
          <div id="indicate_contents">
            <div id="slide_title">
              <p class="title_item">Star Wars™</br>Battlefront II</p>
              <p class="title_item">Dead By Deadlight</p>
              <p class="title_item">Apex Legend</p>
              <p class="title_item">The Division 2</p>
              <p class="title_item">Battlefield V</p>
            </div>
            <div id="slide_explan">
              <p class="explain_item">Travel through space and</br>Be a Jedi</p>
              <p class="explain_item">Let's be cruel together</br>A new killer is here</p>
              <p class="explain_item">Will you ever be a legend?</p>
              <p class="explain_item">Save the collapsed</br>Washington, D.C</p>
              <p class="explain_item">Jump into the middle of</br>World War II</p>
            </div>
          </div>
          <div id="btnGroup">
            <img src="img/prev.png" id="c_btn1" class="c_btn">
            <img src="img/next.png" id="c_btn2" class="c_btn">
            <span class="currentSlideNum">a / b</span>
          </div>
        </div>
      </div>


      <!-- main -->
      <div id="main-container" class="containers">
        <div id="jun_main">
          <div id="newProject" class="main-content">
            <div class="new-title">
              <p class="main-titles">신규 프로젝트👀</p>
              <p class="main-subTitles">최근에 나온 프로젝트를 만나보세요</p>
            </div>
            <div id="new-cards-box" class="mainCards pListBox">
            <?php
             $q1= $db->query('SELECT ai_project_id ,
                                     f_project_name ,
                                     f_thumbnail ,
                                     SUM(f_spon + f_invest) AS f_donate ,
                                     TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS achieveRate,
                                     f_etp_name ,
                                     DATEDIFF(f_date_limit,CURDATE()) AS f_daysleft
                              FROM funware_project
                              LEFT JOIN funware_img ON funware_project.ai_project_id = funware_img.sys_project_id
                              LEFT JOIN funware_enterprise ON funware_project.ai_project_id = funware_enterprise.sys_project_id
                              LEFT JOIN funware_payment ON funware_payment.sys_project_id = funware_project.ai_project_id
                              WHERE funware_project.f_div = "Y" AND  DATEDIFF(f_date_limit,CURDATE()) > 0
                              GROUP BY ai_project_id
                              ORDER BY auto_date DESC LIMIT 20'
              );
              echo '<div class ="oh_box">';
              echo'<span id="movieList_slideLeft_new" class="material-icons md-18 prev">arrow_back_ios</span>';
              echo '<div id="new-cards" class="cards">';
              while($row = $q1->fetch(PDO::FETCH_ASSOC)){
                // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                // ($percent == "") ? $percent=0 : "";
                if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                if(!$row["achieveRate"]) $row["achieveRate"] = "0";
                $projectSize = strlen($row["f_project_name"]);
                $etpSize = strlen($row["f_etp_name"]);
                $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                echo '<div class="wrapNewCard">';
                  echo '<div class="cards_contents">';
                    echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                      echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                      echo '<div class="p_infoBox">';
                        echo '<div class="enp_name">', $etpName, '</div>';
                          echo '<div class="p_nameRateBox p_tip">';
                            echo '<div class="p_name">', $projectName, '</div>';
                            echo '<div class="d_rate">', $row["achieveRate"], '%</div>';
                            echo '<span>' , $row["f_project_name"] ,'</sapn>';
                          echo '</div>';
                        echo '</div>';
                      echo '</div></a>';
                    echo '</div>';
                }
                echo '</div>';
                echo '<span id="movieList_slideRight_new" class="material-icons md-18 next">arrow_forward_ios</span>';
                echo '</div>';
                // }
              ?>
              <div class="btnBox">
                <button id="btnNew" class="moreBtn nonMobilemoreBtn" type="button">신규 프로젝트 더보기</button>
              </div>
            </div>
          </div>
          <div id="recommendProject" class="main-content">
            <div class="recommend-title">
              <p class="main-titles">추천 프로젝트🔥</p>
              <p class="main-subTitles">엄선된 스타트업을 만나보세요</p>
            </div>
            <div id="recommend-cards-box" class="mainCards pListBox">
              <?php
               $q2= $db->query('SELECT ai_project_id
                                        ,f_project_name
                                        ,f_thumbnail
                                        ,SUM(f_spon + f_invest)
                                        ,TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS f_per
                                        ,DATEDIFF(f_date_limit,CURDATE()) AS f_daysleft
                                        ,f_etp_name
                                FROM funware_project
                                        LEFT JOIN funware_img
                                                ON funware_project.ai_project_id = funware_img.sys_project_id
                                        LEFT JOIN funware_enterprise
                                                ON funware_project.ai_project_id = funware_enterprise.sys_project_id
                                        LEFT JOIN funware_payment
                                                ON funware_payment.sys_project_id = funware_project.ai_project_id
                                WHERE funware_project.f_div = "Y" AND DATEDIFF(f_date_limit,CURDATE()) > 0
                                GROUP BY ai_project_id
                                ORDER BY f_per DESC LIMIT 20'
                );
                echo '<div class ="oh_box">';
                echo'<span id="movieList_slideLeft_recom" class="material-icons md-18 prev">arrow_back_ios</span>';
                echo '<div id="recommend-cards" class="cards">';
                while($row = $q2->fetch(PDO::FETCH_ASSOC)){
                  // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                  // ($percent == "") ? $percent=0 : "";
                  if(!$row["f_per"]) $row["f_per"] = "0";
                  if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                  $projectSize = strlen($row["f_project_name"]);
                  $etpSize = strlen($row["f_etp_name"]);
                  $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                  $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                  echo '<div class="wrapRecomCard">';
                    echo '<div class="cards_contents">';
                      echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                        echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                        echo '<div class="p_infoBox">';
                          echo '<div class="enp_name">', $etpName, '</div>';
                            echo '<div class="p_nameRateBox p_tip">';
                              echo '<div class="p_name">', $projectName, '</div>';
                              echo '<div class="d_rate">', $row["f_per"], '%</div>';
                              echo '<span>' , $row["f_project_name"] ,'</sapn>';
                            echo '</div>';
                          echo '</div>';
                        echo '</div></a>';
                      echo '</div>';
                  }
                  echo '</div>';
                  echo '<span id="movieList_slideRight_recom" class="material-icons md-18 next">arrow_forward_ios</span>';
                  echo '</div>';
                  // }

              ?>
              <div class="btnBox">
                <button id="btnRecom" class="moreBtn nonMobilemoreBtn" type="button"> 추천 프로젝트 더보기</button>
              </div>
            </div>
          </div>
          <!-- 비효율 뭐야 -->
          <div id="categoryProject" class="main-content">
            <div class="category-title">
              <p class="main-titles">프로젝트 골라보기</p>
            </div>
            <div id="categoryTab">
              <p class="main-subTitles">카테고리별 프로젝트를 한 눈에 봐요</p>
              <ul class="tabs">
                  <?php                                  
                   $q4= $db->query('SELECT * FROM funware_category WHERE f_div="Y"');
                  
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<li class="active" rel="tab'.$row["ai_category"].'">'.$row["f_category_name"].'</li> <li style="pointer-events:none;">l</li>';
                                  }
                  ?>
              </ul>
             
            </div>
             <?php
              $categoryQuery = 'SELECT j_link.sys_project_id AS ai_project_id
                                    ,j_link.sys_category_id AS sys_category_id
                                    ,j_category.f_category_name
                                    ,j_project_Sum.f_project_name AS f_project_name
                                    ,j_project_Sum.f_projectTotal
                                    ,j_project_Sum.f_percent AS f_per
                                   	,j_project_Sum.f_etp_name AS f_etp_name
                                   	,j_project_Sum.f_daysleft
                                   	,j_project_Sum.f_thum AS f_thumbnail


                                FROM funware_pj_category as j_link
                                     Left join funware_category AS j_category
                              		 	 ON j_link.sys_category_id = j_category.ai_category
                                     LEFT JOIN (

                              		           SELECT j_project.ai_project_id
                              							      ,j_project.f_project_name
                              							      ,sum(j_payment.f_spon + j_payment.f_invest) AS f_projectTotal
                              							      ,TRUNCATE((sum(j_payment.f_spon + j_payment.f_invest)/j_project.f_donate_limit)*100,0) AS f_percent
                              							      ,j_etp.f_etp_name AS f_etp_name
                              							      ,DATEDIFF(f_date_limit,CURDATE()) AS f_daysleft
                              							      ,j_img.f_thumbnail AS f_thum
                              							      ,j_project.f_div
                              							  FROM funware_project AS j_project
                              							     LEFT JOIN funware_payment AS j_payment
                              									 	ON j_project.ai_project_id = j_payment.sys_project_id
                              									 LEFT JOIN funware_enterprise AS j_etp
                              									 	ON j_project.ai_project_id = j_etp.sys_project_id
                              									 LEFT JOIN funware_img AS j_img
                              									 	ON j_project.ai_project_id = j_img.sys_project_id
                              							 		 GROUP BY j_project.ai_project_id,j_project.f_project_name

                              					   ) AS j_project_Sum
                              				   ON j_project_Sum.ai_project_id = j_link.sys_project_id 
                              		WHERE j_project_Sum.f_div = "Y" AND j_project_Sum.f_daysleft > 0  AND j_category.f_div="Y" ';
              ?>
             <div id="category-cards" class="mainCards">
              <div class="tab_container">
                  <div id="tab1" class="tab_content mainCards">
                    <?php
                      $q3= $db->query($categoryQuery.'AND sys_category_id = 1;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_noGenre" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="noGenre_cards" class="cards categoryCards">';
                      while($row = $q3->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapNoGenreCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              // echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_noGenre" class="material-icons md-18 next">arrow_forward_ios</span>';
                        
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnNoGenre' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                        echo '</div>';
                     ?>
                  </div>
                  <div id="tab4" class="tab_content">
                    <?php
                      $q3_2= $db->query($categoryQuery.'AND sys_category_id = 4;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_fighting" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="fighting_cards" class="cards categoryCards">';
                      while($row = $q3_2->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapFightingCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_fighting" class="material-icons md-18 next">arrow_forward_ios</span>';
                        echo '</div>';
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnFighting' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                     ?>
                  </div>
                  <div id="tab5" class="tab_content">
                    <?php
                      $q3_3= $db->query($categoryQuery.'AND sys_category_id = 5;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_shooter" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="shooter_cards" class="cards categoryCards">';
                      while($row = $q3_3->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapShooterCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_shooter" class="material-icons md-18 next">arrow_forward_ios</span>';
                        echo '</div>';
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnShooter' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                     ?>
                  </div>
                  <div id="tab7" class="tab_content">
                    <?php
                      $q3_4= $db->query($categoryQuery.'AND sys_category_id = 7;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_music" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="music_cards" class="cards categoryCards">';
                      while($row = $q3_4->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapMusicCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_music" class="material-icons md-18 next">arrow_forward_ios</span>';
                        echo '</div>';
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnMusic' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                     ?>
                  </div>
                  <div id="tab10" class="tab_content">
                    <?php
                      $q3_5= $db->query($categoryQuery.'AND sys_category_id = 10;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_racing" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="racing_cards" class="cards categoryCards">';
                      while($row = $q3_5->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapRacingCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_racing" class="material-icons md-18 next">arrow_forward_ios</span>';
                        echo '</div>';
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnRacing' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                     ?>
                  </div>
                  <div id="tab12" class="tab_content">
                    <?php
                      $q3_6= $db->query($categoryQuery.'AND sys_category_id = 12;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_rpg" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="rpg_cards" class="cards categoryCards">';
                      while($row = $q3_6->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapRPGCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_rpg" class="material-icons md-18 next">arrow_forward_ios</span>';
                        echo '</div>';

                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnRPG' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                     ?>
                  </div>
                  <div id="tab14" class="tab_content">
                    <?php
                      $q3_7= $db->query($categoryQuery.'AND sys_category_id = 14;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_sport" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="sport_cards" class="cards categoryCards">';
                      while($row = $q3_7->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapSportCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_sport" class="material-icons md-18 next">arrow_forward_ios</span>';
                        echo '</div>';
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnSport' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                     ?>
                  </div>
                  <div id="tab33" class="tab_content">
                    <?php
                      $q3_8= $db->query($categoryQuery.'AND sys_category_id = 33;');
                      $row_num = 0;
                      echo '<div class ="oh_box">';
                      // echo'<span id="movieList_slideLeft_arcade" class="material-icons md-18 prev">arrow_back_ios</span>';
                      echo '<div id="arcade_cards" class="cards categoryCards">';
                      while($row = $q3_8->fetch(PDO::FETCH_ASSOC)){
                        // $percent = isset($row['achieveRate']) ? $_row['achieveRate']: 0;
                        // ($percent == "") ? $percent=0 : "";
                        $row_num++;
                        if(!$row["f_thumbnail"]) $row["f_thumbnail"] = "img/defaultThumbnail.png";
                        if(!$row["f_per"]) $row["f_per"] = "0";
                        $projectSize = strlen($row["f_project_name"]);
                        $etpSize = strlen($row["f_etp_name"]);
                        $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                        $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                        echo '<div class="wrapArcadeCard">';
                          echo '<div class="cards_contents">';
                            echo '<a href="projectDetail.php?p_num='.$row["ai_project_id"].'">';
                              echo '<div class="p_thumnail"><img src="'.$row["f_thumbnail"].'"></div>';
                              echo '<div class="p_infoBox">';
                                echo '<div class="enp_name">', $etpName, '</div>';
                                  echo '<div class="p_nameRateBox p_tip">';
                                    echo '<div class="p_name">', $projectName, '</div>';
                                    echo '<div class="d_rate">', $row["f_per"], '%</div>';
                                    echo '<span>' , $row["f_project_name"] ,'</sapn>';
                                  echo '</div>';
                                echo '</div>';
                              echo '</div></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        // echo '<span id="movieList_slideRight_arcade" class="material-icons md-18 next">arrow_forward_ios</span>';
                       
                        
                        if($row_num >= 12){
                          echo "<div class='btnBox'>";
                          echo    "<button id='btnArcade' class='moreBtn' type='button'>더보기</button>";
                          echo "</div>";
                        }
                        echo '</div>';
                     ?>
                     
                  </div>
              </div>
            </div>
          </div>

          <div id="funwareBanner" class="main-content">
            <div id="b_left">
              <p>신뢰할 수 있는 크라우드펀딩, FunWare</p>
              <span>꼼꼼한 스크리닝으로 믿을 수 있는 플랫폼을 만듭니다. </span>
            </div>
            <button id="b_right" onClick="location.href='landing.php'">자세히 알아보기</button>
          </div>

          <div id="notice" class="main-content">
            <div class="recommend-title">
              <p class="main-titles"><a id="goNotice" href="notice.php">공지사항</a></p>
              <p class="main-subTitles">새로운 소식을 전달해 드립니다</p>
            </div>
            <div id="notice-cards" class="mainCards">
              <?php
                $q4= $db->query('SELECT ai_notice,
                                        f_notice_title,
                                        f_ne,
                                        f_div,
                                        f_notice_img,
                                        f_date
                                FROM funware_notice 
                                WHERE f_div = "Y"
                                ORDER BY funware_notice.f_date DESC LIMIT 6'
                 );
                 while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                   $f_ne = ($row["f_ne"] == 'N') ? '공지' : '이벤트';
                   $row["f_notice_img"] = ($row["f_notice_img"] != NULL) ? '<img src="'.$row["f_notice_img"].'">' : '';

                   echo '<div class="notice_box">';
                     echo '<div class="noticeLeft">',$row["f_notice_img"],'</div>';
                     echo '<div class="noticeRight">';
                       echo '<div class="noticeInfo">';
                         echo '<div><span class="noticw_ne">', $f_ne.'</span>&nbsp;&nbsp;| ', $row["f_notice_title"], '</div>';
                         echo '<span>'.substr($row["f_date"],0, 10).'</span>';
                       echo '</div>';
                       echo '<a href="noticeDetail.php?n_num='.$row["ai_notice"].'">';
                       echo '<div class="noticeTitle"><p>', $row["f_notice_title"], '</p></div></a>';
                     echo '</div>';
                   echo '</div>';
                 }
               ?>
            </div>
            
            <div id="mobile_notice-cards">
              <?php
              $q_mobileNotice= $db->query('SELECT ai_notice,
                                        f_notice_title,
                                        f_ne,
                                        f_div,
                                        f_notice_img,
                                        f_date
                                FROM funware_notice 
                                WHERE f_div = "Y"
                                ORDER BY funware_notice.f_date DESC LIMIT 6');
              while($row = $q_mobileNotice->fetch(PDO::FETCH_ASSOC)){
                $row["f_notice_img"] = ($row["f_notice_img"] != NULL) ? $row["f_notice_img"] : '';
                $row["f_ne"] = ($row["f_ne"] == "N") ? "이벤트" : "공지";
                $smallTitle = (mb_strlen($row["f_notice_title"], 'utf-8') > 17) ? mb_substr($row["f_notice_title"],0, 23, 'utf-8').'...' : $row["f_notice_title"];
              ?>
              <a href="noticeDetail.php?n_num=<?=$row["ai_notice"]?>">
                <div class="mobile_notice_box">
                  <img src="<?=$row["f_notice_img"]?>" class="mobile_notice_img">
                  <div class="mobile_notice_ne"><?=$row["f_ne"]?></div>
                  <div class="mobile_notice_smallTitle">&nbsp;&nbsp;|&nbsp;&nbsp;<?=$smallTitle?></div>
                  <div class="mobile_notice_bigTitle"><?=$row["f_notice_title"]?></div>
                  <div class="mobile_notice_regTime"><?=substr($row["f_date"],0, 10)?></div>
                </div>
              </a>
              <?php
                }
              ?>
            </div>

          </div>

        </div>
      </div>
      <!-- footer -->
      <div id="footer-container" class="containers">
        <div class="footer-contents">
          <div>
            <br>
            <p class="mainColor footer_logo"><b>FunWare</b></p>
            <p class="mainColor footer_leg">®FunWare. INC</p>
          </div><br><br>
          <div class="footer-contentBox">
            <div class="risk-notice">
              <p class="mainColor"><b>투자위험고지</b></p>
              <p><small>스타트업 투자는원금 손실과 유동성 및 현금성에 대한 투자위험을 가지고 있습니다.<br>투자 전에 투자위험고지를 꼭 확인해주세요. <a id="risk-a"href="#">투자위험고지 바로가기 ></a></small></p>
              <p><small>㈜FunWare는 중개업(온라인고액투자중개 및 통신판매중개)을 영위하는 플랫폼 제공자로 자금을 모집하는<br>당사자가 아닙니다. 따라서 투자손실의 위험을 보전하거나 리워드 제공을 보장해 드리지 않으며 이에 대한 법적인<br>책임을 지지 않습니다.</small></p>
              <p><small><br>경기도 성남시 수정구 대왕판교로 815 기업지원허브 1004호   |   리워드   031-0000-0000  |   투자  010-0000-0000,    031-0000-0000</small></p>
              <p><small><br>통신판매업신고 : 2021-성남 꿀벌-0000  |  사업자등록번호 : 000 - 00 - 00001  |  대표자  :  이재영,  꿀벌<br>벤처인증기업 : 제 20210000001호</small></p>
            </div>
            <div class="about-us">
              <ul>
                <li><b>ABOUT US</b></li><br>
                <li>Project-Manager 이재영</li>
                <li>Front-end 김민솔</li>
                <li>Back-end 오준석</li>
                <li>Design 이대희</li>
              </ul>
            </div>
            <div class="help">
              <ul>
                <li><b>HELP</b></li><br>
                <li><a href="helpCenter.html?num=0">도움말</a></li>
                <li><a href="helpCenter.html?num=1">회원가입 기본약관</a></li>
                <li><a href="helpCenter.html?num=2">FUNWARE 리워드 이용약관</a></li>
                <li><a href="helpCenter.html?num=3">FUNWARE 투자 이용약관</a></li>
                <li><a href="helpCenter.html?num=4">개인정보 처리방침(리워드)</a></li>
                <li><a href="helpCenter.html?num=5">개인정보 처리방침(투자)</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- move top button -->
      <img src="img/topArrow.png" id="btnTop">

      <!-- footer__investment risk notice__popup -->
      <div id="investment-risk-notice_bg">
        <div id="investment-risk-notice">
          <div id="investment-risk-notice_top">
            <h3>투자위험고지</h3>
            <img id="exitNotice" src="img/exit.png" style="cursor: pointer;">
          </div>
          <div id="rist_detail">
            <ul>
              <br><li>귀하는 본 금융투자상품이 자본시장법에 따른 “증권”에 해당되므로 원본손실 위험성이 있다는 것을 확인합니다. 따라서 투자한 자금의 원본손실의 위험이 있으며, 발행인이 제시한 예상 수익과, 귀하가 예상하는 수익이나 기대하는 수익의 일부 또는 전부를 얻지 못할 수 있음을 확인합니다.</li>
              <br><li>귀하는 (주)꿀벌이 자본시장법에 따른 “온라인소액투자중개업자”의 지위에서 온라인소액증권 발행인과 온라인소액투자 중개계약을 체결하여 위 발행인이 발행하는 증권에 대한 청약 거래를 중개 역할만 하므로, 직접 증권을 발행하거나 주금을 납입 받지 않는다는 것을 알고 있습니다.</li>
              <br><li>귀하는 (주)꿀벌이 자본시장법에 따른 “온라인소액투자중개업자”의 지위에서 온라인소액증권 발행인과 온라인소액투자 중개계약을 체결하여 위 발행인이 발행하는 증권에 대한 청약 거래를 중개 역할만 하므로, 직접 증권을 발행하거나 주금을 납입 받지 않는다는 것을 알고 있습니다.</li>
              <br><li>귀하는 (주)꿀벌은 온라인소액중개 플랫폼으로써 크라우드펀딩으로 자금을 모집하는 단순 중개자로서의 역할만 수행하므로 투자손실의 위험을 보전하는 당사자가 아님을 확인합니다. 투자에 대한 모든 위험은 투자자 본인에게 있음을 확인합니다.</li>
              <br><li>귀하는 금번에 발행되는 비상장 증권의 발행이 한국거래소의 상장을 목적으로 하는 것이 아니며, 따라서 증권의 환금성에 큰 제약이 있다는 점과 예상 회수금액에 대한 일부 혹은 전부를 회수할 수 없는 위험이 있음을 이해하며, 귀하가 이를 감당할 수 있음을 확인합니다.</li>
              <br><li>발행인이 증권의 발행조건과 관련하여 상환조건, 전환조건을 설정하거나, 이해관계자에 대해 특정한 조건을 설정한 경우 이에 대한 구체적인 내용을 홈페이지 혹은 IR보고서에서 확인해야 함을 인지하고 있습니다.</li>
              <br><li>귀하는 “자본시장과 금융투자업에 관한 법률” 제117조의 10 제7항에 따라 발행된 증권이 예외없이 예탁결제원에 예탁 혹은 보호예수 되며 전문투자자에 대한 매도 등 예외적인 경우를 제외하고는 원칙적으로 6개월간 전매가 제한된다는 점을 이해합니다.</li>
              <br><li>귀하는 청약기간 중에는 청약의 철회를 할 수 있으나, 청약기간 종료일 이후에는 청약을 철회할 수 없으며, 모집예정금액의 80% 미달 시 증권발행이 취소되며, 귀하의 청약증거금은 투자예치금 계좌에 복원됩니다.</li>
              <br><li>귀하는 **개인정보보호정책(투자)**을 확인하였으며, 귀하에게 서비스 제공과 원활한 계약사항의 이행을 위해 본 약관에 허용된 범위에 한하여 제3자에게 개인정보가 제공될 수 있음에 동의합니다.</li>
              <br><li>귀하는 **꿀벌  이용약관(투자)**을 확인하였으며, 투자정보의 게재, 청약의 방법, 청약의 주문 및 철회, 모집결과의 게시 및 통보에 관한 사항 등 온라인소액투자 중개 서비스 이용에 대한 약관 내용에 동의합니다. </li>
              <br><li>(주)꿀벌은 온라인소액증권 청약과 관련하여 투자자들에게 별도의 수수료 뚜 이용료 등)를 징수하지 않습니다. 다만 청약증거금 용도의 자금을 투자예치금 계좌에 이체할 때, 이용하는 은행의 정책에 따라 타행이체의 경우 이체 수수료가 발생할 수 있습니다.</li>
              <br><li>(주)꿀벌은 발행인의 요청에 따라(법적으로 설정 가능한) 청약 시 합리적으로 명확한 기준(선착순, 금액순, 전문투자자순 등)에 따라 투자자의 자격 등을 제한할 수 있으므로 해당 기준과 조건에 따라 청약의 우대 및 차별을 받게 될 수 있음을 인지합니다.</li>
              <br><li>위 사항들은 청약 주문 거래에 수반되는 위험과 제도와 관련하여 귀하가 알아야할 내용 및 사안을 간략하게 서술한 것으로 본 거래와 관련하여 발생될 수 있는 모든 위험과 중요사항이 전부 기술된 것은 아닙니다. 따라서 상세내용은 관계법규 및 (주)꿀벌의 꿀벌 이용약관(투자)와 개인정보보호정책(투자)을 통해 확인하여야 합니다. 또한 본 고지는 청약 주문 거래와 관련된 법규 등에 우선하지 못한다는 점을 양지하여 주시기 바랍니다.</li>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/burger.js"></script>
    <script src="js/channelTalk.js"></script>
    <script src="js/indexLoop.js" defer></script>
    <script>

      $(function () {
        $("#testWrapper").fadeIn(500, function () {
            $(this).animate({
              "opacity": "1"
            },700);
        });

        // console.log($('.prev'));
      });      

        // navbar
        clickToggle = () => {
          $("#searchInput").hasClass('hideInput') ? searchInput.classList.toggle("hideInput") : searchForm.submit();
        }

        $("#searchInput").blur(()=>{
          $("#searchInput").addClass('hideInput');
        });
        let searchInput = document.querySelector("#searchInput");
        let searchBtn = document.querySelector(".btn-search-submit");
        let searchForm = document.querySelector(".d-flex");
        searchBtn.addEventListener("click", clickToggle, false);

        // 캐러셀
        $("#carousel1").click(()=>{
          location.href="projectDetail.php?p_num=14";
        });
        $("#carousel2").click(()=>{
          location.href="projectDetail.php?p_num=83";
        });
        $("#carousel3").click(()=>{
          location.href="projectDetail.php?p_num=95";
        });
        $("#carousel4").click(()=>{
          location.href="projectDetail.php?p_num=29";
        });
        $("#carousel5").click(()=>{
          location.href="projectDetail.php?p_num=28";
        });

        const currentSlideNum = document.querySelector(".currentSlideNum");
        const slider = document.querySelector("#slider");
        const slider_item = document.querySelectorAll(".slider_item");
        const slider_title = document.querySelectorAll(".title_item");
        const slider_explain = document.querySelectorAll(".explain_item");
        const slideLen = slider_item.length;
        var a = document.getElementById("testWrapper");
        var careselWidth = 1280;


        const slideSpeed = 300;
        const startNum = 0;
        let curIndex = 0;
        slider.style.width = careselWidth * (slideLen+2) +"px";
        let firstChild = slider.firstElementChild;
        let lastChild = slider.lastElementChild;
        let clonedFirst = firstChild.cloneNode(true);
        let clonedLast = lastChild.cloneNode(true);
        slider.appendChild(clonedFirst);
        slider.insertBefore(clonedLast, slider.firstElementChild);
        slider.style.transform = "translate3d(-" + (careselWidth * (startNum + 1)) +"px, 0px, 0px)";
        currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
        const prevBtn = document.querySelector("#c_btn1");
        const nextBtn = document.querySelector("#c_btn2");

        const mCaresel = window.matchMedia('(max-width: 375px)');

        var fff = window.matchMedia('(max-width: 765px)');


        $(document).ready(function(){
          console.log('ready?');
          if (window.matchMedia('(max-width: 375px)').matches) {   
            careselWidth = 375;  

            if(curIndex <= slideLen -1){
                  slider.style.transition = `${slideSpeed}ms`;
                  slider.style.transform = `translate3d(-375px, 0px, 0px)`;
                }
                if(curIndex === slideLen -1){
                  setTimeout(()=>{
                    slider.style.transition = "0ms";
                    slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
                  }, slideSpeed)
                  curIndex = -1;
                }
          }else if(window.matchMedia('(max-width: 768px)').matches){
              careselWidth = 718;
              if(curIndex <= slideLen -1){
                  slider.style.transition = `${slideSpeed}ms`;
                  slider.style.transform = `translate3d(-718px, 0px, 0px)`;
                }
                if(curIndex === slideLen -1){
                  setTimeout(()=>{
                    slider.style.transition = "0ms";
                    slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
                  }, slideSpeed)
                  curIndex = -1;
                }
            
          }else{
            careselWidth =1280;
          }
        });

        function handleMobileCaresel(e) {   
          // Check if the media query is true
          console.log('offset'+a.clientWidth);
          if (e.matches) {   
            careselWidth = 375;  
            console.log('Caresel Query Matched!' + careselWidth) ;
          }else if(fff.matches){
            
            careselWidth = 718;
            console.log('Caresel 7237232732 Matched!' + careselWidth) ;
          }
          else{
            careselWidth =1280;
          }
        } 

        mCaresel.addListener(handleMobileCaresel)
        

        // 코드 정리
        let setSliderTextStyle = (title, explain, action) => {
            title.style.display = `${action}`;
            explain.style.display = `${action}`;
        }
        setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
        nextBtn.addEventListener('click', () => {
          if(curIndex <= slideLen -1){
            console.log(careselWidth);
            setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
            slider.style.transition = `${slideSpeed}ms`;
            slider.style.transform = `translate3d(-${(careselWidth * (curIndex+2))}px, 0px, 0px)`;
          }
          if(curIndex === slideLen -1){
            setTimeout(()=>{
              slider.style.transition = "0ms";
              slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
            }, slideSpeed)
            curIndex = -1;
          }
          ++curIndex;
          currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
          setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
        });
        prevBtn.addEventListener('click', () => {
          if(curIndex >= 0){
            setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
            slider.style.transition = `${slideSpeed}ms`;
            slider.style.transform = `translate3d(-${(careselWidth * curIndex)}px, 0px, 0px)`;
          }
          if(curIndex === 0){
            setTimeout(()=>{
              slider.style.transition = "0ms";
              slider.style.transform = `translate3d(-${(careselWidth * slideLen)}px, 0px, 0px)`;
            }, slideSpeed)
            curIndex = slideLen;
          }
          --curIndex;
          currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
          setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
        });
        // 자동 슬라이드 :3초
          let initList = setInterval(()=>{
          if(curIndex <= slideLen -1){
            setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
            slider.style.transition = `${slideSpeed}ms`;
            slider.style.transform = `translate3d(-${(careselWidth * (curIndex+2))}px, 0px, 0px)`;
          }
          if(curIndex === slideLen -1){
            setTimeout(()=>{
              slider.style.transition = "0ms";
              slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
            }, slideSpeed)
            curIndex = -1;
          }
          ++curIndex;
          currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
          setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
          },5000);
          $('#carousel-container').mouseover(function(){
            clearInterval(initList);
          }).mouseout(function(){
            initList = setInterval(()=>{
                  if(curIndex <= slideLen -1){
                    setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
                    slider.style.transition = `${slideSpeed}ms`;
                    slider.style.transform = `translate3d(-${(careselWidth * (curIndex+2))}px, 0px, 0px)`;
                  }
                  if(curIndex === slideLen -1){
                    setTimeout(()=>{
                      slider.style.transition = "0ms";
                      slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
                    }, slideSpeed)
                    curIndex = -1;
                  }
                  ++curIndex;
                  currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
                  setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
                  },5000);
          });

          var mql = window.matchMedia("screen and (max-width: 768px)");
          mql.addListener(function(e) {
            if(e.matches) {
              careselWidth = 718;      
                console.log(careselWidth);          
                if(curIndex <= slideLen -1){
                  setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
                  slider.style.transition = `${slideSpeed}ms`;
                  slider.style.transform = `translate3d(-${(careselWidth * (curIndex+2))}px, 0px, 0px)`;
                }
                if(curIndex === slideLen -1){
                  setTimeout(()=>{
                    slider.style.transition = "0ms";
                    slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
                  }, slideSpeed)
                  curIndex = -1;
                }
                ++curIndex;
                currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
                setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
            } else {
              careselWidth = 1280;                
                if(curIndex <= slideLen -1){
                  setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
                  slider.style.transition = `${slideSpeed}ms`;
                  slider.style.transform = `translate3d(-${(careselWidth * (curIndex+2))}px, 0px, 0px)`;
                }
                if(curIndex === slideLen -1){
                  setTimeout(()=>{
                    slider.style.transition = "0ms";
                    slider.style.transform = `translate3d(-${careselWidth}px, 0px, 0px)`;
                  }, slideSpeed)
                  curIndex = -1;
                }
                ++curIndex;
                currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
                setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
            }
        });

        // 모바일 캐러셀 수정
        var mql1 = window.matchMedia("screen and (max-width: 375px)");
          mql1.addListener(function(e) {
            if(e.matches) {
              careselWidth = 375;
              console.log(careselWidth);
                if(curIndex <= slideLen -1){
                  setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"none");
                  slider.style.transition = `${slideSpeed}ms`;
                  slider.style.transform = `translate3d(-${(375 * (curIndex+2))}px, 0px, 0px)`;
                }
                if(curIndex === slideLen -1){
                  setTimeout(()=>{
                    slider.style.transition = "0ms";
                    slider.style.transform = `translate3d(-375px, 0px, 0px)`;
                  }, slideSpeed)
                  curIndex = -1;
                }
                ++curIndex;
                currentSlideNum.innerHTML = `${curIndex + 1} / ${slideLen}`;
                setSliderTextStyle(slider_title[curIndex],slider_explain[curIndex],"block");
            }
        });      


        
        // 카테고리 모아보기_탭메뉴
        $(function () {
            $(".tab_content").hide();
            $(".tab_content:first").show();
            $("ul.tabs li").click(function () {
                $("ul.tabs li").removeClass("active").css("color", "#717171");
                //$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
                $(this).addClass("active").css("color", "var(--mainColor)");
                $(".tab_content").hide();
                var activeTab = $(this).attr("rel");
                $("#" + activeTab).fadeIn();
            });
        });

        

          // 카드 더보기__반복코드 ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,2차원 배열 써 말아
          let newC = Array.from(document.querySelectorAll('.wrapNewCard'));
          let recomC = Array.from(document.querySelectorAll('.wrapRecomCard'));
          let noGenreCards = Array.from(document.querySelectorAll('.wrapNoGenreCard'));
          let fightingCards = Array.from(document.querySelectorAll('.wrapFightingCard'));
          let shooterCards = Array.from(document.querySelectorAll('.wrapShooterCard'));
          let musicCards = Array.from(document.querySelectorAll('.wrapMusicCard'));
          let racingCards = Array.from(document.querySelectorAll('.wrapRacingCard'));
          let rpgCards = Array.from(document.querySelectorAll('.wrapRPGCard'));
          let sportCards = Array.from(document.querySelectorAll('.wrapSportCard'));
          let arcadeCards = Array.from(document.querySelectorAll('.wrapArcadeCard'));
          
          let showN = 0;
          let showR = 0;
          let showNoGenre = 0;
          let showFighting = 0;
          let showShooter = 0;
          let showMusic = 0;
          let showRacing = 0;
          let showRPG = 0;
          let showSport = 0;
          let showArcade = 0;

          function hideDivs(){
            $(".wrapNewCard").hide();
            $(".wrapRecomCard").hide();
            $(".wrapNoGenreCard").hide();
            $(".wrapFightingCard").hide();
            $(".wrapShooterCard").hide();
            $(".wrapMusicCard").hide();
            $(".wrapRacingCard").hide();
            $(".wrapRPGCard").hide();
            $(".wrapSportCard").hide();
            $(".wrapArcadeCard").hide();
          }
          hideDivs();

          function showDivs(){
            for(let i=showN; i<showN+4; i++){
              $(newC[i]).show();
              $(recomC[i]).show();
            } 
            showN += 4;
            showR += 4;

            for(i=showNoGenre; i<showNoGenre+12; i++){
              $(noGenreCards[i]).show();
              $(fightingCards[i]).show();
              $(shooterCards[i]).show();
              $(musicCards[i]).show();
              $(racingCards[i]).show();
              $(rpgCards[i]).show();
              $(sportCards[i]).show();
              $(arcadeCards[i]).show();
            } 
            showNoGenre += 12;
            showFighting += 12;
            showShooter += 12;
            showMusic += 12;
            showRacing += 12;
            showRPG += 12;
            showSport += 12;
            showArcade += 12;
          }
          showDivs();
          // showDivs(newC, showN);
          // showDivs(recomC, showR);

          $("#btnNew").click(function () {
            for(var i=showN; i<showN+8; i++) $(newC[i]).fadeIn(300);
            showN += 8;
            if(newC.length - showN < 8) $(this).css({"display" : "none"});
          });
          $("#btnRecom").click(function () {
            for(var i=showR; i<showR+8; i++) $(recomC[i]).fadeIn(300);
            showR += 8;
            if(recomC.length - showR < 8) $(this).css({"display" : "none"});
          });
          $("#btnNoGenre").click(function () {
            for(var i=showNoGenre; i<showNoGenre+12; i++) $(noGenreCards[i]).fadeIn(300);
            console.log(showNoGenre);
            console.log(noGenreCards.length);
            if(noGenreCards.length - showNoGenre < 12) $(this).css({"display" : "none"});
            showNoGenre += 12;
          });
          $("#btnFighting").click(function () {
            for(var i=showFighting; i<showFighting+12; i++) $(fightingCards[i]).fadeIn(300);
            
            if(fightingCards.length - showFighting < 12) $(this).css({"display" : "none"});
            showFighting += 12;
          });
          $("#btnShooter").click(function () {
            for(var i=showShooter; i<showShooter+12; i++) $(shooterCards[i]).fadeIn(300);
            
            if(shooterCards.length - showShooter < 12) $(this).css({"display" : "none"});
            showShooter += 12;
          });
          $("#btnMusic").click(function () {
            for(var i=showMusic; i<showMusic+12; i++) $(musicCards[i]).fadeIn(300);
            
            if(musicCards.length - showMusic < 12) $(this).css({"display" : "none"});
            showMusic += 12;
          });
          $("#btnRacing").click(function () {
            for(var i=showRacing; i<showRacing+12; i++) $(racingCards[i]).fadeIn(300);
            
            if(racingCards.length - showRacing < 12) $(this).css({"display" : "none"});
            showRacing += 12;
          });
          $("#btnRPG").click(function () {
            for(var i=showRPG; i<showRPG+12; i++) $(rpgCards[i]).fadeIn(300);
            
            if(rpgCards.length - showRPG < 12) $(this).css({"display" : "none"});
            showRPG += 12;
          });
          $("#btnSport").click(function () {
            for(var i=showSport; i<showSport+12; i++) $(sportCards[i]).fadeIn(300);
            
            if(sportCards.length - showSport < 12) $(this).css({"display" : "none"});
            showSport += 12;
          });
          $("#btnArcade").click(function () {
            for(var i=showArcade; i<showSport+12; i++) $(arcadeCards[i]).fadeIn(300);
            
            if(arcadeCards.length - showArcade < 12) $(this).css({"display" : "none"});
            showArcade += 12;
          });

          if (window.matchMedia("(max-width: 375px)").matches) {
              $(".nonMobilemoreBtn").css({"display" : "none"});
              $(".material-icons").css({"display" : "block", "transition" : "0.5s ease"});
              // 다 보여줘
              $(newC).show();
              $(recomC).show();

              console.log(noGenreCards.length);
          } else {
              $(".nonMobilemoreBtn").css({"display" : "block"});
              $(".material-icons").css({"display" : "none", "transition" : "0.5s ease"});
              // 숨겼다가
              $(newC).hide();
              $(recomC).hide();
              $(noGenreCards).hide();
              $(fightingCards).hide();
              $(shooterCards).hide();
              $(musicCards).hide();
              $(racingCards).hide();
              $(rpgCards).hide();
              $(sportCards).hide();
              $(arcadeCards).hide();
              // 특정 갯수씩 보여줘
              showN = 0;
              showR = 0;
              showNoGenre = 0;
              showFighting = 0;
              showShooter = 0;
              showMusic = 0;
              showRacing = 0;
              showRPG = 0;
              showSport = 0;
              showArcade = 0;
              showDivs();
          }

          $(window).resize(function(){
              if(window.matchMedia("(max-width: 375px)").matches){ 
                  $(".nonMobilemoreBtn").css({"display" : "none"});
                  $(".material-icons").css({"display" : "block", "transition" : "0.5s ease"});
                  // 다 보여줘
                  $(newC).show();
                  $(recomC).show();
              }else{
                $(".nonMobilemoreBtn").css({"display" : "block"});
                $(".material-icons").css({"display" : "none", "transition" : "0.5s ease"});
                // 숨겼다가
                $(newC).hide();
                $(recomC).hide();
                $(noGenreCards).hide();
                $(fightingCards).hide();
                $(shooterCards).hide();
                $(musicCards).hide();
                $(racingCards).hide();
                $(rpgCards).hide();
                $(sportCards).hide();
                $(arcadeCards).hide();
                // 특정 갯수씩 보여줘
                showN = 0;
                showR = 0;
                showNoGenre = 0;
                showFighting = 0;
                showShooter = 0;
                showMusic = 0;
                showRacing = 0;
                showRPG = 0;
                showSport = 0;
                showArcade = 0;
                showDivs();
              }
          });




        // 투자위험고지
        $("#risk-a").click(function(e){
          e.preventDefault();
          let windowY = $(window).scrollTop();
          $('html, body').css({'overflow': 'hidden',
          'top' : windowY+"px"});
          $("#investment-risk-notice_bg").css({
            "display" : "block",
            "top" : windowY+"px"
          });
        });
        $("#exitNotice").click(function(){
          $('html, body').css({'overflow': 'auto'});
          $("#investment-risk-notice_bg").css({"display" : "none"});
        });

        // Move Top Button
        $("#btnTop").click(()=>{
          $( 'html, body' ).animate( { scrollTop : 0 }, 400,"linear");
  	      return false;
        });
        $( '#btnTop' ).hide();
        $( window ).scroll( function() {
          if ( $( this ).scrollTop() > 400 ) {
            $( '#btnTop' ).fadeIn();
          } else {
            $( '#btnTop' ).fadeOut();
          }
        });

    </script>
  </body>
</html>
<?php
  }catch(Exception $e){
  echo $e;
  }
?>
