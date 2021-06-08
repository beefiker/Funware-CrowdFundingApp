<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';
  
  if(!$user_login) {
    echo "<script>";
    echo    "alert('로그인이 필요한 서비스입니다.');";
    echo    "location.href='login.php'";
    echo "</script>";
  }

  $default = [
      'pName' => '',
      'category' => '',
      'targetMoney' => '',
      'dateLimit' => '',
      'storyline' => '',
      'plot' => '',
      'etpName' => '',
      'etpDesc' => '',
      'etpLink' => '',
      'etpValue' => '',
      'etpJuPrice' => '',
      'etpBank' => '',
      'etpAccountNum' => ''
  ];
?>
<!DOCTYPE html>
  <head>
    <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/7637a8f104.js" crossorigin="anonymous"></script>

    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery/jquery-ui.css">
    <link rel="stylesheet" href="css/jquery/datepicker/datepicker.min.css">
    
    <link rel="stylesheet" href="css/funware_src/cards.css">
    <link rel="stylesheet" href="css/funware_src/footer.css">

    <title>펀웨어 - 프로젝트 만들기</title>

    <style>
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

      *{
        font-family: 'Spoqa Han Sans Neo', 'sans-serif';
      }
      li {list-style: none;}
      a {text-decoration: none;}

      #wrap-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        max-width: 100%;
      }

      #formBox{
        background-color: var(--gray1);
        width: 100%;
        margin-top: 105px;
      }

      /* 탭 메뉴 */
      .tabArea {
        max-width: var(--width);
        margin: 0 auto;
      }
      .tabArea .tab{
        display: flex;
        text-align: center;
        padding: 0;
      }
      .tabArea .tab li{
        width: 253px;
        padding: 24px;
        border-radius: 10px;
        border: solid 1px #d1d1d1;
        margin-right: 40px;
        box-shadow: 20px 20px 30px 0 rgba(15, 41, 107, 0.12);
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
        cursor:pointer;
      }
      
      .tabArea .tab li a {
        font-size: 1.625rem;
        font-weight: 500;
        letter-spacing: -0.78px;
        color: #212121;
      }

      .tabArea .tab li img {
        width: 35px;
        height: 35px;
        margin-right: 10px;
      }
      
      /* 선택 탭 li 글씨 변화 */
      .tabArea .tab li.on a { 
        /* font-weight: bold; */
        /* color: var(--mainColor); */
      }
      .tabArea .tab li.on {
        /* background-color: white; */
        /* border-bottom: 3px solid var(--mainColor); */
      }
      
      .tabArea .tabBox {
        display: none; 
        padding: 60px 0 198px 0;
      }
      .tabArea .tabBox.on {
        display: block; 
      }

      #newProjectForm{
        max-width: var(--width);
      }
      
      .wrapForm{
        background-color: #fff;
        border: solid 1px #d1d1d1;
        border-radius: 10px;
        box-shadow: 20px 20px 30px 0 rgba(15, 41, 107, 0.12);
        background-image: linear-gradient(127deg, #e8ebf2, #f2f3f7);
      }
      
      .formInputBox{
        width: 100%;
        border-top: 1px solid #d1d1d1;
        padding: 30px 80px 20px 80px;
      }
      .inputNames{
        font-size: 1.5rem;
        font-weight: 500;
        letter-spacing: -0.48px;
        color: #575757;
      }
      .beforeInputShow{
        font-size: 1.625rem;
        letter-spacing: -0.52px;
        color: #fa6462;
        cursor: pointer;
      }
      .afterInputShow{
        width: 100%;
        display: none;
      }
      .wrapInput{
        width: 100%;
      }
      .inputText{
        width: 403px;
        height: 45px;
        border: solid 1px #d1d1d1;
        border-radius: 10px;
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }
      #ctgSelect{
        width: 403px;
        height: 45px;
        border-radius: 10px;
        border: solid 1px #d1d1d1;  
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }

      .inputwords{
        width: 100%;
        height: 180px;
        border: solid 1px #d1d1d1;
        border-radius: 10px;
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }

      .box-file-input label{
        display:inline-block;
        background-color: #F8F8F8;
        border: 1px solid #D3D3D3;
        border-radius: 10px;
        font-size: 1.25rem;
        font-weight: 500;
        color: #707070;
        padding:0px 15px;
        line-height:35px;
        cursor:pointer;
      }

      .box-file-input label:after{
        content:"파일등록";
      }

      .box-file-input .file-input{
        display:none;
      }

      .box-file-input .filename{
        display:inline-block;
        padding-left:10px;
      }

      .inputImgBox{
        width: 100%;
        display: flex;
        gap: 42px;
        margin-bottom: 30px;
      }
      .singleInputImg p{
        font-size: 1.125rem;
        letter-spacing: -0.36px;
        color: #707070;
      }
      .singleInputImg span{
        font-size: 1rem;
        font-weight: 500;
        letter-spacing: -0.32px;
        color: #707070;
        margin-right: 10px;
      }
      .previewImage{
        width: 160px;
        border-radius: 10px 10px 0 0;
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }
      .inputEtpAccount{
        width: 250px;
        height: 45px;
        border: solid 1px #d1d1d1;
        border-radius: 10px;
        text-align: center;
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }

      .filebox label {
        display: inline-block;
        padding: .5em .75em;
        color: #707070;
        font-size: 1rem;
        width: 160px;
        text-align: center;
        line-height: normal;
        vertical-align: middle;
        border: 1px solid #D3D3D3;
        border-radius: 0 0 10px 10px;
        cursor: pointer;
        -webkit-transition: background-color 0.2s;
        transition: background-color 0.2s;
      }

      .filebox label:hover {
        background-color: var(--mainColor);
        color: white;
      }

      .filebox label:active {
        background-color: #14348d;
      }

      .filebox input[type="file"] {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
      }

      #inputTrailerLink{
        all: unset;
        width: 329px;
        display: inline-block;
        border-bottom: 1px solid #707070;
      }

      #labelDatepicker{
        border-bottom: 1px solid #707070;
        width: 350px;
      }

      #datepicker{
        all: unset;
        width: 320px;
      }
      #imgCalender{
        width: 20px;
        height: 20px;
      }

      #previewLogo{
        width: 160px;
        border-radius: 10px 10px 0 0;
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }

      #inputEtpLink{
        all: unset;
        width: 329px;
        display: inline-block;
        border-bottom: 1px solid #707070;
      }

      #bankSelect{
        width: 142px;
        height: 42.5px;
        text-align-last: center;
        background: #e4e8ef;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
        border: solid 1px #d1d1d1;
        border-radius: 10px;
      }

      .rewardSet{
        display: grid;
      }

      #btnRewardAdd{
        width: 80px;
        height: 30px;
        border-radius: 6px;
        box-shadow:  6px 6px 12px #e5e7e9,
                     -6px -6px 12px #fdffff;
        background-image: linear-gradient(111deg, #e8ebf2, #f2f3f7);
        color: var(--mainColor);
        font-size: 1.25rem;
        text-align: center;
        border: none;
        cursor: pointer;
      }
      
      .submitBox{
        width: 100%;
        margin-top: 27px;
        margin-bottom: 50px;
        display: flex;
        flex-direction: column;
      }

      .p_chkBox{
        margin: 0 auto;
        padding-bottom: 10px;
      }

      .submitBoxBtns{
        margin: 0 auto;
      }

      .btnNext{
        width: 200px;
        height: 65px;
        border: none;
        border-radius: 10px;
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.4px;
        color: var(--mainColor);
        box-shadow:  6px 6px 12px #e5e7e9,
                     -6px -6px 12px #fdffff;
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
        margin-right: 20px;
      }

      #btnTempSave{
        width: 200px;
        height: 65px;
        border: none;
        border-radius: 10px;
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.4px;
        color: #707070;
        box-shadow:  6px 6px 12px #e5e7e9,
                     -6px -6px 12px #fdffff;
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
        margin-right: 20px;
      }

      #btnSubmit{
        width: 200px;
        height: 65px;
        border: none;
        border-radius: 10px;
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.4px;
        color: var(--mainColor);
        box-shadow:  6px 6px 12px #e5e7e9,
                     -6px -6px 12px #fdffff;
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
      }

      p .requireSpan,
      .requireSpan{
        color:red;
        margin-left:5px;
      }


      #btnRecall{
        margin-right: 0 auto;
        width: 200px;
        height: 65px;
        border: none;
        border-radius: 10px;
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.4px;
        color: var(--mainColor);
        box-shadow:  6px 6px 12px #e5e7e9,
                     -6px -6px 12px #fdffff;
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
        margin-right: 20px;
      }

      #btnModify{
        margin-right: 0 auto;
        width: 200px;
        height: 65px;
        border: none;
        border-radius: 10px;
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.4px;
        color: var(--mainColor);
        box-shadow:  6px 6px 12px #e5e7e9,
                     -6px -6px 12px #fdffff;
        background-image: linear-gradient(108deg, #e8ebf2, #f2f3f7);
        margin-right: 20px;
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

      #testWrapper{
        /* opacity:0; */
      }


    </style>
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <link rel="stylesheet" href="css/funware_src/mediaQueries/newProject.css">
<?php

