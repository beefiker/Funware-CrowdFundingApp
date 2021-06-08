<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';
  // echo "<script>alert(".$user_login.");</script>";

  $p_num = $_REQUEST["p_num"];

  $q1= $db->query('SELECT ai_project_id
                            ,sys_register_id
                            ,f_project_name
                            ,COUNT(DISTINCT sys_user_id) AS investNum
                            ,SUM(f_spon + f_invest) AS invested
                            ,TRUNCATE((SUM(f_spon + f_invest)/f_donate_limit)*100,0) AS achieveRate
                            ,DATEDIFF(f_date_limit,CURDATE()) AS f_daysleft
                            ,f_thumbnail_big
                            ,f_storyline_img
                            ,f_gamepv
                    FROM funware_project
                            LEFT JOIN funware_payment
                                    ON funware_payment.sys_project_id = funware_project.ai_project_id
                            LEFT JOIN funware_img
                                    ON funware_project.ai_project_id = funware_img.sys_project_id
                    WHERE funware_project.f_div = "Y" AND ai_project_id = '.$p_num.';'
  );
  $row = $q1->fetch(PDO::FETCH_ASSOC);
  $q1->closeCursor();
 ?>
<!doctype html>
  <head>
    <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <link rel="stylesheet" href="css/funware_src/footer.css">
    <link rel="stylesheet" href="css/funware_src/cards.css">

    <style>
      :root{
        --mainColor: #1a72ec;
        --width: 1280px;
        --gray0: #f8f9fa;
        --gray1: #f1f3f5;
        --gray2: #e9ecef;
        --gray3: #dee2e6;
      }
      body{background-color: #f2f3f7;}
      *{font-family: 'Spoqa Han Sans Neo', 'sans-serif';}
      li {list-style: none;}
      a {text-decoration: none;}

      #wrap-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        margin: 0 auto;
      }
      #detail-container{
        width: 100%;
        margin: 0 auto;
        opacity: 0;
      }

      #wrap_introStock{
        background-color: #fff;
        width: var(--width);
        margin: 0 auto;
        margin-top: 50px;
        border-radius: 10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(111deg, #e8ebf2, #f2f3f7);
      }
      /* #wrap_intro{
        width: var(--width);
        margin: 0 auto;
      } */
      #wrap_stock{
        width: var(--width);
        margin: 0 auto;
      }
      #introduction{
        display: flex;
        width: 100%;
        padding: 20px;
      }
      #intro_left{
        width: 755px;
        height: 436px;
      }
      #intro_right{
        width: 525px;
        height: 436px;
        padding-left: 45px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      #p_name{
        width: 100%;
        font-size: 1.75rem;
        font-weight: 500;
        letter-spacing: 0.28px;
        color: #242424;
      }
      #intro_right progress{
        width: 100%;
        height: 10px;
        margin: 0;

      }
      #intro_invest{
        display: flex;
        width: 100%;
        justify-content: space-between;
      }
      .intro_titles{
        font-size: 1.125rem;
        color: #575757;
        letter-spacing: -1.08px;
      }
      .intro_titles p{
        font-size: 2.5rem;
        font-size: 1.125rem;
        color: #575757;
        letter-spacing: -1.08px;
      }

      #progressBar{
        -webkit-appearance: none;
        width: 450px;
        height: 10px;
      }
      progress::-webkit-progress-bar {
        background-color: #7daae9;
        border-radius: 8px;
      }
      progress::-webkit-progress-value {
        background-color: var(--mainColor);
        border-radius: 8px;
      }

      #intro_right p{
        font-size: 2,5rem;
        letter-spacing: -1.6px;
        color: #464646;
        margin: 0px;
      }
      #intro_right span{
        font-size: 1.125rem;
        color: #575757;
        margin-left: 15px;
      }
      #intro_btnGroup{
        display: flex;
        justify-content: space-between;
        width: 100%;
        height: 65px;
        margin-top: 15px;
      }
      #btnInvest{
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(104deg, #e8ebf2, #f2f3f7);
        width: 270px;
        height: 65px;
        border-radius: 10px;
        border: none;
        font-size: 1.375rem;
        font-weight: 500;
        color: #464646;
        transition: 0.5s ease;
      }

      #btnInvest:hover{
        background: var(--gray2);
        transition: 0.5s ease;
      }

      #btnLike{
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(135deg, #e8ebf2, #f2f3f7);
        width: 65px;
        height: 65px;
        border-radius: 10px;
        border: solid 1px #ffffff;
      }
      #btnShare{
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(135deg, #e8ebf2, #f2f3f7);
        width: 65px;
        height: 65px;
        border-radius: 10px;
        border: solid 1px #ffffff;
      }
      #intro_btnGroup img{
        width: 32px;
        height: 32px;

      }
      #stockInfo{
        background-image: url('img/banner_bg.png');
        width: 100%;
        height: 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 80px;
        padding: 16px 130px;
      }
      #stockInfo p{
        margin-bottom: 0;
        font-size: 1.5rem;
        letter-spacing: -0.48px;
      }
      #stockInfo span{
        font-size: 1.25rem;
        letter-spacing: -0.4px;
      }
      .stockBox{
        text-align: center; 
        color: #fff;
      }
      #btnStock{
        width: 199px;
        height: 56px;
        font-size: 1.5rem;
        font-weight: bold;
        color: #464646;
        letter-spacing: -0.48px;
        border: none;
        border-radius: 6px;
        background-color: #e7d2e5;
      }

      #storyContainer{
        /* background-color: red; */
        width: var(--width);
        padding-top: 35px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
      }
      #s_left{
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(151deg, #e8ebf2, #f2f3f7 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 10px;
        width: 830px;
        /* height:100%; */
        padding: 60px 130px;
      }
      .p_leftWords{
        font-size: 1.25rem;
        line-height: 220%;
      }
      /* .p_leftWords b{font-size: 30px;} */
      .p_leftWords h1{margin-bottom: 20px;}
      .p_imgs img{
        width: 569px;
        height: 320px;
        margin: 50px 0;
      }

      #s_right{
        /* padding-top: 20px; */
        /* background-color: gray; */
        width: 400px;
        /* height: 1400px; */
        /* overflow: scroll; */
        margin-left: 50px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
      }
      .s_rightBoxs{
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(151deg, #e8ebf2, #f2f3f7 100%);
        width: 400px;
        margin-bottom: 50px;
        padding: 20px 40px 15px 40px;
        border-radius: 10px;
      }
      #etp_infoBox{
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(151deg, #e8ebf2, #f2f3f7 100%);
        width: 400px;
        margin-bottom: 50px;
        padding: 25px 35px 40px 35px;
        border-radius: 10px;
      }
      #etp_title{
        font-size: 1.75rem;
        font-weight: 500;
        letter-spacing: -1.12px;
        color: #464646;
      }
      #ent_name{
        width: 100%;
        font-size: 1.375rem;
        font-weight: 500;
        letter-spacing: -0.88px;
        color: #464646;
        margin-top: 20px;
        margin-bottom: 25px;
      }
      #ent_name img{
        width: 44px;
        height: 44px;
        border-radius: 25px;
        border: solid 1px #ececec;
        margin-right: 6px;
      }
      #ent_words{
        font-size: 1.125rem;
        font-weight: 500;
        line-height: 1.94;
        letter-spacing: -0.72px;
        color: #464646;
      }
      #etp_infoBox hr{
        color: #707070;
        margin: 29.5px 0;
      }
      .reward_title{
        width: 100%;
        font-size: 1.375rem;
        font-weight: bold;
        letter-spacing: -0.88px;
        color: #464646;
      }
      #btnEnt{
        width: 330px;
        height: 50px;
        border: none;
        border-radius: 10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(99deg, #e8ebf2, #f2f3f7);
        font-size: 1.5rem;
        font-weight: 500;
        line-height: 1.46;
        letter-spacing: -0.48px;
        color: #575757;
      }
      #ent_pop_bg{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 2;
      }
      #ent_pop_bg_m{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 2;
      }
      #ent_pop{
        position: absolute;
        left: calc(50% - var(--width)/2);
        top: calc(50% - 550px/2);
        width: var(--width);
        height: 550px;
        background: #fff;
        padding: 60px 120px;
        z-index: 2;
      }
      #ent_pop a{color:var(--mainColor)}
      #ent_pop p{
        font-size: 2rem;
        font-weight: 500;
        color: #000;
      }
      #ent_pop span{
        width: 100%;
        font-size: 1.875rem;
        font-weight: 500;
        letter-spacing: -1.2px;
        color: #464646;
      }
      #ent_pop textarea{
        width: 100%;
        height: 178px;
        padding: 13px 0 13px 30px;
        font-size: 1.625rem;
        letter-spacing: -0.52px;
        color: #949494;
      }
      /* */
      #ent_pop_m{
        position: absolute;
        left: calc(50% - var(--width)/2);
        top: calc(50% - 550px/2);
        width: var(--width);
        height: 550px;
        background: #fff;
        padding: 60px 120px;
        z-index: 2;
      }
      #ent_pop_m a{color:var(--mainColor)}
      #ent_pop_m p{
        font-size: 2rem;
        font-weight: 500;
        color: #000;
      }
      #ent_pop_m span{
        width: 100%;
        font-size: 1.875rem;
        font-weight: 500;
        letter-spacing: -1.2px;
        color: #464646;
      }
      #ent_pop_m textarea{
        width: 100%;
        height: 178px;
        padding: 13px 0 13px 30px;
        font-size: 1.625rem;
        letter-spacing: -0.52px;
        color: #949494;
      }
      .right_rName{
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.8px;
        color: #464646;
        margin: 10px 0 5px 0;
      }
      .right_rPckg{
        font-size: 1rem;
        letter-spacing: -0.64px;
        color: #464646;
      }

      #p_recomContainer{
        /* background-color: ghostwhite; */
        width: var(--width);
        margin: 0 auto;
        margin-top: 100px;
      }
      #recomTitle{
        font-size: 2.125rem;
        font-weight: 500;
        letter-spacing: -1.04px;
        color: #464646;
        margin-left: 25px;
      }
      #recomSubTitle{
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -2.21px;
        color: #575757;
        margin-left: 25px;
      }
      #inputLink {
        position: absolute;
        top: 0;
        left: 0;
        width: 1px;
        height: 1px;
        margin: 0;
        padding: 0;
        border: 0;
      }
      #toast {
        /* position: fixed; */
        position: absolute;
        top: 60%;
        /* bottom: 30px; */
        left: 86%;
        padding: 15px 20px;
        transform: translate(-50%, 10px);
        border-radius: 30px;
        overflow: hidden;
        /* font-size: .8rem; */
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s, visibility .5s, transform .5s;
        background: rgba(0, 0, 0, .35);
        color: #fff;
        z-index: 10000;
      }
      #toast.reveal {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0);
      }
      #intro_right>div>p{
        font-size: 2.5rem;
      }
      #stockInfo_mobile{
        margin-top:20px;
        box-shadow: 10px 10px 11px #e2e3e4, -10px -10px 11px #fff;
            background-image: linear-gradient(
        151deg
        , #e8ebf2, #f2f3f7 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
            width: 100%;
            /* height: 100%; */
            height: 293px;
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
    </style>

    <title>펀웨어 - <?=$row["f_project_name"]?></title>
    <link rel="stylesheet" href="css/jun_media/projectDetail_tablet.css"> 
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
                        if($user_login){
                          $q_user= $db->prepare('SELECT f_user_name, f_profile FROM funware_user WHERE ai_id = ? AND f_div = "Y";');
                          $q_user->execute(array($_SESSION["userId"]));
                          $row_user = $q_user->fetch(PDO::FETCH_ASSOC);
                          $row_user["f_profile"] = ($row_user["f_profile"] == "") ? "img/defaultProfile.jpg" : $row_user["f_profile"];
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
                      <li><a class="dropdown-item" href="helpCenter.html">Help center</a></li>
                      <li><a class="dropdown-item" href="admin/">Admin Console</a></li>
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

      <!-- 프로젝트 상세 정보 -->
      <div id="detail-container">
        <?php
          $rate = ($row["achieveRate"] >= 100) ? 100 : $row["achieveRate"];
          $temp = str_replace("https://", "//", $row["f_gamepv"]);
          $row["f_gamepv"] = str_replace("watch?v=", "embed/", $temp);
          // $row["f_gamepv"] .= '?autoplay=1';
         ?>
        <!-- Introduction -->
        <div id="mobile_intro">
          <div id="p_name_mobile"><?=$row["f_project_name"]?></div>
          <iframe title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="436" src="<?=$row["f_gamepv"]?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div id="wrap_introStock">
        
          <div id="wrap_intro">
            <div id="introduction">
              <div id="intro_left">
                <iframe title="YouTube video player" class="youtube-player" type="text/html"  width="100%" height="436" src="<?=$row["f_gamepv"]?>" frameborder="0" allowfullscreen></iframe>
              </div>
              <div id="intro_right">
                <div id="p_name"><?=$row["f_project_name"]?></div>
                <div>
                  <progress id="progressBar" value='<?=$rate?>' max='100'></progress>
                  
                  <div class="intro_titles" id="intro_invest">
                    <div id="moin_money">모인 금액</div>
                    <div><?=$row["achieveRate"]?> %</div>
                  </div>
                  <p><?=number_format($row["invested"])?><span>원</span></p>
                </div>
                <div id="dDay">
                  <div class="intro_titles">남은 시간</div>
                  <p><?=$row["f_daysleft"]?><span>일</span></p>
                </div>
                <div id="investNum">
                  <div class="intro_titles">후원자</div>
                  <p><?=$row["investNum"]?><span>명</span></p>
                </div>
                <div class="row" id="introbox_mobile">
                  <div class="intro_titles col-4" id="money_mobile">
                    <div>모인 금액</div>
                    <p><?=number_format($row["invested"])?><span>원</span></p>
                  </div>
                  <div id="dDay_mobile" class="col-4">
                    <div class="intro_titles">남은 시간</div>
                    <p><?=$row["f_daysleft"]?><span>일</span></p>
                  </div>
                  <div id="investNum_mobile" class="col-4">
                    <div class="intro_titles">후원자</div>
                    <p><?=$row["investNum"]?><span>명</span></p>
                  </div>
                </div>
                <div id="intro_btnGroup">
                  <?php
                    if($row["sys_register_id"] !== $_SESSION["userId"]){
                  ?>
                      <!-- <button type="button" id="btnInvest" name="button" onclick="location.href='pay.php?p_num=<=$p_num?>'"><=$_SESSION["userId"]?></button> -->
                      <button type="button" id="btnInvest" name="button" onclick="location.href='pay.php?p_num=<?=$p_num?>'">펀딩 참여하기</button>
                  <?php
                    }else {
                  ?>
                      <button type="button" id="btnInvest" name="button" onclick="location.href='newProject.php?p_num=<?=$p_num?>'">수정하기</button>
                  <?php
                    }
                  ?>

                    <?php
                      $userID = ($user_login) ? $_SESSION["userId"] : 0;

                      $q_isLike= $db->query('SELECT * FROM funware_pj_bookmark WHERE sys_user_id = '.$userID.' AND sys_project_id = '.$p_num.';');
                        
                      if($row = $q_isLike->fetch(PDO::FETCH_ASSOC)){
                        echo "<button type='button' id='btnLike' name='button'><img src='img/liked.png'></button>";

                      }else{
                        echo "<button type='button' id='btnLike' name='button'><img src='img/like.png'></button>";
                      }
                    ?>
                    <input type="text" id="inputLink">
                    <div id="toast">링크가 복사되었습니다.</div>
                    <button type="button" id="btnShare" name="button" OnClick="javascript:CopyUrl()"><img src="img/share.png"></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="wrap_stock">
            <?php
              $q2 = $db->query('SELECT ai_project_id
                                        ,f_etp_value
                                        ,f_par_value
                                FROM funware_enterprise
                                  LEFT JOIN funware_project
                                    ON funware_project.ai_project_id = funware_enterprise.sys_project_id
                                WHERE funware_project.f_div = "Y" AND ai_project_id = '.$p_num.';'
              );
              $row = $q2->fetch(PDO::FETCH_ASSOC);
              $q2->closeCursor();
             ?>

            <!-- StockInfo -->
            <div id="stockInfo">
              <div class="stockBox">
                <p>기업 가치</p>
                <span><?=number_format($row["f_etp_value"])?>원</span>
              </div>
              <div class="stockBox">
                <p>주당 가격</p>
                <span><?=number_format($row["f_par_value"])?>원</span>
              </div>
              <div class="stockBox">
                <p>배정 순위</p>
                <span>무작위</span>
              </div>
              <button type="button" id="btnStock" onclick="location.href='pay.php?p_num=<?=$p_num?>'">투자하기</button>
            </div>
            <div id="stockInfo_mobile">
              <div class="tab_area">
                <ul>
                  <li class="t01"><a href="#" rel="tab1">기업정보</a></li>
                  <li class="t02"><a href="#" rel="tab2">후원리워드</a></li>
                </ul>
                <div class="conbox" id="tab1">
                  <div>
                    <p>기업 가치 <span><?=number_format($row["f_etp_value"])?>원</span></p>
                    
                  </div>
                  <div>
                    <p>주당 가격 <span><?=number_format($row["f_par_value"])?>원</span></p>
                    
                  </div>
                  <div>
                    <p>배정 순위 <span>무작위</span></p>
                    
                  </div>
                  <?php
                    $q4 = $db->query('SELECT ai_project_id
                                            ,f_etp_name
                                            ,f_etp_desc
                                            ,f_etp_logo
                                            ,f_etp_url
                                            ,f_etp_value
                                      FROM funware_enterprise
                                            LEFT JOIN funware_project
                                                    ON funware_project.ai_project_id = funware_enterprise.sys_project_id
                                      WHERE ai_project_id = '.$p_num.';'
                    );
                    $row_etp = $q4->fetch(PDO::FETCH_ASSOC);
                    // 회사 소개 null
                    if($row_etp["f_etp_desc"] != NULL){
                      $enpWords = $row_etp["f_etp_desc"];
                      $num = stripos($row_etp["f_etp_desc"], ".");
                      if($num == NULL){
                        $ent_fs = $enpWords;
                      }else{
                        $ent_fs = substr($row_etp["f_etp_desc"], 0, $num+1);
                      }
                      // $ent_fs = 'test';
                      // $enpWords = 'test';
                    }else{
                      $ent_fs = 'Best enterprise! We recommend this creative corporate game.';
                      $enpWords = 'Best enterprise! We recommend this creative corporate game.';
                    }
                    // 회사 URL null
                    if($row_etp["f_etp_url"] != NULL){
                      $url = $row_etp["f_etp_url"];
                      $entUrl = '<a href="'.$url.'" target="_blank"><span>'.$row_etp["f_etp_url"].'</span></a>';
                    }else{
                      $entUrl = '<span>This company does not provide a site address.<span>';
                    }

                  ?>
             
                
                <div id="ent_name">
                  <span id="etp_title">회사소개</span><img src="<?=$row_etp["f_etp_logo"]?>"><?=$row_etp["f_etp_name"]?>
                </div>
                <div id="ent_words"><?=$ent_fs?></div>
                <hr>
                <div id="ent_pop_bg_m">
                <div id="ent_pop_m">
                  <p>회사 소개 상세 보기</p>
                  <span><?=$row_etp["f_etp_name"]?></span><br><br>
                  <textarea><?=$enpWords?></textarea><br>
                  <span>기업 가치 : <?=number_format($row_etp["f_etp_value"])?> 원</span><br>
                  <?=$entUrl?>
                </div>
             </div>
             
                  <button type="button" id="btninvest_mobile" onclick="location.href='pay.php?p_num=<?=$p_num?>'">투자하기</button>
                  <button id="btnEnt_mobile" type="button" name="button">상세보기</button>
                </div>
                <div class="conbox" id="tab2">
                  <?php
                  $q5 = $db->query("SELECT ai_rewards,funware_rewards.sys_project_id, f_reward_div,f_reward_desc,f_reward_cont, f_reward_money
                                    FROM   funware_rewards
                                    WHERE  funware_rewards.sys_project_id = '.$p_num.' AND funware_rewards.f_div='Y';
                                    ORDER BY f_reward_money"
                  );
                  while($row = $q5->fetch(PDO::FETCH_ASSOC)){
                    echo '<div class="s_rightBoxs">';
                      echo '<p class="reward_title">'.$row["f_reward_div"].' ('.number_format($row["f_reward_money"]).')</p>';
                      echo '<p class="right_rName">'.$row["f_reward_desc"].'</p>';
                      echo '<p class="right_rPckg">'.$row["f_reward_cont"].'</p>';
                    echo '</div>';
                  }
                  $q5->closeCursor();
                  ?>
                </div>
              </div>
            </div>
          </div>
          </div>

        <!-- 본론(프로젝트 소개) -->
        <div id="storyContainer">
          <?php
            $q3 = $db->query('SELECT ai_project_id, f_storyline, f_summary, f_storyline_img, f_summary_img, f_gamepv
                              FROM funware_project
                                   LEFT JOIN funware_img
                                        ON funware_project.ai_project_id = funware_img.sys_project_id
                              WHERE ai_project_id = '.$p_num.';'
            );
            $row = $q3->fetch(PDO::FETCH_ASSOC);
            $q3->closeCursor();

            // 프리뷰 영상 링크
            $temp = str_replace("https://", "//", $row["f_gamepv"]);
            $row["f_gamepv"] = str_replace("watch?v=", "embed/", $temp);
            $row["f_gamepv"] .= '?autoplay=1';

            $sumImg = ($row["f_summary_img"] != 'null') ? '<img src="'.$row["f_summary_img"].'">' : '';
            
           ?>
          <div id="s_left">
            <div class="p_leftWords">
              <h1>Storyline</h1>
              <?=$row["f_storyline"]?>
            </div>
            <div class="p_imgs">
              <img src="<?=$row["f_storyline_img"]?>">
            </div>
            <div class="p_leftWords">
              <h1>The plot of the game</h1>
              <?=$row["f_summary"]?>
            </div>
            <div class="p_imgs">
              <?=$sumImg?>
            </div>
          </div>

          <div id="s_right">
             <div id="etp_infoBox">
                <p id="etp_title">회사소개</p>
                <div id="ent_name">
                  <img src="<?=$row_etp["f_etp_logo"]?>"><?=$row_etp["f_etp_name"]?>
                </div>
                <div id="ent_words"><?=$ent_fs?></div>
                <hr>
                <button id="btnEnt" type="button" name="button">상세보기</button>
             </div>
             <!-- 회사 상세 정보 -->
             <div id="ent_pop_bg">
               <div id="ent_pop">
                 <p>회사 소개 상세 보기</p>
                 <span><?=$row_etp["f_etp_name"]?></span><br><br>
                 <textarea><?=$enpWords?></textarea><br>
                 <span>기업 가치 : <?=number_format($row_etp["f_etp_value"])?> 원</span><br>
                 <?=$entUrl?>
               </div>
             </div>
             <?php
               $q5 = $db->query("SELECT ai_rewards,funware_rewards.sys_project_id, f_reward_div,f_reward_desc,f_reward_cont, f_reward_money
                                 FROM   funware_rewards
                                 WHERE  funware_rewards.sys_project_id = '.$p_num.' AND funware_rewards.f_div='Y';
                                 ORDER BY f_reward_money"
               );
               while($row = $q5->fetch(PDO::FETCH_ASSOC)){
                 echo '<div class="s_rightBoxs">';
                   echo '<p class="reward_title">'.$row["f_reward_div"].' ('.number_format($row["f_reward_money"]).')</p>';
                   echo '<p class="right_rName">'.$row["f_reward_desc"].'</p>';
                   echo '<p class="right_rPckg">'.$row["f_reward_cont"].'</p>';
                 echo '</div>';
               }
               $q5->closeCursor();
              ?>
          </div>
        </div>

        <div id="p_recomContainer">
          <p id="recomTitle">이런 프로젝트는 어때요?</p>
          <p id="recomSubTitle">FunWare에서 Funny들을 위해서 추천해봐요!</p>
          <?php
           $p_ctg=$db->query('SELECT sys_category_id FROM funware_pj_category
                              WHERE sys_project_id = '.$p_num.';');
           $row = $p_ctg->fetch(PDO::FETCH_ASSOC);
           $p_ctg = $row['sys_category_id'];
           $q6 = $db->query('SELECT j_link.sys_project_id  AS p_id
                                  ,j_link.sys_category_id
                                  ,j_category.f_category_name
                                  ,j_project_Sum.f_project_name AS f_project_name
                                  ,j_project_Sum.f_projectTotal
                                  ,j_project_Sum.f_percent AS f_percent
                                  ,j_project_Sum.f_etp_name AS f_etp_name
                                  ,j_project_Sum.f_daysleft
                                  ,j_project_Sum.f_thum AS f_thum
                                
                                
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
                              WHERE j_project_Sum.f_daysleft > 0 AND j_link.sys_category_id = '.$p_ctg.' AND j_link.sys_project_id NOT IN('.$p_num.')
                              ORDER BY j_project_Sum.f_percent DESC limit 4'
           );
           echo '<div id="recommPro" class="cards">';
           while($row = $q6->fetch(PDO::FETCH_ASSOC)){
            $projectSize = strlen($row["f_project_name"]);
            $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 20).'...': $row["f_project_name"] ;
            echo '<div class="cards_contents">';
            echo '<a href="projectDetail.php?p_num='.$row["p_id"].'">';
              echo '<div class="p_thumnail"><img src="'.$row["f_thum"].'"></div>';
              echo '<div class="p_infoBox">';
                echo '<div class="enp_name">', $row["f_etp_name"], '</div>';
                echo '<div class="p_nameRateBox p_tip">';
                  echo '<div class="p_name">', $projectName, '</div>';
                  echo '<div class="d_rate">', $row["f_percent"], '%</div>';
                  echo '<span>' , $row["f_project_name"] ,'</sapn>';
                echo '</div>';
              echo '</div>';
            echo '</div></a>';
           }
           echo '</div>';
          ?>
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
    <script>
      $(function () {
        // $("body div").fadeIn(500, function () {
            $("#detail-container").animate({
              "opacity": "1"
            },1000);
        // });
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

      // 회사 상세 정보
      $("#btnEnt").click(function(e){
        e.preventDefault();
        let windowY = $(window).scrollTop();
        $('html, body').css({
          'overflow': 'hidden',
          'top' : windowY+"px"
        });
        $("#ent_pop_bg").css({
          "display" : "block",
          "top" : windowY+"px"
        });
      });
      $("#ent_pop_bg").click(function(){
        $('html, body').css({'overflow': 'auto'});
        $(this).css({"display" : "none"});
      });


      $("#btnEnt_mobile").click(function(e){
        e.preventDefault();
        let windowY = $(window).scrollTop();
        $('html, body').css({
          'overflow': 'hidden',
          'top' : windowY+"px"
        });
        $("#ent_pop_bg_m").css({
          "display" : "block",
          "top" : windowY+"px"
        });
      });
      $("#ent_pop_bg_m").click(function(){
        $('html, body').css({'overflow': 'auto'});
        $(this).css({"display" : "none"});
      });
     
      
      $(function(){
          $(".conbox").hide();
          $("#tab1").show();
          $(".tab_area .conbox:first-child").show();
          $(".tab_area ul li").on('click','a',function () {
              $(".tab_area li a").removeClass("on");
              $(this).addClass("on");
              $(this).closest("div").find(".conbox").hide();
              var activeTab = $(this).attr("rel");
              $("#" + activeTab).fadeIn();
          });
      });

      // ❤
      $("#btnLike").click(function(e){
        // console.log(<=$user_login?>);
        if('<?=$user_login?>' == '1'){
          // console.log('로그인 됨');
          $.ajax({
            url: "ajax_src/ajaxLike.php",
            type: "post",
            // dataType: "json",
            // async: true,
            data: {
              userId : <?=$userID?>,
              p_num  : <?=$p_num?>
            },
            success: (data) => {
              if(data) {
                $("#btnLike").html(data);
              }
            }
          });
        }else{
          // console.log('로그인 안됨');
          alert('로그인이 필요한 서비스입니다.');
        }
      });

      // Link copy
      let removeToast;

      $('#btnShare').click(
          function() {
              const urlbox = document.getElementById('inputLink');
              urlbox.value = window.document.location.href;
              urlbox.select();
              document.execCommand( 'Copy' );
              // alert( 'URL 이 복사 되었습니다.' );
              const toast = document.getElementById("toast");

          toast.classList.contains("reveal") ?
              (clearTimeout(removeToast), removeToast = setTimeout(function () {
                  document.getElementById("toast").classList.remove("reveal")
              }, 1000)) :
              removeToast = setTimeout(function () {
                  document.getElementById("toast").classList.remove("reveal")
              }, 1000)
          toast.classList.add("reveal"),
              toast.innerText = string
          }
      );

      // Toast
      // let removeToast;

      function toast(string) {
          const toast = document.getElementById("toast");

          toast.classList.contains("reveal") ?
              (clearTimeout(removeToast), removeToast = setTimeout(function () {
                  document.getElementById("toast").classList.remove("reveal")
              }, 1000)) :
              removeToast = setTimeout(function () {
                  document.getElementById("toast").classList.remove("reveal")
              }, 1000)
          toast.classList.add("reveal"),
              toast.innerText = string
      }

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
      
    </script>
  </body>
</html>
<?php
}catch(Exception $e){
  echo $e;
}

 ?>
