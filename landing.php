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
      #more-nav-container{
        background: #f8f9fa;
      }

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
        width: 100%;
        margin: 0 auto;
        margin-bottom: 10%;
        display: block;
        margin-top: 15%;
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
        padding: 0;
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
        height: 50vw;
        width: 85%;
        margin: 0 auto;
        background-image: url('img/banner_index.png');
        border-radius: 4px;
        padding: 4.5% 5%;
        
        
      }
      #b_left{
        
        height: 100%;
        color: #fff;
      }
      #b_left p{
        font-size: 3.5vw;
        
        letter-spacing: -1.95px;
        margin-bottom: 6px;
      }
      #b_left span{font-size: 2.25vw; letter-spacing: -0.6px;}
      #b_right{
        text-align: end;
        
        color: #fff;
      }
      #b_right p{
        font-size: 3.5vw;
        
        letter-spacing: -1.95px;
        margin-bottom: 6px;
      }
      #b_right span{font-size: 2.25vw; letter-spacing: -0.6px;}

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
      }
      /** */

      .randing_img {
          position: relative;
          width: 100%;
          
          height: auto;
      }
      .img_text{
        position: relative;
        width: 100%;
        margin-top: -35%;
        text-align: center;
        font-size: 4vw;
      }
      .img_text p{
        width: 50%;
        height: 100%;
        color: #fff;
        margin: 0 auto;
        
        font-weight: bold;
      }
      .img_text_sub{
        position: relative;
        width: 100%;
        text-align: center;
        font-size: 1.5vw;
      }
      .img_text_sub p{
        width: 50%;
        height: 100%;
        color: #fff;
        margin: 0 auto;
        padding: 3%;
      }
      .img_text_button{
        position: relative;
        width: 100%;
        text-align: center;
        font-size: 1.5vw;
      }
      .img_text_button button{
        width: 15%;
        
      }
      .img_btn{
        margin-right: 4%;
      }
      .gagahi{
        width: 100%;
        margin: 0 auto;
        margin-bottom: 10%;
        display: block;
        margin-top: 15%;
      }
      .gagahi p{
        text-align: center;
        font-size: 4vw;
        font-weight: bold;
      }
      .gagahi>.box_mom{
        display: flex;
        justify-content: center;
      }
      .gagahi_box{
        width: 25%;
        height: 35vw;
        background-color: white;
        margin: 2%;
      }
      .gagahi_box>.material-icons{
        font-size: 8vw;
        display: flex;
        justify-content: center;
        margin-top: 30%;
        margin-bottom: 15%;
      }
      .gagahi_box>div>.gagahi_p{
        font-size: 3vw;
        margin-bottom: 10%;
      }
      .gagahi_box>div>p{
        font-size: 1.5vw;
      }
      .geseng{
        width: 100%;
        margin: 0 auto;
        margin-bottom: 10%;
        display: block;
        margin-top: 15%;
      }
      .geseng>.geseng_box{
        display: flex;
        justify-content: center;
      }
      .geseng>.geseng_box>.geseng_img{
        width: 35%;
        height: 35vw;
      }
      .geseng_left{
        position: relative;
        width: 45%;
      }
      .geseng_img>img{
        width: 100%;
       
      }
      .geseng_img2{
        width: 35%;
        height: 35vw;
      }
      .geseng_img2 img{
        width: 100%;
      
      }
      .geseng2_left{
        width: 50%;
        text-align: end;
        position: relative;
      }
      .geseng_p{
        font-size: 4vw;
        font-weight: bold;
      }
      .geseng_span{
        font-size: 2vw;
      }
      .geseng_idea{
        position: absolute;
        transform: rotate(-45deg);
        font-size: 10vw;
        left: 40%;
      }
      .geseng2_idea{
        position: absolute;
        transform: rotate(45deg);
        font-size: 10vw;
        left: 20%;
        top:45%
      }
      .geseng_btn{
        margin-top:10%;
        margin-left:2%;
        width: 30%;
        height: 4vw;
        font-size:1.5vw;
      }
      
      .footer-contentBox{
        width: 100%;
      }
    </style>
    <link rel="stylesheet" href="css/jun_media/randing.css">

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
                      <li><a class="dropdown-item" href="helpCenter.html">Help center</a></li>
                      <li><a class="dropdown-item" href="admin/">Admin Console</a></li>
                    </ul>
                  </li>
                </div>
               
              </div>
            </div>
          </nav>
        </div>
        <div id="topMenu">
      <ul>
      <a class="topMenuItems" href="index.php"><li>프로젝트 둘러보기</li></a>
        <a class="topMenuItems" href="newProject.php"><li>프로젝트 만들기</li></a>
        <a class="topMenuItems isLoggedIn" href="login.php"><li>로그인</li></a>
        <a class="topMenuItems isLoggedIn" href="join.php"><li>회원가입</li></a>
        <a class="topMenuItems isLoggedOut" href="logout.php"><li>로그아웃</li></a>
        <a class="topMenuItems" href="notice.php"><li>공지사항</li></a>
      </ul>
    </div>
      </div>
      
      <div id="testWrapper">
      <!-- carousel -->
        <div class="randing">
          <img src="img/landing.png" alt="landing_img" class="randing_img">
          <div class="img_text">
            <p>상상 속의 게임<br>Funware에서 현실로</p>
          </div>
          <div class="img_text_sub">
            <p>크라우드펀딩으로 프로젝트 자금도 모으고<br>든든한 후원자 네트워크도 확보할 수 있습니다.</p>
          </div>
          <div class="img_text_button">
          
          <?php
            if($user_login && isset($_SESSION["userId"])){
          ?>
              <button type="button" class="btn btn-outline-light img_btn" onclick="location.href='index.php'">둘러보기</button>
              <button type="button" class="btn btn-outline-light" onclick="location.href='newProject.php'">지금 등록하기</button>
          <?
            }else{
          ?>
              <button type="button" class="btn btn-outline-light img_btn" onclick="location.href='login.php'">로그인</button>           
              <button type="button" class="btn btn-outline-light" onclick="location.href='join.php'">회원가입</button>          
          <?
            }
          ?>
            <!-- <button type="button" class="btn btn-outline-light img_btn" onclick="location.href='index.php'">지금 시작하기</button>
            <button type="button" class="btn btn-outline-light" onclick="location.href='login.php'">회원가입</button>            -->



          
          </div>
        </div>

      <div class="gagahi">
        <p>FunWare는 여러분들의 가까이에 있어요!</p>
        <div class="box_mom">
          <div class="gagahi_box">
            <span class="material-icons">
              alarm
            </span>
            <div>
              <p class="gagahi_p">언제든</p>
            </div>
            <div>
              <p>Funware는<br>시간을 신경쓰지 않아요</p>
            </div>
          </div>
          <div class="gagahi_box">
            <span class="material-icons">
            train
            </span>
            <div>
              <p class="gagahi_p">어디서든</p>
            </div>
            <div>
              <p>Funware는<br>장소를 신경쓰지 않아요</p>
            </div>
          </div>
          <div class="gagahi_box">
            <span class="material-icons">
            phone_iphone
            </span>
            <div>
              <p class="gagahi_p">무엇이든</p>
            </div>
            <div>
              <p>Funware는<br>무엇이든 신경쓰지 않아요</p>
            </div>
          </div>
        </div>

      </div>
      <div class="geseng">
        <div class="geseng_box">
          <div class="geseng_left">
            <p class="geseng_p">
              그 생각 좋아요!
            </p>
            <span class="geseng_span">
              버튼 하나면 펀딩이 가능합니다!
              <br>
              좋은 아이디어에 펀딩해보세요!<br>
              <br>새롭게 올라오는 프로젝트들을 만나봐요!
            </span>
            <button class="nav-btnProject geseng_btn" onclick = "location.href='index.php'">펀딩하기</button>
          </div>
          <span class="material-icons geseng_idea">
              emoji_objects
              </span>
          <div class="geseng_img">
            <img src="/img/opacityBox1.png" alt="">
          </div>             
        </div> 
      </div>
      <div class="geseng">
        <div class="geseng_box">
          
          <div class="geseng_img2">
            <img src="/img/opacityBox2.png" alt="">
          </div>
          <div class="geseng2_left">
          <span class="material-icons geseng2_idea">
              upload_file
              </span>  
            <p class="geseng_p">
              저의 아이디어를 올려볼래요!
            </p>
            <span class="geseng_span">
              간단한 정보 작성 후
              <br>
              자신의 아이디어를 공유할 수 있어요!<br>
              <br>자신의 아이디어를 올려봐요
            </span><br>
            <button class="nav-btnProject geseng_btn" onclick = "location.href='newProject.php'">등록하기</button>
          </div>
                    
        </div> 
      </div>
      <!-- main -->
      <div id="main-container" class="containers">
        
        <div id="jun_main">
          <div id="funwareBanner" class="main-content">
            <div id="b_left">
              <p>Funware에서 펀딩에 성공한<br>18,000개의 프로젝트와 함께 하세요.</p>
              <span>Adventure,Casual,FPS,RPG,Simulation,Strategy<br>
                    분야를 가릴 것 없이 수많은 창작자와 창업자들의 프로젝트들이<br>
                    매일같이 올라오는 Funware은 한국에서 가장 활발한 크라우드<br>
                    펀딩 사이트가 될게요
            </span>
              <div id="b_right">
                <p>어디든! 언제든!<br>당신의 생각을 공유하고 올려보세요!</p>
                  <span>Funware에 접속하는 순간 당신이 생각하는<br>
                  모든걸 진행 할 수 있어요!
                </span>
              </div>
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
    <script>
      
      // window.addEventListener('resize', function(){
      //   x = 450 - window.innerWidth;
      //   console.log(window.innerWidth);
      //   $(".randing_img").css({
      //     "top":x
      //   });
      // });
    
      $(function () {
        $("#testWrapper").fadeIn(500, function () {
            $(this).animate({
              "opacity": "1"
            },700);
        });
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
      

        const currentSlideNum = document.querySelector(".currentSlideNum");
        const slider = document.querySelector("#slider");
        const slider_item = document.querySelectorAll(".slider_item");
        const slider_title = document.querySelectorAll(".title_item");
        const slider_explain = document.querySelectorAll(".explain_item");
        const slideLen = slider_item.length;
        var a = document.getElementById("testWrapper");
        var slideWidth = 1280;
        window.onload = function(){
          if(a.offsetWidth< 768){
            slideWidth = 718
          }else{
            slideWidth = 1280;
          }
          console.log(a.offsetWidth );
        }
        

        
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