if(isset($_REQUEST["p_num"])){
  $p_num = $_REQUEST["p_num"];
  // funware_project
  $q_project= $db->prepare('SELECT * FROM funware_project WHERE ai_project_id = ? AND f_div = "Y";');
  $q_project->execute(array($p_num));
  $row_project = $q_project->fetch(PDO::FETCH_ASSOC);
  $q_project->closeCursor();


  // funware_pj_category
  $q_category= $db->prepare('SELECT * FROM funware_pj_category WHERE sys_project_id = ?');
  $q_category->execute(array($p_num));
  $row_category = $q_category->fetch(PDO::FETCH_ASSOC);
  $q_category->closeCursor();

  // funware_img
  $q_img= $db->prepare('SELECT * FROM funware_img WHERE sys_project_id = ?');
  $q_img->execute(array($p_num));
  $row_img = $q_img->fetch(PDO::FETCH_ASSOC);
  $q_img->closeCursor();

  // funware_enterprise
  $q_enterprise= $db->prepare('SELECT * FROM funware_enterprise WHERE sys_project_id = ?');
  $q_enterprise->execute(array($p_num));
  $row_enterprise = $q_enterprise->fetch(PDO::FETCH_ASSOC);
  $q_enterprise->closeCursor();

  // funware_rewards
  $q_rewards= $db->prepare('SELECT * FROM funware_rewards WHERE sys_project_id = ?');
  $q_rewards->execute(array($p_num));
  $row_rewards = $q_rewards->fetch(PDO::FETCH_ASSOC);
  $q_rewards->closeCursor();

  $storyLine = str_replace ("'", "\'", $row_project["f_storyline"]);
  $storyLine = str_replace ("\"", "\'", $storyLine);
  $storyLine = str_replace("\r\n", " ", $storyLine);
  $storyLine = str_replace("\r", " ", $storyLine);
  $storyLine = str_replace("\n", " ", $storyLine);

  $plot = str_replace ("'", "\'", $row_project["f_summary"]);
  $plot = str_replace ("\"", "\'", $storyLine);
  $plot = str_replace("\r\n", " ", $plot);
  $plot = str_replace("\r", " ", $plot);
  $plot = str_replace("\n", " ", $plot);
  // $plot = str_replace ("<br>", "\'", $row_project["f_summary"]); 
  // $default_pName = $row_project["f_project_name"];

  $default = [
      'pName' => $row_project["f_project_name"],
      'category' => $row_category["sys_category_id"],
      'targetMoney' => $row_project["f_donate_limit"],
      'dateLimit' => $row_project["f_date_limit"],
      'trailer' => $row_img["f_gamepv"],
      'storyline' => $row_project["f_storyline"],
      'plot' => $row_project["f_summary"],
      'etpName' => $row_enterprise["f_etp_name"],
      'etpDesc' => $row_enterprise["f_etp_desc"],
      'etpLink' => $row_enterprise["f_etp_url"],
      'etpValue' => $row_enterprise["f_etp_value"],
      'etpJuPrice' => $row_project["f_par_value"],
      'etpBank' => $row_project["f_cardbank"],
      'etpAccountNum' => $row_project["f_cardnum"]
  ];

  // 카테고리
  $q_cateList= $db->prepare('SELECT * FROM funware_category');
  $q_cateList->execute(array($p_num));
  
  while($row_cateList = $q_cateList->fetch(PDO::FETCH_ASSOC)){
    if($row_cateList["ai_category"] == $default["category"]){
      echo '<script> let currentCate = ""; </script>';
      echo '<script> currentCate = "'.$row_cateList["ai_category"].'"; </script>';
    }
  }
  $q_cateList->closeCursor();

  // 은행
  $bankArray = array("국민은행", "우리은행", "신한은행", "하나은행", "기업은행", "농협은행", 
                 "SC제일은행", "수협은행", "KDB산업은행", "시티은행", "카카오뱅크");

  foreach ($bankArray as $key => $value) {
    $bankNum = mb_strpos($value, $default["etpBank"]);
    if($bankNum !== false) {
      echo '<script> let currentBank = ""; </script>';
      echo '<script> currentBank = "'.$value.'"; </script>';
    }
  } 

  // echo '<script>console.log($("bankOption"));</script>';
?>

<script>
  const isPNum = true;
  alert("이미지와 리워드는 수정하지 않으시더라도 새로 등록해주셔야 합니다.");
</script>

<?php
}else{
?>
<script>
  const isPNum = false;
</script>
<?php
}
?>

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
                      $q_user = $db->query("SELECT f_user_name, f_profile, f_email, f_post_num, f_roadname, f_address_detail FROM funware_user WHERE ai_id = ".$_SESSION['userId']."");
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

