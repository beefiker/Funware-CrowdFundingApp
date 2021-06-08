<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';
  // echo $_SESSION["userName"].' --> My Page';
?>
<!doctype html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/hellojs/1.19.2/hello.js"
      integrity="sha512-G/Vw6c6C9Z5y5ypd9BZaFRD0zgeD+gygazBzKCJcZmSJn29AFS1t+Plomp/R18Lpj+t5/Njy2WMnZLsyrfmJbg=="
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/funware_src/nav.css">

    <title>find PW</title>

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
      /* 추가_재영 */
      body{
        background: var(--gray1);
      }


      *{font-family: 'Spoqa Han Sans Neo', 'sans-serif';}
      li {list-style: none;}
      /* a {text-decoration: none;} */

      #wrap-container{
        /* background-color: grey; */
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        margin: 0 auto;
      }

      #find-container{
        /* background-color: salmon; */
        opacity: 0;
        max-width: var(--width);
        margin: 0 auto;
        display: flex;
        justify-content: center;
      }
      #find-box{
        margin-top: 80px;
        background-image: linear-gradient(156deg, #e8ebf2, #f6f2f7);
        border-radius:10px;
        box-shadow:  14px 14px 15px #caccce,
                    -14px -14px 15px #ffffff;
    		width: 500px;
    		/* height: 769px; */
    		padding: 38px;
    	}
      #title{
        color:#212121;
        margin-bottom: 30px;
        font-size: 1.875rem;
        font-weight: 500;
      }
      #submitBox{
        text-align: center;
      }
      #ex_span{
        font-size: 1rem;
        color: #626262;
        margin-top: 15px;
        margin-bottom: 40px;
      }
      input{
        border:0;
        border-radius:10px;
      }
      #email{
        width:100%;
        height: 49px;
        margin-bottom: 15px;

        background: #f1f3f5;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
        padding:10px;
        font-size: 0.938rem;
      }
      #emailForm p{
        color: #626562;
        font-size: 1.063rem;
      }
      #btnSubmit{

        width:100%;
        height: 67px;
        /* 추가_재영 */
        border-radius:10px;
        border:0;
        background: var(--gray1);
        border-radius:10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #ffffff;
        color: #212121;
        font-size: 1.313rem;
        font-weight: 500;
        transition: 0.5s ease;
      }
      #btnSubmit:hover{
        transition: 0.5s ease;
        background: var(--gray2);
      }

      @media (max-width: 768px) {
        html{
          font-size:10px;
        }
        #find-container{
          max-width: 768px;
        }
        #find-box{
          max-width: 350px;
        }
        #email{
          height:32px;
        }
        #btnSubmit{
          width:280px;
          height:45px;
        }
      }
      @media (max-width: 375px) {
        #find-container{
          max-width: 375px;
        }
        #find-box{
          max-width: 325px;
          padding: 19px;
        }
      }

    </style>

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

      <!-- login form -->
      <div id="find-container">
        <div id="find-box">
  				<p id="title">비밀번호 찾기</p>
  				<form id="find-form" method="post">
            <div id="email-inputBox">
          		<div id="emailForm">
                <p>이메일 주소</p>
            		<input type="text" name="emailAd" class="pw" id="email" placeholder=" 가입하신 이메일 주소를 입력해주세요.">
          		</div>
            </div>
  					<div id="submitBox">
              <div id="ex_span">
                <span style="color: #666666;">
                  가입하셨던 이메일 주소를 입력하시면<br>
                  임시 비밀번호를 발급해드립니다.<br>
                </span>
              </div>

    					<button type="submit" id="btnSubmit" onclick="sendMail();">링크 발송</button>
            </div>
  				</form>
  			</div>
      </div>

    </div>

    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/burger.js"></script>
    <script>
      $(function () {
        $("body div").fadeIn(500, function () {
            $("#find-container").animate({
              "opacity": "1"
            },1000);
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

      let sendMail = () => {
        if($("#email").val().indexOf('@') == -1){
          alert('올바른 이메일 주소를 입력해주세요.');
        }else{
          alert('링크 발송 후 잠시 기다려주세요.');
          $.ajax({
            url: "ajaxMail.php",
            type: "post",
            dataType: "json",
            async: false,
            data: {
              email: $("#email").val()
            },
            success: (res) => {
              // alert("$isSend : " + res.isSend);
              if (res.isSend == true) {
                alert(res.done);
              } else {
                alert(res.fail);
              }
            },
          });
        }
      };
    </script>
  </body>
</html>
<?php
}catch(Exception $e){
  echo $e;
}
 ?>