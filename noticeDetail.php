<?php
  try {
    require 'dbInfo.php';
    include 'isSession.php';

    $n_num = $_REQUEST["n_num"];
    // $n_num = 5;

    $q1 = $db->query('SELECT f_notice_title AS title,
                             f_notice_contents AS contents,
                             f_div,
                             f_notice_img AS img,
                             f_date
                      FROM funware_notice WHERE ai_notice = '.$n_num.';');
    $row = $q1->fetch(PDO::FETCH_ASSOC);

    $img = ($row["img"] != NULL) ? '<img src="'.$row["img"].'">' : '';
    $n_div = ($row["f_div"] == 'N') ? '공지' : '이벤트';
 ?>

<!DOCTYPE html>
  <head>
    <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <link rel="stylesheet" href="css/funware_src/footer.css">

    <title>펀웨어 - 공지사항</title>

    <style type="text/css">
      :root{
        --mainColor: #1a72ec;
        --width: 80rem;
        --gray0: #f8f9fa;
        --gray1: #f1f3f5;
        --gray2: #e9ecef;
        --gray3: #dee2e6;
      }

      *{font-family: 'Spoqa Han Sans Neo', 'sans-serif';}
      body {background-color: #f2f3f7;}
      li {list-style: none;}
      a {text-decoration: none;}

      #wrap-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        margin: 0 auto;
      }
      #main-container{
        background-color: #fff;
        width: var(--width);
        margin: 0 auto;
        margin-top: 3.75rem;
        margin-bottom: 4.969rem;
      }

      #noticeDetailWrapper{
        border-radius: 10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #ffffff;
        background-image: linear-gradient(135deg, #e8ebf2, #f2f3f7);
      }

      #keywordBox{
        padding: 5rem 5.625rem 2.5rem 5.625rem;
        border-bottom: 1px solid #d1d1d1;
      }
      #keyword p{
        margin-bottom: 0.313rem;
      }
      #keyword h2{
        margin: 1.25rem 0 2.188rem 0;
      }
      #n_div{
        /* background-color: red; */
        color: var(--mainColor);
        font-weight: 500;
      }

      #write_info{
        /* background-color: yellow; */
        font-size: 1rem;
        color: #575757;
      }

      #n_contentsBox{
        padding: 3.75rem 5.625rem 5rem 5.625rem;
      }

      #n_imgBox{
        margin-bottom: 3.75rem;
      }
      #n_imgBox img{
        width: 44.375rem;
        height: 25rem;
      }
      #n_words{
        /* padding: 1.875rem 1.25rem; */
      }

      #btnTop{
        width: 40px;
        height: 40px;
        position: fixed;
        /* z-index: 999; */
        right: 2%;
        bottom: 3.125rem;
        border: solid 1px #acacac;
        border-radius: 70%;
        cursor: pointer;
      }

      #dat-container{
        width: var(--width);
        margin: 0 auto;
        padding: 4.969rem 0 0 0;
        border-top: 0.063rem solid #707070;
      }

      #newDat{
        /* background-color: Khaki; */
        width: 100%;
        height: 100px;
        
      }
      .dat_userImg{
        width: 88px;
        height: 88px;
        border-radius: 70%;
        border: 1px solid #d1d1d1;
        margin-right: 1.875rem;
      }

      #wrapdatBtnGroup{
        display: none;
      }

      #datBtnGroup{
        display: flex;
        width: 100%;
        justify-content: flex-end;
      }
      
      #inputNewDat{
        all: unset;
        width: 89%;
        border-bottom: 1px solid #575757;
        font-size: 1.25rem;
      }
      
      #btnCancelDat{
        border: none;
        border-radius: 0.375rem;
        width: 75px;
        height: 40px;
        background-color: #b8b8b8;
        margin-right: 1.25rem;
      }

      #btnNewDat{
        border: none;
        border-radius: 0.375rem;
        width: 75px;
        height: 40px;
        background-color: var(--mainColor);
      }

      #datList{
        /* background-color: yellow; */
        margin-top: 1.688rem;
        padding: 3.75rem 0;
        width: 100%;
      }

      .singleDat{
        display: flex;
        padding: 1rem 0 1rem 1rem;
        margin-bottom:40px;
        border-radius: 10px;
        box-shadow:  5px 5px 6px #e2e3e4,
                    -5px -5px 6px #ffffff;
        background-image: linear-gradient(135deg, #e8ebf2, #f2f3f7);
      }
      
      .datRightBox{
        width: auto;
      }

      .datLeftBox{
        width: 85%;
      }

      .dat_info{
        width: 100%;
        display: flex;
        justify-content: space-between;
      }

      .dat_nickname{
        font-size: 1.25rem;
        font-weight: 500;
        color: #272727;
        margin-right: 0.625rem;
      }
      .dat_time{
        font-size: 1.25rem;
        color: #575757;
      }

      .formModify{
        display: none;
      }

      .modifyHiddenInput{
        display: none;
      }

      .modifyDat{
        color: red;
        text-decoration: underline;
        cursor: pointer;
      }

      .btnSubmitModify{
        all: unset;
        color: var(--mainColor);
        margin-left: 1.25rem;
      }

      .deleteDat{
        color: red;
        text-decoration: underline;
      }
      
      .dat_content{
        margin-top: 0.938rem;
        font-size: 1.25rem;
        color: #272727;
        /* display: none; */
      }

      .inputModifyDat{
        width: 60%;
        margin-top: 0.938rem;
        border: 0;
        background: var(--gray2);
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
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

      /* footer */
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
    <link rel="stylesheet" href="css/jun_media/notice_detail_tablet.css">

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
                          $q_user = $db->query('SELECT * FROM funware_user WHERE ai_id = '.$_SESSION['userId'].'');
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
                      <li><a class="dropdown-item" href="landing.php">About us</a></li>
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
      <!-- main -->
      <div id="main-container">
        <div id="noticeDetailWrapper">
          <div id="keywordBox">
            <div id="keyword">
              <p id="n_div"><?=$n_div?></p>
              <h2><?=$row["title"]?></h2>
              <div id="write_info">
                <p id="writer">FUNWARE</p>
                <p id="write_date"><?=$row["f_date"]?></p>
              </div>
            </div>
          </div>
          <div id="n_contentsBox">
            <div id="n_imgBox"><?=$img?></div>
            <div id="n_words"><?=$row["contents"]?></div>
          </div>
        </div>
      </div>

      <div id="dat-container">
        <div id="newDat">
          <!-- <form action=""> -->
          <?php 
            if($user_login){
              
              $row_user["f_profile"] = ($row_user["f_profile"] == NULL) ? "img/defaultProfile.jpg" : $row_user["f_profile"];
          ?>
            <img class="dat_userImg" src="<?=$row_user["f_profile"]?>" alt="">
            <input id="inputNewDat" type="text" placeholder=" 댓글 달기" name="">
          <!-- </form> -->
          <?php 
            }else{
          ?>
            <img class="dat_userImg" src="img/defaultProfile.jpg" alt="">
            <input id="inputNewDat" type="text" placeholder=" 댓글 달기" name="">
          <?php 
            }
          ?>
        </div>
        <div id="wrapdatBtnGroup">
          <div id="datBtnGroup">
            <button id="btnCancelDat">취소</button>
            <button id="btnNewDat">댓글</button>
          </div>
        </div>
        <div id="datList"></div>
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
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/burger.js"></script>
    <script src="js/channelTalk.js"></script>
    <script>
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

      // 댓글쓰기
      $.ajax({
        url: "ajax_src/ajaxNewDat.php",
        type: "post",
        data: {
          n_num  : <?=$n_num?>,
          newDat : $('#inputNewDat').val()
        },
        success: (data) => {
          if(data) {
            $("#datList").html(data);
          }
        }
      });

      $("#inputNewDat").focusin(function() {
        if('<?=$user_login?>' == 1){
          $(this).css({"border-bottom" : "2px solid #272727"});
          $("#wrapdatBtnGroup").slideDown();
        }else{
          $(this).attr('placeholder', '로그인이 필요한 서비스입니다.');
          // if(loginConfirm == true) location.href = "login.php";
        }
      });

      $("#btnCancelDat").click(function() {
        $("#inputNewDat").css({"border-bottom" : "1px solid #575757"});
        $("#wrapdatBtnGroup").slideUp();
      });

      $("#btnNewDat").click(function() {
        console.log('hi');
        $.ajax({
          url: "ajax_src/ajaxNewDat.php",
          type: "post",
          data: {
            n_num  : <?=$n_num?>,
            newDat : $('#inputNewDat').val()
          },
          success: (data) => {
            if(data) {
              $("#datList").html(data);
              $('#inputNewDat').val("");
            }
          }
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