<div id="testWrapper">
  <!-- register form -->
  <div id="formBox">
  

    <section class="tabArea">
      <ul class="tab">
        <li class="tabList on">
          <img src="img/funware_checked.png" alt="">
          <a href="#!">프로젝트 개요</a>
        </li>
        <li class="tabList">
          <img src="img/funware_check.png" alt="">
          <a href="#!">기업 정보 등록</a>
        </li>
      </ul>

      <?php
        if(isset($_REQUEST["p_num"])){
      ?>
        <form id="newProjectForm" action="sub_src/projectModify.php?p_num=<?=$p_num?>" method="post" enctype="multipart/form-data">
      <?php
        }else{
      ?>
        <form id="newProjectForm" action="projectUpload.php" method="post" enctype="multipart/form-data">
      <?php
        }
      ?>
      <!-- <form id="newProjectForm" action="projectUpload.php" enctype="multipart/form-data" method="post"> -->

        <div class="tabBox on">
          <div class="wrapForm">
          
            <div class="formInputBox">
              <p class="inputNames">프로젝트 이름이 뭐예요?<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트 이름을 입력해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <input type="text" id="inputPName" class="formInputList inputText" name="pName" value="<?=$default["pName"]?>" required>
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">프로젝트 카테고리 설정해 주세요!</p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트 카테고리를 설정해주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <select id="ctgSelect" name="pCategory">
                    <?php 
                      $q1 = $db->query('SELECT ai_category, f_category_name FROM funware_category WHERE f_div="Y"');
                      while($row = $q1->fetch(PDO::FETCH_ASSOC)){ //$row["f_category_name"]
                        echo '<option class="ctgOption" value="'.$row["ai_category"].'">'.$row["f_category_name"].'</option>';    
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">프로젝트 목표 금액을 설정해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트 목표 금액을 설정해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                <input type="number" id="inputTargetMoney" class=" formInputList inputText" name="donateLimit" value="<?=$default["targetMoney"]?>"> &nbsp;원
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">프로젝트 IR을 첨부해 주세요!</p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트 IR을 첨부해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <div class="box-file-input">
                    <label>
                      <input type="file" name="projectIR" class="file-input">
                    </label>
                    <span class="filename">파일을 선택해주세요.</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">프로젝트 이미지를 등록해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트 이미지를 등록해주세요.</p>
              <div class="afterInputShow">
                <div class="inputImgBox">
                  <div class="singleInputImg">
                    <p>썸네일<span class="requireSpan">*</span></p>
                    <img id="" src="img/newP_thumnail.jpg" class="previewImage">
                    <div class="filebox">
                      <label for="inputThumnailImg" name="thumnail">첨부파일 등록</label>
                      <input type="file" id="inputThumnailImg" class="inputImgs" name="img_thumnail" accept="image/*">
                    </div>
                  </div>

                  <div class="singleInputImg">
                    <p>대표 사진<span class="requireSpan">*</span></p>
                    <img id="" src="img/newP_thumnail_big.jpg" class="previewImage">
                    <div class="filebox">
                      <label for="inputThumnailBigImg">첨부파일 등록</label>
                      <input type="file" id="inputThumnailBigImg" class="inputImgs" name="img_thumnailBig" accept="image/*">
                    </div>
                  </div>

                  <div class="singleInputImg">
                    <p>스토리라인</p>
                    <img id="" src="img/newP_storyline.jpg" class="previewImage">
                    <div class="filebox">
                      <label for="inputStorylineImg">첨부파일 등록</label>
                      <input type="file" id="inputStorylineImg" class="inputImgs" name="img_storyline" accept="image/*">
                    </div>
                  </div>

                  <div class="singleInputImg">
                    <p>줄거리</p>
                    <img id="" src="img/newP_summary.jpg" class="previewImage">
                    <div class="filebox">
                      <label for="inputSummaryImg">첨부파일 등록</label>
                      <input type="file" id="inputSummaryImg" class="inputImgs" name="img_summary" accept="image/*">
                    </div>
                  </div>
                    
                </div>
                <div class="singleInputImg">
                  <p>트레일러<span class="requireSpan">*</span></p>
                  <span>링크</span>
                  <input type="text" id="inputTrailerLink" class="formInputList" name="trailer" placeholder=" 링크를 입력해 주세요." value="<?=$default["trailer"]?>">
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">프로젝트 기간을 설정해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트 기간을 설정해주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <p>프로젝트 마감일만 설정해주시면 됩니다.</p>
                  <label id="labelDatepicker">
                    <input type="text" id="datepicker" name="dateLimit" placeholder=" 기간을 정해주세요" value="<?=$default["dateLimit"]?>">
                    <img id="imgCalender" src="img/calender.png" alt="">
                  </label>
                </div>
              </div>
            </div>
            
            <div class="formInputBox">
              <p class="inputNames">프로젝트를 설명해주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;프로젝트를  설명해주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <p>스토리라인</p>
                  <textarea name="storyline" id="inputPStoryline" class="formInputList inputwords"><?=$default["storyline"]?></textarea>
                  <p>플롯</p>
                  <textarea name="summary" id="inputPsummary" class="formInputList inputwords"><?=$default["plot"]?></textarea>
                </div>
              </div>
            </div>

            <div class="submitBox">
              <div class="submitBoxBtns">
              <?php
                if(isset($_COOKIE["isCookie"])){
              ?>
                <input type="button" id="btnRecall" value="불러오기">
              <?php
                }
              ?>
                <input type="button" class="btnNext" value="다음">
              </div>
            </div>

          </div>
        </div>

        <div class="tabBox">
          <div class="wrapForm">

            <div class="formInputBox">
              <p class="inputNames">기업이름을 입력해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;기업이름을 입력해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <input type="text" id="inputEntName" class=" formInputList inputText" name="etpName" value="<?=$default["etpName"]?>">
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">기업을 소개해주세요.<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;어떤 기업인가요?</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <textarea name="etpDesc" id="inputEtpWords" class="formInputList inputwords"><?=$default["etpDesc"]?></textarea>
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">기업 정보를 입력해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;기업 정보를 입력해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">

                  <div class="inputImgBox">
                    <div class="singleInputImg">
                      <p>로고</p>
                      <img src="img/logo.png" id="previewLogo">
                      <div class="filebox">
                        <label for="inputLogoImg" name="thumnail">첨부파일 등록</label>
                        <input type="file" id="inputLogoImg" name="img_logo" accept="image/*">
                      </div>
                    </div>
                  </div>
                  <div class="singleInputImg">
                    <p>홈페이지</p>
                    <span>링크</span>
                    <input type="text" id="inputEtpLink" class="formInputList" name="etpURL" placeholder=" 링크를 입력해 주세요." value="<?=$default["etpLink"]?>">
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="formInputBox">
              <p class="inputNames">기업 가치를 설정해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;기업 가치가 얼마인가요?</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <input type="number" id="inputEntValue" class=" formInputList inputText" name="etpValue" placeholder=" 예) 30000000" value="<?=$default["etpValue"]?>"> &nbsp;원
                </div>
              </div>
            </div>
            
            <div class="formInputBox">
              <p class="inputNames">주당 가격을 설정해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;주당 가격을 설정해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <input type="number" id="inputEntJuPrice" class=" formInputList inputText" name="etpPerValue" placeholder=" 예) 10000" value="<?=$default["etpJuPrice"]?>"> &nbsp;원
                </div>
              </div>
            </div>
            
            <div class="formInputBox">
              <p class="inputNames">입금계좌를 입력해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;입금계좌를 입력해 주세요.</p>
              <div class="afterInputShow">
                <div class="wrapInput">
                  <select id="bankSelect" name="etpBank">
                    <option class="bankOption" value="">--은행선택--</option>
                    <option class="bankOption" value="국민은행">국민</option>
                    <option class="bankOption" value="우리은행">우리</option>
                    <option class="bankOption" value="신한은행">신한</option>
                    <option class="bankOption" value="하나은행">하나</option>
                    <option class="bankOption" value="기업은행">기업</option>
                    <option class="bankOption" value="농협은행">농협</option>
                    <option class="bankOption" value="SC제일은행">SC제일</option>
                    <option class="bankOption" value="수협은행">수협</option>
                    <option class="bankOption" value="KDB산업은행">KDB산업</option>
                    <option class="bankOption" value="씨티은행">씨티</option>
                    <option class="bankOption" value="카카오뱅크">카카오뱅크</option>
                  <select>
                  <input type="text" class="formInputList inputEtpAccount" onkeypress="inNumber();" name="etpAccount1" value="<?=$default["etpAccountNum"]?>">
                  <!-- -
                  <input type="text" class="formInputList inputEtpAccount" onkeypress="inNumber();" name="etpAccount2"> -->
                </div>
              </div>
            </div>
            
            <div class="formInputBox">
              <p class="inputNames">후원 리워드를 설정해 주세요!<span class="requireSpan">*</span></p>
              <p class="beforeInputShow">▶&nbsp;&nbsp;후원 리워드를 설정해 주세요.</p>
              <div class="afterInputShow">
                <div id="wrapReward" class="wrapInput">
                  <div class="rewardSet">
                    <input type="text" class=" formInputList inputText" placeholder=" 후원 금액_ex)30000" onkeypress="inNumber();" name="re_money[]"><br>
                    <input type="text" class=" formInputList inputText" placeholder=" 보상 단계_ex)1단계 보상 or PREMIUM" name="re_div[]"><br>
                    <input type="text" class=" formInputList inputText" placeholder=" 보상 타이틀_ex)Name in credits" name="re_content[]"><br>
                    <input type="text" class=" formInputList inputText" placeholder=" 보상 설명_ex) 엔딩 크레딧에 이름을 적어드립니다" name="re_descript[]"><br>
                  </div>
                  <input type="button" id="btnRewardAdd" value=" + ">
                </div>
              </div>
            </div>

            <div class="submitBox">
              <p class="p_chkBox">
                <input type="checkbox" id="chkTerm" value=""/>
                <span><a href="javascript:void(window.open('payTermsAgree.html', '_blank','width=525, height=635, top=80, left=500, location=no'))">결제약관</a> 동의하기</span>
              </p>
              <div class="submitBoxBtns">
                  <button type="button" id="btnTempSave">임시 저장</button>
                <?php
                  if(isset($_REQUEST["p_num"])){
                ?>
                  <button type="button" id="btnModify">프로젝트 수정하기</button>
                <?php
                  }else{
                ?>
                  <button type="button" id="btnSubmit">프로젝트 등록하기</button>
                <?php 
                }
                ?>
              </div>
            </div>

          </div>
        </div>

      </form>
    </section>
    

  </div>
</div>

  <!-- footer -->
  <div id="footer-container" class="containers">
    <div class="footer-contents">
      <div>
        <br>
        <p class="footer_logo"><b>FunWare</b></p>
        <p class="footer_leg">®FunWare. INC</p>
      </div><br><br>
      <div class="footer-contentBox">
        <div class="risk-notice">
          <p class="f_riskTitle"><b>투자위험고지</b></p>
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
  <script src="js/jquery/jquery-ui.min.js"></script>
  <script src="js/jquery/datepicker/datepicker.min.js"></script>
  <script src="js/jquery/datepicker/datepicker.ko.js"></script>
  <script src="js/bootstrap/bootstrap.js"></script>
  <script src="js/channelTalk.js"></script>
  <script type="text/javascript" src="js/jquery/jquery-cookie.js"></script>
  <script src="js/burger.js"></script>
  <script>
    $(function(){
      // 임시저장
      // console.log($.cookie('isCookie'));
      if($.cookie('isCookie') === 'false'){ 
        $("#btnRecall").css({"width" : "0", "height" : "0"});
      }

      // fadeIn
      $("#testWrapper").fadeIn(500, function () {
          $(this).animate({
            "opacity": "1"
          },700);
      });

      if(isPNum == true){
        $(".afterInputShow").slideDown();
        $('.beforeInputShow').slideUp();
        // $('#btnSubmit').css({"width" : "none"}); // 등록하기 버튼 숨기기
        // $('#btnModify').css({"display" : "block"}); // 수정 버튼 나타내기
        
        // $('#ctgSelect').val('<=$row_category["sys_category_id"]?>').prop("selected",true);
        // $('#bankSelect').val('<=$row_project["f_cardbank"]?>').prop("selected",true);

        if('<?=$default["etpBank"]?>' !== ""){
          $('#ctgSelect').val(currentCate).prop("selected",true);
          $('#bankSelect').val(currentBank).prop("selected",true);
        }
      }

      
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

    
    // tab menu
    $(document).ready(function(){
        $(".tabArea .tab li").on("click", function(){
          // 해당 요소를 클릭하는 내 자신의 index 번호를 가져온다. [0], [1]
          const num = $(".tabArea .tab li").index($(this));
          if(num == 0){
            // console.log("num : " + num);
            
            // 기존에 적용되어 있는 on class 삭제
            $(".tabArea .tab li").removeClass("on");
            $(".tabArea .tabBox").removeClass("on");
            // 다음 요소 클릭시 on class 추가
            $('.tabArea .tab li:eq(' + num + ')').addClass("on");
            $('.tabArea .tabBox:eq(' + num + ')').addClass("on");
            // chang checkImg
            $('.tabArea .tab li:eq(' + num + ') img').attr("src", "img/funware_checked.png");
            $('.tabArea .tab li:eq(' + (num+1) + ') img').attr("src", "img/funware_check.png");
            
            // $('.tabArea .tab li:eq(' + num + ')').addClass("on");
          }else{
            // console.log("num : " + num);
            if($('#inputPName').val() == ""){
              alert("프로젝트명을 기입해주세요.");
            }else if(!($('#inputTargetMoney').val() > 0)){
              alert("목표금액이 얼마인가요?");
            }else if(inputImgs[0].files.length == 0 || inputImgs[1].files.length == 0){
              alert("프로젝트 관련 이미지를 등록해주세요.");
            }else if($("#datepicker").val() == ""){
              alert("프로젝트 마감 기한을 확인해주세요.");
            }else if($("#inputPStoryline").val().trim() == "" || $("#inputPsummary").val().trim() == ""){
              alert("프로젝트 설명란은 비울 수 없습니다.");
            }else{
              // $("#newProjectForm").submit();
                // 기존에 적용되어 있는 on class 삭제
              $(".tabArea .tab li").removeClass("on");
              $(".tabArea .tabBox").removeClass("on");
              // 다음 요소 클릭시 on class 추가
              $('.tabArea .tab li:eq(' + num + ')').addClass("on");
              $('.tabArea .tabBox:eq(' + num + ')').addClass("on");
              // chang checkImg
              $('.tabArea .tab li:eq(' + num + ') img').attr("src", "img/funware_checked.png");
              $('.tabArea .tab li:eq(' + (num-1) + ') img').attr("src", "img/funware_check.png");
            }
            
          }
        });
    });
      
    // 프로젝트 폼
      document.querySelectorAll('.formInputBox')[0].style.border="none";
      document.querySelectorAll('.formInputBox')[7].style.border="none";
      $(".ctgOption:first").attr("selected", "selected");

      // 폼 다운
      $(function(){
          $('.beforeInputShow').click(function(){
              $(this).next().slideDown();
              $(this).slideUp();
          });
      });
      // function formUp(){ // 함수화
      //   let afterInputShow = $(this).closest('div').parent();
      //   afterInputShow.slideUp();
      //   afterInputShow.prev().slideDown();
      // }

      // 프로젝트 이름
      $(function(){
          $('#inputPName').focusout(function() {
              let pName = $('#inputPName').val();
              let afterInputShow = $(this).closest('div').parent();

              if(pName.trim() != ""){
                afterInputShow.prev().text('▶ ' + pName);
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }

              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
              // formUp();
          });
      });
      // 카테고리
      $(function(){
          $('#ctgSelect').change(function(){
              let pCtg = $("#ctgSelect option:selected").html();
              let afterInputShow = $(this).closest('div').parent();

              afterInputShow.prev().text('▶ ' + pCtg);
              afterInputShow.prev().css({"color" : "var(--mainColor)"});
              
              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
          });
      });

      // 목표금액 
      $(function(){
          $('#inputTargetMoney').focusout(function() {
              let rargetMoney = $('#inputTargetMoney').val();
              let afterInputShow = $(this).closest('div').parent();

              if(rargetMoney.trim() != ""){
                afterInputShow.prev().text('▶ ' + rargetMoney + ' 원');
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }

              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
              // formUp();
          });
      });

      // IR
      $(document).on("change", ".file-input", function(){
        $filename = $(this).val();
        if($filename == "")
          $filename = "파일을 선택해주세요.";
        $(".filename").text($filename);
        $(".filename").css('color', 'var(--mainColor)');

        let afterInputShow = $(this).closest('div').parent().parent();
        if($filename!= ""){
            afterInputShow.prev().text('▶ ' + $filename);
            afterInputShow.prev().css({"color" : "var(--mainColor)"});
        }
        afterInputShow.slideUp();
        afterInputShow.prev().slideDown();
      });



      // 프로젝트 이미지 __ 미리보기
      const inputImgs = document.querySelectorAll(".inputImgs");
      const previewImage = document.querySelectorAll(".previewImage");

      for(let i=0; i<inputImgs.length; i++){
        let inputSth = inputImgs[i];
        inputSth.addEventListener("change", e => {
            // readImage(e.target) // 함수화
            if(e.target.files && e.target.files[0]) {
              // FileReader 인스턴스 생성
              let reader = new FileReader();
              // 이미지가 로드가 된 경우
              reader.onload = e => {
                  let previewSth = previewImage[i];
                  previewSth.src = e.target.result;
            }
            // reader가 이미지 읽도록 하기
            reader.readAsDataURL(e.target.files[0])
          }  
          // console.log(inputImgs[0].files.length);
        })
      }

      let inputLogo = document.getElementById("inputLogoImg");
      let prefiewLogo = document.getElementById("previewLogo");
      inputLogo.addEventListener("change", e => {
            // readImage(e.target) // 함수화
            if(e.target.files && e.target.files[0]) {
              // FileReader 인스턴스 생성
              let logoReader = new FileReader();
              // 이미지가 로드가 된 경우
              logoReader.onload = e => {
                  prefiewLogo.src = e.target.result;
            }
            // reader가 이미지 읽도록 하기
            logoReader.readAsDataURL(e.target.files[0])
          }  
          // console.log(inputImgs[0].files.length);
        })

      // 프로젝트 이미지__ 폼 업
      $(function(){
        $('#inputTrailerLink').focusout(function() {
          if(inputImgs[0].files.length != 0 && inputImgs[1].files.length != 0 && $(this).val().trim() != ""){
              
              let afterInputShow = $(this).closest('div').parent();
              afterInputShow.prev().text('▶ 이미지가 등록되었습니다.');
              afterInputShow.prev().css({"color" : "var(--mainColor)"});
              
              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
          }
        });
      });


      // 프로젝트 기간
      datePickerSet($("#datepicker")); //다중은 시작하는 달력 먼저, 끝달력 2번째
      /*
      * 달력 생성기
      * @param sDate 파라미터만 넣으면 1개짜리 달력 생성
      * @example datePickerSet($("#datepicker"));
      *
      *
      * @param sDate,
      * @param eDate 2개 넣으면 연결달력 생성되어 서로의 날짜를 넘어가지 않음
      * @example datePickerSet($("#datepicker1"), $("#datepicker2"));
      */
      function datePickerSet(sDate, eDate, flag) {
      //시작 ~ 종료 2개 짜리 달력 datepicker
      if (!isValidStr(sDate) && !isValidStr(eDate) && sDate.length > 0 && eDate.length > 0) {
          var sDay = sDate.val();
          var eDay = eDate.val();
          if (flag && !isValidStr(sDay) && !isValidStr(eDay)) { //처음 입력 날짜 설정, update...
              var sdp = sDate.datepicker().data("datepicker");
              sdp.selectDate(new Date(sDay.replace(/-/g, "/"))); //익스에서는 그냥 new Date하면 -을 인식못함 replace필요
              var edp = eDate.datepicker().data("datepicker");
              edp.selectDate(new Date(eDay.replace(/-/g, "/"))); //익스에서는 그냥 new Date하면 -을 인식못함 replace필요
          }
          //시작일자 세팅하기 날짜가 없는경우엔 제한을 걸지 않음
          if (!isValidStr(eDay)) {
              sDate.datepicker({
                  maxDate: new Date(eDay.replace(/-/g, "/"))
              });
          }
          sDate.datepicker({
              language: 'ko',
              autoClose: true,
              onSelect: function () {
                  datePickerSet(sDate, eDate);
              }
          });
          //종료일자 세팅하기 날짜가 없는경우엔 제한을 걸지 않음
          if (!isValidStr(sDay)) {
              eDate.datepicker({
                  minDate: new Date(sDay.replace(/-/g, "/"))
              });
          }
          eDate.datepicker({
              language: 'ko',
              autoClose: true,
              onSelect: function () {
                  datePickerSet(sDate, eDate);
              }
          });
          //한개짜리 달력 datepicker
          } else if (!isValidStr(sDate)) {
              var sDay = sDate.val();
              if (flag && !isValidStr(sDay)) { //처음 입력 날짜 설정, update...
                  var sdp = sDate.datepicker().data("datepicker");
                  sdp.selectDate(new Date(sDay.replace(/-/g, "/"))); //익스에서는 그냥 new Date하면 -을 인식못함 replace필요
              }
              sDate.datepicker({
                  language: 'ko',
                  autoClose: true,
                  onSelect: function (a) {
                    //  console.log(a);
                     let afterInputShow = $('#datepicker').closest('div').parent();   
                     if(a != null){
                       afterInputShow.prev().text('▶ ' + a);
                       afterInputShow.prev().css({"color" : "var(--mainColor)"});
                     }   
                     afterInputShow.slideUp();
                     afterInputShow.prev().slideDown();
                  }
              });
          }
          function isValidStr(str) {
          if (str == null || str == undefined || str == "")
              return true;
          else
              return false;
          }
      }
   

      // 프로젝트 설명
      $(function(){
          $('#inputPsummary').focusout(function(){
              let explain = $("#inputPStoryline").val();
              let afterInputShow = $(this).closest('div').parent();

              if($("#inputPStoryline").val().trim() != "" && $("#inputPsummary").val().trim() != ""){
                afterInputShow.prev().text('▶ 흥미로운 프로젝트군요!');
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }else{
                afterInputShow.prev().text('▶ 입력란을 확인해주세요.');
                afterInputShow.prev().css({"color" : "#fa6462"});
              }
              
              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
          });
      });

      // 다음 버튼
      $(".btnNext").click(function() {
        if($('#inputPName').val() == ""){
              alert("프로젝트명을 기입해주세요.");
            }else if(!($('#inputTargetMoney').val() > 0)){
              alert("목표금액이 얼마인가요?");
            }else if(inputImgs[0].files.length == 0 || inputImgs[1].files.length == 0){
              alert("프로젝트 관련 이미지를 등록해주세요.");
            }else if($("#datepicker").val() == ""){
              alert("프로젝트 마감 기한을 확인해주세요.");
            }else if($("#inputPStoryline").val().trim() == "" || $("#inputPsummary").val().trim() == ""){
              alert("프로젝트 설명란은 비울 수 없습니다.");
            }else{
              window.scrollTo(0,0);
              const tab = document.querySelectorAll('.tabList');
              const tabImg = document.querySelectorAll('.tabArea ul img');
              const tabBox = document.querySelectorAll('.tabBox');
              
              $(tab[0]).removeClass("on");
              $(tabBox[0]).removeClass("on");

              $(tab[1]).addClass("on");
              $(tabBox[1]).addClass("on");

              $(tabImg[0]).attr("src", "img/funware_check.png");
              $(tabImg[1]).attr("src", "img/funware_checked.png");
            }
        

      });

      // 기업 이름
      $(function(){
          $('#inputEntName').focusout(function() {
              let entName = $('#inputEntName').val();
              let afterInputShow = $(this).closest('div').parent();

              if(entName.trim() != ""){
                afterInputShow.prev().text('▶ ' + entName);
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }

              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
              // formUp();
          });
      });

      // 기업 설명
      $(function(){
          $('#inputEtpWords').focusout(function(){
              let explain = $("#inputEtpWords").val();
              let afterInputShow = $(this).closest('div').parent();

              if($("#inputEtpWords").val().trim() != ""){
                afterInputShow.prev().text('▶ 멋진 기업이네요.');
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }else{
                afterInputShow.prev().text('▶ 입력란을 확인해주세요.');
                afterInputShow.prev().css({"color" : "#fa6462"});
              }
              
              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
          });
      });

       // 기업설명 __ 폼 업
       $(function(){
        $('#inputEtpLink').focusout(function() {
          if(inputLogoImg.files.length != 0  && $(this).val().trim() != ""){
              
              let afterInputShow = $(this).closest('div').parent().parent();
              
              afterInputShow.prev().text('▶ 기업 정보가 입력되었습니다.');
              afterInputShow.prev().css({"color" : "var(--mainColor)"});
              
              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
          }
        });
      });

      // 기업 가치
      $(function(){
          $('#inputEntValue').focusout(function() {
              let entValue = $('#inputEntValue').val();
              let afterInputShow = $(this).closest('div').parent();

              if(entValue.trim() != ""){
                afterInputShow.prev().text('▶ ' + entValue + ' 원');
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }

              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
              // formUp();
          });
      });

      // 주당 가격
      $(function(){
          $('#inputEntJuPrice').focusout(function() {
              let entJuPrice = $('#inputEntJuPrice').val();
              let afterInputShow = $(this).closest('div').parent();

              if(entJuPrice.trim() != ""){
                afterInputShow.prev().text('▶ ' + entJuPrice + ' 원');
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }

              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
              // formUp();
          });
      });

      // 입금 계좌
      function inNumber(){ // 숫자만 입력
          if(event.keyCode<48 || event.keyCode>57){
             event.returnValue=false;
          }
      }
      $(function(){
          $('.inputEtpAccount:nth-child(2)').focusout(function() {
              let entAccount = $('#bankSelect option:selected').val() + " " +  $('.inputEtpAccount:nth-child(2)').val();
              let afterInputShow = $(this).closest('div').parent();

              if(entAccount != " - "){
                afterInputShow.prev().text('▶ ' + entAccount);
                afterInputShow.prev().css({"color" : "var(--mainColor)"});
              }

              afterInputShow.slideUp();
              afterInputShow.prev().slideDown();
              // formUp();
          });
      });

      // 후원 리워드
      const btnRewardAdd = document.getElementById("btnRewardAdd");
      const wrapReward = document.getElementById("wrapReward");
      btnRewardAdd.addEventListener('click', function(){
          const newDiv = document.createElement('div');
          newDiv.innerHTML = "<br><input type='text' class='inputText' placeholder=' 후원 금액' onkeypress='inNumber();' name='re_money[]'><br>";
          newDiv.innerHTML += "<input type='text' class=' formInputList inputText' placeholder=' div' name='re_div[]'><br>";
          newDiv.innerHTML += "<input type='text' class=' formInputList inputText' placeholder=' content' name='re_content[]'><br>";
          newDiv.innerHTML += "<input type='text' class=' formInputList inputText' placeholder=' descript' name='re_descript[]'><br>";
          btnRewardAdd.before(newDiv);
          $(newDiv).addClass("rewardSet");
      });

      let rewardInputs = document.querySelectorAll("#wrapReward input[type=text]");
      let parentWrapReward = $(wrapReward).parent();
      parentWrapReward.click(function() { // 트리거 설정..?
        for(let i=0; i<rewardInputs.length; i++){
          // console.log(rewardInputs[i]);
        }
      });

      // 임시저장 btnTempSave
      let date = new Date();
      date.setTime(date.getTime() + 120*60*1000); // 2 hours
      const inputNames = ['pName', 'donateLimit', 'dateLimit', 'storyline', 'summary', 'etpBank', 'etpAccount1', 
                          'etpPerValue', 'pCategory', 'trailer', 'etpName', 'etpDesc', 'etpURL', 'etpValue']; 
      const inputArray = [$("#inputPName"), $("#inputTargetMoney"), $("#datepicker"), $("#inputPStoryline"), $("#inputPsummary"), $("#bankSelect"), $('.inputEtpAccount:nth-child(2)'), 
                          $("#inputEntJuPrice"), $("#ctgSelect"), $("#inputTrailerLink"), $("#inputEntName"), $("#inputEtpWords"), $("#inputEtpLink"), $("#inputEntValue")]; 
                          
      function make_cookie(name, val) {
        $.cookie(name, val.val(), { expires: date, path : '/' });
      }
      function delete_cookie(name) {
        $.cookie(name, null, {expires : 0, path:'/'});
      }

      // btnTempSave 클릭이벤트
      $("#btnTempSave").click(function() { 
        for (let i = 0; i < inputNames.length; i++) {
          // 기존 쿠키 삭제
          delete_cookie(inputNames[i]);
          // 쿠키 생성
          make_cookie(inputNames[i], inputArray[i]);
        }
        
        $.cookie('isCookie', true, { expires: date, path : '/' });
        alert("파일과 리워드를 제외한 모든 input이 임시저장되었습니다.");
      });

      // 불러오기 btnRecall
      $("#btnRecall").click(function() {
        console.log("불러왔옹");
        for (let i = 0; i < inputNames.length; i++) {
          inputArray[i].val($.cookie(inputNames[i]));
        }
      });

      // 등록하기 btnSubmit
      $("#btnSubmit").click(function() {
        const inputIR = document.getElementsByName("projectIR")[0];
        const inputLogo = document.getElementById("inputLogoImg");
        const rewardInputMoney = document.getElementsByName("re_money[]")[0];
        const rewardInputDiv = document.getElementsByName("re_div[]")[0];
        const rewardInputContent = document.getElementsByName("re_content[]")[0];
        const rewardInputDescript = document.getElementsByName("re_descript[]")[0];

        if($('#inputPName').val() == ""){
          alert("프로젝트명을 기입해주세요.");
        }else if(!($('#inputTargetMoney').val() > 0)){
          alert("목표금액이 얼마인가요?");
        }else if(inputImgs[0].files.length == 0 || inputImgs[1].files.length == 0){
          alert("프로젝트 관련 이미지를 등록해주세요.");
        }else if($("#datepicker").val() == ""){
          alert("프로젝트 마감 기한을 확인해주세요.");
        }else if($("#inputPStoryline").val().trim() == "" || $("#inputPsummary").val().trim() == ""){
          alert("프로젝트 설명란은 비울 수 없습니다.");
        }else if($('#inputEntName').val().trim() == ""){
          alert("기업 이름을 입력해주세요.");
        }else if($("#inputEtpWords").val().trim() == ""){
          alert("기업을 소개란을 작성해주세요.");
        }else if(inputLogo.files.length == 0){
          alert("기업 로고가 누락되었습니다.");
        }else if(!($('#inputEntValue').val() > 0)){
          alert("기업 가치를 입력하셔야 합니다.");
        }else if(!($('#inputEntJuPrice').val() > 0)){
          alert("기업의 주당가격을 입력하셔야 합니다.");
        }else if($('#bankSelect option:selected').val() == "" || $('.inputEtpAccount:nth-child(2)').val() == ""){
          alert("펀딩 금액 모금 계좌를 확인해주세요.");
        }else if(rewardInputMoney.value == "" || rewardInputDiv.value == "" || rewardInputContent.value == "" || rewardInputDescript.value == ""){
          alert("최소 한 개 이상의 리워드를 등록하셔야 합니다.");
        }else if($("#chkTerm").is(":checked") == false){
          alert("결제약관에 동의하셔야 합니다.");
        }else{
          $("#newProjectForm").submit();
        }
      });

      // 수정하기 btnModify
      $("#btnModify").click(function() {
        const inputIR = document.getElementsByName("projectIR")[0];
        const inputLogo = document.getElementById("inputLogoImg");
        const rewardInputMoney = document.getElementsByName("re_money[]")[0];
        const rewardInputDiv = document.getElementsByName("re_div[]")[0];
        const rewardInputContent = document.getElementsByName("re_content[]")[0];
        const rewardInputDescript = document.getElementsByName("re_descript[]")[0];

        if($('#inputPName').val() == ""){
          alert("프로젝트명을 기입해주세요.");
        }else if(!($('#inputTargetMoney').val() > 0)){
          alert("목표금액이 얼마인가요?");
        }else if(inputImgs[0].files.length == 0 || inputImgs[1].files.length == 0 || 
                 inputImgs[2].files.length == 0 || inputImgs[3].files.length == 0){
          alert("프로젝트 관련 이미지를 등록해주세요.");
        }else if($("#datepicker").val() == ""){
          alert("프로젝트 마감 기한을 확인해주세요.");
        }else if($("#inputPStoryline").val().trim() == "" || $("#inputPsummary").val().trim() == ""){
          alert("프로젝트 설명란은 비울 수 없습니다.");
        }else if($('#inputEntName').val().trim() == ""){
          alert("기업 이름을 입력해주세요.");
        }else if($("#inputEtpWords").val().trim() == ""){
          alert("기업을 소개란을 작성해주세요.");
        }else if(inputLogo.files.length == 0){
          alert("기업 로고가 누락되었습니다.");
        }else if(!($('#inputEntValue').val() > 0)){
          alert("기업 가치를 입력하셔야 합니다.");
        }else if(!($('#inputEntJuPrice').val() > 0)){
          alert("기업의 주당가격을 입력하셔야 합니다.");
        }else if($('#bankSelect option:selected').val() == "" || $('.inputEtpAccount:nth-child(2)').val() == ""){
          alert("펀딩 금액 모금 계좌를 확인해주세요.");
        }else if(rewardInputMoney.value == "" || rewardInputDiv.value == "" || rewardInputContent.value == "" || rewardInputDescript.value == ""){
          alert("최소 한 개 이상의 리워드를 등록하셔야 합니다.");
        }else if($("#chkTerm").is(":checked") == false){
          alert("결제약관에 동의하셔야 합니다.");
        }else{
          $("#newProjectForm").submit();
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
