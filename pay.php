<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';
  $ini = parse_ini_file('config.ini');

  if(!$user_login) {
    echo "<script>";
    echo    "alert('로그인이 필요한 서비스입니다.');";
    echo    "location.href='login.php';";
    echo "</script>";
  }
  $p_num = $_REQUEST["p_num"];
  // $p_num = 56;

  // if(isset($_REQUEST["success"])){
  //   $success = $_REQUEST["success"];
  // }else{
  //   $success = false;
  // }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7637a8f104.js" crossorigin="anonymous"></script>

    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery/jquery-ui.css">
    <link rel="stylesheet" href="css/jquery/datepicker/datepicker.min.css">
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <link rel="stylesheet" href="css/funware_src/cards.css">
    <link rel="stylesheet" href="css/funware_src/footer.css">
    <script src="https://js.tosspayments.com/v1"></script>
    <script>
        // Toss객체 초기화
        var clientKey = '<?=$ini["tossPayments_cli_key"]?>';
        var tossPayments = TossPayments(clientKey);
    </script>

    <title>펀웨어 - 결제</title>

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
        background: #f2f3f7;
      }

      *{
        font-family: 'Spoqa Han Sans Neo', 'sans-serif';
        /* margin: 0;
        padding: 0; */
      }
      li {list-style: none;}
      /* a {text-decoration: none;} */

      #wrap-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
      }

      #payFormBox{
        width: var(--width);
        /* height: 2868px; */
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(156deg, #e8ebf2, #f6f2f7);
        margin: 0 auto;
        margin-top: 84px;
        margin-bottom: 120px;
        padding: 60px 130px;
        display: flex;
        flex-direction: column;
        align-content: center
      }
      .explains{
        width: auto;
        margin: 0 auto;
        color: #464646;
        font-size: 1.125rem;
        letter-spacing: -0.36px;
        font-weight: 500;
        margin-bottom: 30px;
      }
      .explains2{
        width: auto;
        margin: 0 auto;
        color: #464646;
        font-size: 1.125rem;
        letter-spacing: -0.36px;
        font-weight: 500;
        margin-bottom: 30px;
      }
      .explains > div{
        display: inline;
      }
      .SpanExplains{
        color: #212121;
        font-size: 1.375rem;
        font-weight: bold;
        letter-spacing: 0.77px;
        margin-right: 22px;
      }
      #wrapRewards{
        /* background-color: gray; */
        width: 965px;
        margin: 0 auto;
        margin-bottom: 30px;
        display: grid;
        grid-template-columns: repeat(2, minmax(400px, auto));
        justify-items: center;
        align-items: center;
        row-gap: 34px;
      }
      .rewardBox{
        position: relative;
        width: 400px;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(113deg, #e8ebf2, #f2f3f7 100%);
        color: #464646;
        padding: 20px 40px 15px 40px;
        cursor: pointer;
      }
      .rewardBox p{
        margin-bottom: 10px;
      }
      .hiddenInput{
        display: none;
      }
      .rewardName{
        font-size: 1.375rem;
        font-weight: bold;
        letter-spacing: -0.88px;
      }
      .reward{
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.8px;
      }
      .rewardContent{
        font-size: 1rem;
        letter-spacing: -0.64px;
      }
      .rewardNum{
        font-size: 1.125rem;
      }
      .rewardChkImg{
        position: absolute;
        width: 34px;
        height: 34px;
        right: 30px;
        bottom: 25px;
        display: none;
      }
      #payFormBox a{
        color: var(--mainColor);
        margin-bottom: 30px;
      }
      .inputStyle{
        /* all: unset; */
        border: none;
        border-radius: 5px;
        background: #e4e8ef;
        /* background:var(--gray0); */
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
      }
      #inputMore{
        width: 189.5px;
        height: 48.3px;
        text-align: right;
        padding: 0 40px 0 0;
      }

      .i_tipBox{
        position: relative;
        /* display: inline; */
      }

      .i_tipBox:hover #i_tip{
        transition: 0.1s ease;
        opacity: 1;
      }

      #i_tip{
        position: absolute;
        top: 30px;
        right: 0px;
        font-size: 0.938rem;
        text-align: center;
        width: 0 auto;
        height: auto;
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        transition: 0.1s ease;
        opacity: 0;
      }

      #imgInfo{
        width: 20px;
        height: 20px;
      }

      #imgInfo:hover{
        cursor: help;
      }

      #fundValue1{
        color: var(--mainColor);
        text-decoration: underline;
      }

      #btnShowInfo{
        width: 200px;
        height: 60px;
        border: none;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(156deg, #e8ebf2, #f6f2f7);
        margin: 0 auto;
        margin-bottom: 30px;
      }

      #wrapHideBox{
        display: none;
      }

      #hideBox{
        /* display: none; */
        display: flex;
        flex-direction: column;
        width: 100%;
      }

      #payAmountBox{
        width: 100%;
        margin-bottom: 100px;
        padding: 30px 40px 15px 40px;
        color: #949494;
        font-size: 1.125rem;
        font-weight: 500;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(103deg, #e8ebf2, #f2f3f7 100%);
      }

      #payAmountBox span{
        margin-bottom: 15px;
      }
      #p_totalAmount{
        font-size: 1.625rem;
        letter-spacing: -0.78px;
        color: var(--mainColor);
      }

      .flexSpaceBetween{
        display: flex;
        justify-content: space-between;

      }
      #payPersonBox{
        width: 100%;
        margin-bottom: 100px;
        padding: 22px 40px;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(103deg, #e8ebf2, #f2f3f7 100%);
        display: flex;
        flex-direction: column;
      }
      
      #personGrid{
        display: grid;
        grid-template-columns: 20% 80%;
        row-gap: 10px;
        font-size: 1.25rem;
        color: #464646;
      }
      .personBold{
        font-size: 1.5rem;
        font-weight: 500;
        letter-spacing: -0.72px;
      }

      .inputAddr{
        margin-bottom: 10px;
      }

      #btnFindAddr{
        width: 150px;
        height: 35px;
        background-color: #fff;
        border-radius: 4px;
        border: solid 1px #d1d1d1;
        color: #575757;
        letter-spacing: -0.32px;
      }

      #btnLoadAddr{
        width: 150px;
        height: 35px;
        background-color: #fff;
        border-radius: 4px;
        border: solid 1px #d1d1d1;
        color: #575757;
        letter-spacing: -0.32px;
      }

      #p_defaultAddr{
        font-size: 0.938rem;
        margin-top : 10px;
        margin-bottom : 0;
        display: none;
      }

      .checkboxCenter{
        margin: 0 auto;
      }

      #paymentInfoBox{
        width:100%;
        height: auto;
        margin-bottom: 100px;
        padding: 30px 0 18px 30px;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(103deg, #e8ebf2, #f2f3f7 100%);
        display: grid;
        grid-template-columns: 62% 38%;
      }
      .boxTitle{
        font-size: 2.125rem;
        font-weight: 500;
        letter-spacing: -1.02px;
        color: #212121;
      }
      #paymentInfoGrid{
        display: grid;
        grid-template-columns: 30% 70%;
        row-gap: 15px;
        font-size: 1.125rem;
      }
      #btnSimplePay{
        border: none;
        width: 530px;
        height: 45px;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(95deg, #e8ebf2, #f2f3f7);
        color: #287aec;
        margin-top: 30px;
      }
      #inputPhoneNum input{
        width:77px;
      }

      #paymentInfoRight p{
        font-size: 1rem;
        font-weight: bold;
        letter-spacing: -0.48px;
        color: #212121;
      }
      #paymentInfoRight ul{
        all: unset;
      }
      #paymentInfoRight li{
        font-size: 1rem;
        letter-spacing: -0.48px;
        color: #575757;
        margin-top: 12px;
      }

      #p_chkBox{
        margin: 0 auto;
      }

      #btnPay{
        margin: 0 auto;
        border: none;
        width: 191px;
        height: 60px;
        border-radius: 10px;
        box-shadow: 6px 6px 12px #e5e7e9,
                   -6px -6px 12px #fdffff;
        background-image: linear-gradient(107deg, #e8ebf2, #f2f3f7);
        font-size: 1.25rem;
        font-weight: 500;
        letter-spacing: -0.6px;
        color: var(--mainColor);
        margin-top: 30px;
      }

      /* .inputCustom{
        all: unset;
      } */

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
        opacity:0;
      }
      
    </style>
    <link rel="stylesheet" href="css/jun_media/pay_tablet.css">
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
      <!-- Main Content -->
      <div id="payFormBox">
        <div class="explains"><span class="SpanExplains">리워드 선택 </span><div>펀딩해주시는 금액에 따라 감사의 의미로 리워드를 제공해 드립니다.</div></div>
          <div id="wrapRewards">
            <?php 
              $q1 = $db->query("SELECT ai_rewards,funware_rewards.sys_project_id, f_reward_div,f_reward_desc,f_reward_cont, f_reward_money
                                    FROM   funware_rewards
                                    WHERE  funware_rewards.sys_project_id = '.$p_num.' AND funware_rewards.f_div='Y' 
                              ");
              while($row_reward = $q1->fetch(PDO::FETCH_ASSOC)){
                // echo 'hi';
            ?> 
              <div class="rewardBox">
                <input type="text" name="rewardID" class="hiddenInput rewardID" value="<?=$row_reward["ai_rewards"]?>">
                <input type="text" name="rewardMoney" class="hiddenInput rewardMoney" value="<?=$row_reward["f_reward_money"]?>">
                <p class="rewardName"><?=$row_reward["f_reward_div"]?>(<?=number_format($row_reward["f_reward_money"])?> 원) 펀딩하기</p>
                <p class="reward"><?=$row_reward["f_reward_desc"]?></p>
                <p class="rewardContent"><?=$row_reward["f_reward_cont"]?></p>
                <img class="rewardChkImg" src="img/funware_checked.png" alt="">
              </div>
            <?php 
              }
            ?>
          </div>
            <?php
              $q2 = $db->query("SELECT f_project_name, f_par_value FROM funware_project WHERE ai_project_id = ".$p_num."");
              $row_pj = $q2->fetch(PDO::FETCH_ASSOC);
              $q2_1 = $db->query("SELECT f_etp_name FROM funware_enterprise WHERE sys_project_id = '.$p_num.' LIMIT 1");
              $row_etp = $q2_1->fetch(PDO::FETCH_ASSOC);
            ?>
            <p class="explains2"><?=$row_pj["f_project_name"]?>에 <span id="fundValue1">0</span> 원을 펀딩합니다.</p>
            <div class="explains i_tipBox">
              <span class="SpanExplains">투자하기(선택)</span>
              <div>
                투자를 더하여 펀딩할 수 있습니다. 투자를 하시겠습니까?
                <img id="imgInfo" src="img/icon_info.png" alt="">
              </div>
              <!-- <div id=""> -->
               
              <span id="i_tip"><?=$row_etp["f_etp_name"]?> 사의 주당 가격은 <?=number_format($row_pj["f_par_value"])?> 원입니다.</span>
              <!-- </div> -->
            </div>
            <p class="explains"> <input id="inputMore" class="inputStyle" type="text" onkeypress="inNumber();" placeholder=" 0">주를 추가로 투자합니다.</p>
            
            <button id="btnShowInfo">결제정보 입력 ></button>
            
            <form action="ajaxPay.php">

              <div id="wrapHideBox">
                <div id="hideBox">
                  <div id="payAmountBox">
                    <div class="flexSpaceBetween">
                      <span>펀딩 금액</span>
                      <p><span id="fundValue2">0</span> 원</p>
                    </div>
                    <div class="flexSpaceBetween">
                      <span>추가 후원금</span>
                      <p><span id="investValue">0</span> 원</p>
                    </div>
                    <hr>
                    <div class="flexSpaceBetween">
                      <span>최종 결제 금액</span>
                      <p id="p_totalAmount"><span id="totalAmount">0</span> 원</p>
                      <input type="text" name="finalAmount" id="finalAmount" class="hiddenInput">
                    </div>
                  </div>

                  
                  <div id="payPersonBox">
                    <div id="personGrid">
                      <span class="personBold">이름</span>
                      <span><?=$row_user["f_user_name"]?></span>
                      <span class="personBold">이메일</span>
                      <span><?=$row_user["f_email"]?></span>
                      <span class="personBold">주소</span>
                      <div>
                        <input type="text" name="postcode" id="postcode" class="inputStyle inputAddr" placeholder=" 우편번호">
                        <input type="button" id="btnFindAddr" onclick="execDaumPostcode()" value=" 우편번호 찾기"><br>
                        <input type="text" name="address" id="address" class="inputStyle inputAddr" placeholder=" 주소"><br>
                        <input type="text" name="detailAddress" id="detailAddress" class="inputStyle inputAddr" placeholder="상세주소">
                        <br><input type="button" id="btnLoadAddr" value="주소 불러오기"></button>
                        <p id="p_defaultAddr">
                          <input type="checkbox" name="ChkDefaultAddr" id="">
                          이 주소를 기본 배송지로 설정합니다
                        </p>
                      </div>
                    </div>
                    <hr>
                    <div class="checkboxCenter">
                      <input type="checkbox" name="agree" value="checkMarketing"/>
                      <span>(필수) 펀딩 진행에 대한 새소식 및 결제 관련 안내를 받습니다.</span> <!-- 글씨 CSS -->
                    </div>
                  </div>

                  <div id="paymentInfoBox">
                    <div id="paymentInfoLeft">
                      <p class="boxTitle">결제 정보 입력</p>
                      <div id="paymentInfoGrid">
                        <span class="">결제 카드 선택</span>
                        <div>
                          <select id="bankSelect" class="inputStyle" name="bank">
                            <option class="bankOption" value="">--은행선택--</option>
                            <option class="bankOption" value="국민">국민</option>
                            <option class="bankOption" value="우리">우리</option>
                            <option class="bankOption" value="신한">신한</option>
                            <option class="bankOption" value="하나">하나</option>
                            <option class="bankOption" value="농협">농협</option>
                            <option class="bankOption" value="수협">수협</option>
                            <option class="bankOption" value="KDB">KDB산업</option>
                            <option class="bankOption" value="씨티">씨티</option>
                            <option class="bankOption" value="카카오뱅크">카카오뱅크</option>
                          <select>
                        </div>
                        <span class="">전화번호입력</span>
                        <div id="inputPhoneNum">
                          <input type="text" name="phoneNum1" class="inputStyle" onkeypress="inNumber();"> - 
                          <input type="text" name="phoneNum2" class="inputStyle" onkeypress="inNumber();"> - 
                          <input type="text" name="phoneNum3" class="inputStyle" onkeypress="inNumber();">
                        </div>
                        <!-- <span class="">카드 비밀번호</span>
                        <div>
                          <input type="text" name="cardPW" class="inputStyle" placeholder=" 앞 두 자리" onkeypress="inNumber();" >
                        </div> -->
                        <span class="">할부기간</span>
                        <div>
                          <!-- <select id="interestSelect" class="inputStyle" name=""> -->
                          <select id="monthlySelect" class="inputStyle" name="">
                            <option class="interestOption" value="0">--할부--</option>
                            <option class="interestOption" value="3">3개월</option>
                            <option class="interestOption" value="6">6개월</option>
                            <option class="interestOption" value="12">12개월</option>
                          <select>
                        </div>
                      </div>
                      <!-- <button id="btnSimplePay">간편 결제 하기</button> -->
                    </div>
                    <div id="paymentInfoRight">
                      <p>결제시 유의사항</p>
                      <ul> <!-- CSS -->
                        <!-- <li>결제시 유의사항</li> -->
                        <li>- 결제 실행일에 결제자 귀책사유 (한도초과, 이용정지 등)으로 인하여 결제가 실패할 수 있으니, 결제수단이 유효한지 한번 확인하세요.</li>
                        <li>- 1차 결제 실패 시 실패일로부터 3 영업일동안 재 결제를 실행합니다.</li>
                        <li>- 결제 예약 이후, 결제할 카드를 변경하려면 마이페이지 -> 나의 펀딩의 결제정보에서 카드정보를 변경해주세요.</li>
                      </ul>
                    </div>
                  </div>

                  <p id="p_chkBox">
                    <input type="checkbox" id="chkTerm" name="chkTerm" value=""/>
                    <span><a href="javascript:void(window.open('payTermsAgree.html', '_blank','width=525, height=635, top=80, left=500, location=no'))">결제약관</a> 동의하기</span>
                  </p>
                  <button id="btnPay" type="button">결제하기</button>
                </div>
              </div>
            </form>
        </div>
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

    
    


<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="js/jquery/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap/bootstrap.js"></script>
<script src="js/channelTalk.js"></script>
<script>
  $(function () {
    $("#testWrapper").fadeIn(500, function () {
        $(this).animate({
          "opacity": "1"
        },700);
    });
  });
  // $("#hideBox").slideUp().fast;
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


   function inNumber(){ // 숫자만 입력
       if(event.keyCode<48 || event.keyCode>57){
          event.returnValue=false;
       }
   }
  
  function numberFormat(int){ // 세 자리수마다 콤마 찍어줌
    if(Number.isInteger(int)){
      int = int.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return int;
    }
  }

  let asi = "";
  let rewardID = "";
  // $("input[name=rewardID]").val();


  //  리워드 선택
  $('.rewardBox').click(function() {
      let fundMoney = ($(this).children('.rewardMoney').val() > 0) ? parseInt($(this).children('.rewardMoney').val()) : 0;
      let investMoney = ($('#inputMore').val() > 0) ? (parseInt($('#inputMore').val())*<?=$row_pj["f_par_value"]?>) : 0;
      let totalMoney = fundMoney + investMoney;

      document.getElementById("finalAmount").value = totalMoney;
      
      $('#fundValue1').html(numberFormat(fundMoney));
      $('#fundValue2').html(numberFormat(fundMoney));
      $("#investValue").html(numberFormat(investMoney));
      $('#totalAmount').html(numberFormat(totalMoney));
      
      const selectRewards = document.querySelectorAll(".rewardChkImg");
      for (let i=0; i<selectRewards.length; i++){
        selectRewards[i].style.display="none";
      }
      $(this).children('.rewardChkImg').css({"display" : "block"});
      rewardID = $(this).children('input[name=rewardID]').val();
  });

  //  결제 정보 입력 버튼
  $("#btnShowInfo").click(function(){
    $("#wrapHideBox").slideDown();
  });

  //  투자 금액 입력
  $("#inputMore").focusout(function(){
    let tempFundMoney = parseInt($('#fundValue1').text().replace(",", ""));
    
    let fundMoney = (tempFundMoney > 0) ? tempFundMoney : 0;
    let investMoney = (parseInt($(this).val()) > 0) ? parseInt($(this).val())*<?=$row_pj["f_par_value"]?> : 0;

    let totalMoney = fundMoney + investMoney;
    document.getElementById("finalAmount").value = totalMoney;
    
    $("#investValue").html(numberFormat(investMoney));
    $('#totalAmount').html(numberFormat(totalMoney));
  });

  // 주소 불러오기
  $("#btnLoadAddr").click(function(){
    if('<?=$row_user["f_post_num"]?>' == "" && '<?=$row_user["f_roadname"]?>' == "" && '<?=$row_user["f_address_detail"]?>' == ""){
      alert("저장된 주소가 없습니다.");
    }else{
      $("#postcode").val("<?=$row_user["f_post_num"]?>");
      $("#address").val("<?=$row_user["f_roadname"]?>");
      $("#detailAddress").val("<?=$row_user["f_address_detail"]?>");
    }
  });

  $("#detailAddress").focusout(function(){
    if('<?=$row_user["f_post_num"]?>' == "" && '<?=$row_user["f_roadname"]?>' == "" && '<?=$row_user["f_address_detail"]?>' == ""){
      $('#p_defaultAddr').slideDown();
    }else if($("#postcode").val() != "" && $("#address").val() != "" && $("#detailAddress").val() != ""){
      if($("#postcode").val() != '<?=$row_user["f_post_num"]?>' || $("#address").val() != '<?=$row_user["f_roadname"]?>' || $("#detailAddress").val() != '<?=$row_user["f_address_detail"]?>'){
        $('#p_defaultAddr').slideDown();
      }
    }
  });


   //  카카오다음 도로명주소
   function execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postcode').value = data.zonecode;
                document.getElementById("address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("detailAddress").focus();
            }
        }).open();
    }

    // 결제버튼 click -> 값 체크
    $("#btnPay").click(function(){

      if($("#finalAmount").val() == "" || $("#finalAmount").val() == 0){
        alert("상품을 선택해주세요.");
      }else if($("#postcode").val() == "" || $("#address").val() == "" || $("#detailAddress").val() == ""){
        alert("주소를 올바로 입력해주세요.");
      }else if($("#bankSelect").val() == "" || $("input[name=phoneNum1]").val() == "" || $("input[name=phoneNum2]").val() == "" || 
               $("input[name=phoneNum3]").val() == "" || $("input[name=phoneNum4]").val() == ""){
        
        alert("결제 정보 기입란을 확인해주세요.");
      }else if($("input[name=agree]").is(":checked") == false){
        alert("펀딩 진행 알람 푸시 여부를 체크해주세요.");
      }else if($("input[name=chkTerm]").is(":checked") == false){
        alert("결제 약관에 동의하셔야 합니다.");
      }else{
        // 결제 API 불러오기
        //결제창 호출
        let totalAmount = document.getElementById("finalAmount").value;
        let cardBank = $("#bankSelect").val();
        let monthly = $("#monthlySelect").val();
        let i_week = $("#inputMore").val();
        let phoneNum = $("input[name=phoneNum1]").val() + $("input[name=phoneNum2]").val() + $("input[name=phoneNum3]").val();

        let saveAddr = "N";
        let postcode = "";
        let address = "";
        let detailAddress = "";
        if($("input[name=ChkDefaultAddr]").is(":checked") == true){
          saveAddr = "Y";
          postcode = $("#postcode").val();
          address = $("#address").val();
          detailAddress = $("#detailAddress").val();
        }

        tossPayments.requestPayment('카드', {
            amount: totalAmount,
            orderId:  Date.now(),
            orderName: "펀웨어 프로젝트 <?=$row_pj["f_project_name"]?>",
            customerName: '<?=$_SESSION["userName"]?>',
            cardCompany : cardBank,
            flowMode : 'DIRECT',
            cardInstallmentPlan : parseInt(monthly),
            successUrl: window.location.origin + '/funware/payCallback.php?p_num=<?=$p_num?>&i_week=' + i_week 
                                               + '&rewardID=' + rewardID + '&saveAddr=' + saveAddr + '&postcode=' + postcode
                                               + '&address=' + address + '&sk=' + '<?=$ini["tossPayments_key"]?>' + '&detailAddress=' + detailAddress + '&phoneNum=' + phoneNum + '&',
            // successUrl: window.location.origin + 'test2.php',
            failUrl: window.location.origin + '/payFail.php',
        });
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