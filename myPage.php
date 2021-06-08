<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';

  if(!$user_login) {
    echo "<script>";
    echo    "alert('로그인이 필요한 서비스입니다.');";
    echo    "location.replace('index.php');";
    echo "</script>";
  }else{
  
  // echo $_SESSION['userId'];
  // echo $_SESSION['userName'];

  $q_user = $db->query('SELECT * FROM funware_user WHERE ai_id = '.$_SESSION['userId'].'');
  if($row_user = $q_user->fetch(PDO::FETCH_ASSOC)){
    $row_user["f_profile"] = ($row_user["f_profile"] == NULL) ? "img/defaultProfile.jpg" : $row_user["f_profile"];
    // $row_user["f_user_address"] = ($row_user["f_user_address"] == NULL) ? "등록된 주소가 없습니다." : $row_user["f_user_address"];
    if($row_user["f_roadname"] == "" && $row_user["f_address_detail"] == ""){
      $userAddr = "등록된 주소가 없습니다.";
    }else{
      $userAddr = $row_user["f_roadname"]." ".$row_user["f_address_detail"];
    }
    // echo $row_user["f_profile"];
  }
  
?>
<!DOCTYPE html>
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
    <title>펀웨어 - My Page</title>

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

      *{font-family: 'Spoqa Han Sans Neo', 'sans-serif';}
      li {list-style: none;}
      a {text-decoration: none;}

      #wrap-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
      }

      #profileBox{
        width: 690px;
        margin: 0 auto;
        margin-top: 70px;
        margin-bottom: 110px;
        padding: 50px 55px;
        /* border: solid 1px #d1d1d1; */
        border-radius: 10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(145deg, #e8ebf2, #f2f3f7);

        display: flex;
        flex-direction: column;
      }

      #profileBox a{
        margin: 0 auto;
        font-size: 1.125rem;
        letter-spacing: -0.36px;
        color: #595959;
      }

      #profileBoxTitle{
        font-size: 1.625rem;
        font-weight: 500;
        letter-spacing: -0.52px;
        color: #212121;
      }

      .ptofileTitle{
        font-size: 1.5rem;
        letter-spacing: -0.48px;
        color: #595959;
      }

      .userInfo{
        font-size: 1.25rem;
        color: #595959;
      }

      #myProfileImgTitle{
        font-size: 1.25rem;
        letter-spacing: -0.4px;
        color: #212121;
      }

      #myProfileImg{
        width: 207px;
        height: 207px;
        border-radius: 70%;
        border: solid 1px #d1d1d1;
        margin: 0 auto;
      }

      #profileBtns{
        display: flex;
        margin-top: 40px;
      }

      #btnUpdate{
        width: 445px;
        height: 68px;
        /* 추가_재영 */
        border-radius:10px;
        border:0;
        background: var(--gray1);
        border-radius:10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #ffffff;
        color: var(--mainColor);
        font-size: 1.313rem;
        font-weight: 500;
        letter-spacing: -0.63px;
        transition: 0.5s ease;
        margin-right: 25px;
      }

      #btnWithdrawal{
        width: 120px;
        height: 68px;
        border-radius:10px;
        border:0;
        background: var(--gray1);
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #ffffff;
        font-size: 1.313rem;
        font-weight: 500;
        letter-spacing: -0.63px;
        color: #ec1a1a;
        transition: 0.5s ease;
      }
      
      #profileBtns button:hover{
        transition: 0.5s ease;
        background: var(--gray2);
      }

      #myProjects{
        width: 1280px;
        height: 196px;
        margin: 0 auto;
        margin-bottom: 100px;
        border: solid 1px #d1d1d1;
        border-radius: 10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #fff;
        background-image: linear-gradient(99deg, #e8ebf2, #f2f3f7 100%);
        display: flex;
      }
      .myProjectsItem{
        width: 33.3%;
        height: 196px;
        border-right: 1px solid #d1d1d1; /* js 마지막 요소 줄 없애기 */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
      }
      .myProjectsTitle{
        font-size: 1.75rem;
        font-weight: 500;
        color: #494949;
        margin-bottom: 38px;
      }
      .myProjectsNum{
        font-size: 1.75rem;
        font-weight: 500;
        color: #494949;
      }

      #myProjectList{
        /* background-color: ghostWhite; */
        width: var(--width);
        /* height: 1000px; */
        margin: 0 auto;
      }
      .pListBox{
        /* background-color: Lavender; */
        width: 100%;
        margin-bottom: 74px;
      }
      .listTitle{
        font-size: 2.125rem;
        font-weight: 500;
        color: #464646;
        margin-bottom: 30px;
      }

      #ajaxProjectBox{
        width: 100%;
        margin: 0 auto;
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
      
      #profileBox label{
        text-decoration: underline;
      }
      
      #inputProfileImg{
        display: none;
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

      .emptySearchedBox{
        width: auto;
        color: #A9A9A9;
      }


    </style>
    <link rel="stylesheet" href="css/jun_media/myPage_tablet.css">
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

  <!-- Profile -->
  <div id="profileBox">
    <p id="profileBoxTitle">내 정보</p>
    <p id="myProfileImgTitle">프로필 사진</p>
    <!-- <div class=""> -->
      <img id="myProfileImg" src="<?=$row_user["f_profile"]?>"><br>
      <a href="">
        <form id="formProfileImg" action="sub_src/changeProfileImg.php" method="post" enctype="multipart/form-data">
          <label for="inputProfileImg">사진 변경<label>
          <input type="file" id="inputProfileImg" name="profileImg" accept="image/*">
        </form>
      </a>
    <!-- </div> -->
    <p class="ptofileTitle">이름</p>
    <p class="userInfo"><?=$row_user["f_user_name"]?></p>
    <p class="ptofileTitle">이메일</p>
    <p class="userInfo"><?=$row_user["f_email"]?></p>
    <p class="ptofileTitle">주소</p>
    <p class="userInfo"><?=$userAddr?></p>
    <div id="profileBtns">
      <button type="button" id="btnUpdate" onclick="location.href='userUpdate.php';">변경하기</button>
      <button type="button" id="btnWithdrawal" onclick="withdrawal();">탈퇴하기</button>
    </div>
  </div>

  <div id="ajaxProjectBox"></div>
  

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
  <script src="js/bootstrap/bootstrap.js"></script>
  <script src="js/loopslide.js" defer></script>
  <script src="js/channelTalk.js"></script>
  <script src="js/burger.js"></script>
  <script>

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
      
      // 프로필 사진 변경
      $(document).on("change", "#inputProfileImg", function(){
        let formProfileImg = $("#formProfileImg");
        console.log(formProfileImg);
        if(confirm("프로필 사진을 적용하시겠습니까?")){
          formProfileImg.submit();
          alert('적용 할거에요');
        }
        // $filename = $(this).val();
        // if($filename == "")
        //   $filename = "파일을 선택해주세요.";
        // $(".filename").text($filename);
        // }
        // 에이젝스로 사진 업로드, 업뎃 성공 시 화면 사진 바꾸기
      });

    // 카드 불러오기
    function goAjax() {
    // $(function () {
      $.ajax({
          url:'ajaxMyProjects.php', //request 보낼 서버의 경로
          type:'post', // 메소드(get, post)
          data:{}, //보낼 데이터
          success: function(data) {
            //서버로부터 정상적으로 응답이 왔을 때 실행
            $('#ajaxProjectBox').html(data);
            document.querySelectorAll('.myProjectsItem')[3].style.border="none";

            $("#registProject").click(function(){
              console.log('registProject');
              location.href='#registList';
            });
            $("#sponProject").click(function(){
              location.href='#spontList';
            });
            $("#investProject").click(function(){
              location.href='#investList';
            });
            $("#likeProject").click(function(){
              location.href='#likeList';
            });
          },
          error: function(err) {
            //서버로부터 응답이 정상적으로 처리되지 못했을 때 실행
            alert('something wrong');
          }
      });
    // });
    }
    goAjax();
    // setInterval('goAjax()', 100000000000000); // 음...

    function withdrawal(){
      if(confirm("정말 탈퇴하시겠습니까?")){
        let answer = prompt("비밀번호를 입력해주세요");

        $.ajax({
          url: "ajax_src/ajaxWithdrawal.php",
          type: "post",
          dataType: "json",
          async: false,
          data: { pw : answer },
          success: (res) => {
            if(res){
              alert(res.msg);
              location.replace('index.php');
            }else{
              alert(res.msg);
            }
          }
        });
      }
    }
    
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
    })
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
  }
}catch(Exception $e){
  echo $e;
}
 ?>
