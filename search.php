<?php
try{
  require 'dbInfo.php';
  include 'isSession.php';
  // $keyword = 'a';
  $keyword = $_REQUEST["searchText"];
  $projectCount = 0;
?>
<!doctype html>
  <head>
    <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <link rel="stylesheet" href="css/funware_src/cards.css">
    <link rel="stylesheet" href="css/funware_src/footer.css">

    <title>펀웨어 검색 - 크라우드펀딩</title>

    <style type="text/css">
      :root{
        --mainColor: #1a72ec;
        --width: 1280px;
        /* 추가_재영 */
        --gray0: #f8f9fa;
        --gray1: #f1f3f5;
        --gray2: #e9ecef;
        --gray3: #dee2e6;
      }


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
        margin: 0 auto;
      }
      #main-container{
        /* background-color: #c8c8c8; */
        width: var(--width);
        margin: 0 auto;
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

      #keywordBox{
        /* background-color: #e36c6c; */
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
      }
      #keyword{margin-left: 25px;}
      #result-cards-Box{
        /* background-color: #a4e36c; */
        width: 100%;
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
      }
      #investment-risk-notice_top{display: flex;justify-content: space-between;}
      #rist_detail{
        margin-top: 10px;
        height: 490px;
        overflow-y: auto;
      }

      /* 추가_재영 */
      .searchKeyword{
        color: var(--mainColor);
        font-size:2.125rem;
        font-weight:800;
      }
      .searchText{
        color: #464646;
        font-size:2.125rem;
        font-weight:500;
      }
      .emptySearchedBox{
        width:var(--width);
        /* width:80%; */
        height:300px;
        /* background:red; */
        margin:0 auto;
        display: flex;
        font-size:1.563rem;
        justify-content:center;
        align-items:center;
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

    </style>
    <link rel="stylesheet" href="css/jun_media/search_tablet.css">

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

      <!-- main -->
      <div id="main-container">
        <div id="keywordBox">
          <div id="keyword">
            <?php
              if(!$keyword == "") echo '<span class="searchKeyword">',$keyword,'</span><span class="searchText"> 검색결과</span>';
              else echo '<span class="searchKeyword">검색어</span><span class="searchText">를 입력해주세요.</span>';

            ?>

          </div>
        </div>
        <div id="result-cards-Box">

        <?php
          $q1= $db->prepare("SELECT j_link.sys_project_id AS p_id
                                  ,j_link.sys_category_id
                                  ,j_category.f_category_name
                                  ,j_project_Sum.f_project_name
                                  ,j_project_Sum.f_projectTotal
                                  ,j_project_Sum.f_percent
                                  ,j_project_Sum.f_etp_name
                                  ,j_project_Sum.f_daysleft
                                  ,j_project_Sum.f_thum


                          FROM funware_pj_category as j_link
                              Left join funware_category AS j_category
                                ON j_link.sys_category_id = j_category.ai_category
                              LEFT JOIN (

                                      SELECT j_project.ai_project_id
                                            ,j_project.f_project_name
                                            ,sum(j_payment.f_spon + f_invest) AS f_projectTotal
                                            ,TRUNCATE((sum(j_payment.f_spon + f_invest)/j_project.f_donate_limit)*100,0) AS f_percent
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
                            WHERE	concat(j_project_Sum.f_project_name,',',j_project_Sum.f_etp_name,',',j_category.f_category_name)  LIKE ? AND j_project_Sum.f_div ='Y' AND f_daysleft > 0
                                  GROUP BY sys_project_id");

          $q1->execute(array("%".$keyword."%"));

            echo '<div id="keyword-cards" class="cards">';

            while($row = $q1->fetch(PDO::FETCH_ASSOC)){

              $projectCount++;

              if($keyword != "" && $projectCount != 0){
                if(!$row["f_thum"]) $row["f_thum"] = "img/defaultThumbnail.png";
                if(!$row["f_percent"]) $row["f_percent"] = "0";
                  $projectSize = strlen($row["f_project_name"]);
                  $etpSize = strlen($row["f_etp_name"]);
                  $projectName = ($projectSize >= 17) ? $projectName = substr($row["f_project_name"],0, 17).'...': $row["f_project_name"] ;
                  $etpName = ($etpSize >= 23) ? $etpName = substr($row["f_etp_name"],0, 23).'...': $row["f_etp_name"];
                echo '<div class="cards_contents">';
                echo '<a href="projectDetail.php?p_num='.$row["p_id"].'">';
                  echo '<div class="p_thumnail"><img src="'.$row["f_thum"].'"></div>';
                  echo '<div class="p_infoBox">';
                    echo '<div class="enp_name">', $etpName, '</div>';
                    echo '<div class="p_nameRateBox p_tip">';
                      echo '<div class="p_name">', $projectName, '</div>';
                      echo '<div class="d_rate">', $row["f_percent"], '%</div>';
                      echo '<span>' , $row["f_project_name"] ,'</sapn>';
                    echo '</div>';
                  echo '</div>';
                echo '</div></a>';
              }

            }
            if($projectCount == 0) echo '<div class="emptySearchedBox">Oooops, 검색결과가 없어요 !</div>';

            echo '</div>';

        ?>
        </div>
      </div>

      <!-- move top button -->
      <img src="img/topArrow.png" id="btnTop">

    </div>


    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/burger.js"></script>
    <script src="js/channelTalk.js"></script>
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

      // move-top-btn
      $(function() {
          $( '#btnTop' ).hide();
          $( window ).scroll( function() {
          if ( $( this ).scrollTop() > 400 ) {
            $( '#btnTop' ).fadeIn();
          } else {
            $( '#btnTop' ).fadeOut();
          }
          });

          $("#btnTop").click(function() {
              $('html, body').animate({
                  scrollTop : 0
              }, 100);
              return false;
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

    </script>
  </body>
</html>
<?php
  }catch(Exception $e){
  echo $e;
  }
?>
