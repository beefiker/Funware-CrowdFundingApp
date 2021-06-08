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
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="323698797619-ua4vnqpmas2nsqdrvdr3vdepuuj0nnjn.apps.googleusercontent.com">

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/hellojs/1.19.2/hello.js"
      integrity="sha512-G/Vw6c6C9Z5y5ypd9BZaFRD0zgeD+gygazBzKCJcZmSJn29AFS1t+Plomp/R18Lpj+t5/Njy2WMnZLsyrfmJbg=="
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/funware_src/nav.css">

    <title>펀웨어 - 회원가입</title>
    <script>
      var googleUser = {};
      var startApp = function() {
        gapi.load('auth2', function(){
          // Retrieve the singleton for the GoogleAuth library and set up the client.
          auth2 = gapi.auth2.init({
            client_id: '323698797619-ua4vnqpmas2nsqdrvdr3vdepuuj0nnjn.apps.googleusercontent.com',
            additional_scope: 'profile email'
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
          });
          attachSignin(document.getElementById('customBtn'));
        });
      };

      function attachSignin(element) {
        // console.log(element.id);
        auth2.attachClickHandler(element, {},
        function(googleUser) {
          var profile = googleUser.getBasicProfile();
          console.log(profile);
          console.log("ID: " + profile.getId()); // Do not send to your backend! Use an ID token instead.
          console.log("Name: " + profile.getName());
          console.log("Image URL: " + profile.getImageUrl());
          console.log("Email: " + profile.getEmail()); // This is null if the 'email' scope is not present.
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
      }
      </script>

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
      /* a {text-decoration: none;} */

      #wrap-container{
        /* background-color: grey; */
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        margin: 0 auto;
      }

      #join-container{
        /* background-color: salmon; */
        /* height: 1000px; */
        max-width: var(--width);
        margin: 0 auto;
        display: flex;
        justify-content: center;
      }
      #join-box{
        /* 추가_재영 */
        margin-top: 50px;
        background: var(--gray1);
        border-radius:10px;
        box-shadow:  14px 14px 15px #caccce,
                    -14px -14px 15px #ffffff;
    		/* border: solid 1px #eaeaea; */
    		max-width: 500px;
    		/* height: 769px; */
    		padding: 38px;

        opacity: 0;
    	}
      #title{
        color:#212121;
        margin-bottom: 30px;
        font-size: 1.875rem;
        font-weight: 500;
      }
      #socialBox{
        /* background-color: grey; */
        text-align: center;
      }
      #social img{
        width: 44px;
        height: 44px;
        /* margin: 12.5px; */
        cursor: pointer;
      }
      #msg-join{
        color: #666666;
        margin-top: 30px;
      }
      #btn-join{
        border:0;
        background: var(--gray1);
        border-radius:10px;
        box-shadow:  10px 10px 11px #e2e3e4,
                    -10px -10px 11px #ffffff;
        width:100%;
        height: 67px;
        color: #666666;
        font-size: 1.125rem;
        transition: 0.5s ease;
      }
      /* 추가_재영 */
      #btn-join:hover{
        background: var(--gray2);
        transition: 0.5s ease;
      }

      #social{
        width:60%;
        margin:0 auto;
        /* background:red; */
        display:flex;
        justify-content:space-around;
      }
      #customBtn {
        display: inline-block;
        color: #444;
        width: 44px;
        border-radius: 50%;
        white-space: nowrap;
      }
      #customBtn:hover {
        cursor: pointer;
      }
      span.label {
        font-family: serif;
        font-weight: normal;
      }
      .fb-login-button{
        all:unset;
        width:44px;
        height:44px;
        background:red;
      }
      #naver_id_login{
        /* background:red; */
        /* background-img: 'img/naver@3x.png'; */
        background: center url('img/naver@3x.png');
        /* background-size: 50px; */
        width:44px;
        height:44px;
        border-radius:70%;
        overflow: hidden;
      }

      @media (max-width: 768px) {
        html{
          font-size:10px;
        }
        #join-container{
          max-width: 768px;
        }
        #join-box{
          max-width: 350px;
          padding: 19px;
        }
        .login-input{
          height:32px;
        }
        #customBtn, #customBtn > span > img {
          width:30px;
          height:30px;
        }
        #naver_id_login, #naver_id_login > a > img{
          width:30px;
          height:30px;
        }
        #kakaoBtn > a > img{
          width:30px;
          height:30px;
        }
        #btn-join{
          width:280px;
          height:45px;
        }
        #btn-join > img{
          width:26.5px;
          height:26.5px;
        }
      }
      @media (max-width: 375px) {
        #join-container{
          max-width: 375px;
        }
        #join-box{
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
                <div id="burgerMenu"></div>
                <div id="logo">
                    <a class="nav-brand" href="http://funware.shop/"><b>FunWare</b></a>
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
                              <img class="profileImg" src="img/defaultProfile.jpg">
                              <?=$_SESSION["userName"]?> 님
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
                      <li><a class="dropdown-item" href="#">둘</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">기타</a></li>
                    </ul>
                  </li>
                </div>
              </div>
            </div>
          </nav>
        </div>
        <div id="topMenu">
      <ul>
        <a class="topMenuItems" href="http://funware.shop"><li>프로젝트 둘러보기</li></a>
        <a class="topMenuItems" href="http://funware.shop/newProject.php"><li>프로젝트 만들기</li></a>
        <a class="topMenuItems isLoggedIn" href="http://funware.shop/login.php"><li>로그인</li></a>
        <a class="topMenuItems isLoggedIn" href="http://funware.shop/join.php"><li>회원가입</li></a>
        <a class="topMenuItems isLoggedOut" href="http://funware.shop/logout.php"><li>로그아웃</li></a>
        <a class="topMenuItems" href="http://funware.shop/notice.php"><li>공지사항</li></a>
      </ul>
    </div>
      </div>

      <!-- join form -->
      <div id="join-container">
        <div id="join-box">
  				<p id="title">회원가입</p>
					<button type="" id="btn-join" onclick = "location.href='joinDetail.php'">
						<img src="img/email.png" style="margin-right:8.9px;">
						이메일로 회원가입
					</button>
					<img src="img/loginOr.png" style="width:100%;">
  				<div id="socialBox">
            <div id="social">
              <div id="customBtn"  class="customGPlusSignIn" data-onsuccess="onSignIn"  data-width="44px" data-height="44px">
                <div id="gSignInWrapper">
                  <div id="customBtn" class="customGPlusSignIn">
                    <span class="icon">
                      <img src="img/google@3x.png" width="44px" height="44px" alt="" srcset="">
                    </span>
                  </div>
                </div>
                <script>startApp();</script>
              </div>
                <!-- <div><img src="img/facebook@3x.png"></div> -->
                <div id="naver_id_login">
                  <!-- <img src="img/naver@3x.png"> -->
                </div>
                <div id="kakaoBtn"><a href="javascript:KakaoLogin();"><img src="img/kakao@3x.png"></a></div>
    					</div><br>
              <br><span style="color: #666666;">소셜 네트워크로 회원가입 해보세요</span>
              <p id="msg-join">이미 FunWare계정이 있으신가요?</p>
              <a href="login.php" style="color: #27a3ff;">기존 계정으로 로그인하기</a>
            </div>
  			</div>
      </div>

    </div>

    <script src="js/burger.js"></script>
    <script>
    $(function () {
      $("body div").fadeIn(500, function () {
          $("#join-box").animate({
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

      // google
      function attachSignin(element) {
        // console.log(element.id);
        auth2.attachClickHandler(element, {},
        function(googleUser) {
          var profile = googleUser.getBasicProfile();
          console.log(profile);
          console.log("ID: " + profile.getId()); // Do not send to your backend! Use an ID token instead.
          console.log("Name: " + profile.getName());
          console.log("Image URL: " + profile.getImageUrl());
          console.log("Email: " + profile.getEmail()); // This is null if the 'email' scope is not present.
          document.getElementById("email").value = profile.getEmail();
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
      }

      // kakao
      Kakao.init("44cfdd71653ef421c5abf5335ce7665c");
      console.log("Init state : " + Kakao.isInitialized());
      function KakaoLogin() {
        Kakao.Auth.login({
          scope: "profile, account_email, gender",
          success: function (authObj) {
            console.log(authObj);
            Kakao.API.request({
              url: "/v2/user/me",
              success: (res) => {
                console.log(res.kakao_account);
              },
            });
          },
        });
      }

      //naver
      var naver_id_login = new naver_id_login("ltuhWOjdAfK3qSseLYN5", "http://localhost/login_callback.html");
      var state = naver_id_login.getUniqState();
      // naver_id_login.setButton("white", 2,50);
      naver_id_login.setDomain("http://funware.shop/");
      naver_id_login.setState(state);
      // naver_id_login.setPopup();
      naver_id_login.init_naver_id_login();

    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
  </body>
</html>
<?php
}catch(Exception $e){
  echo $e;
}
 ?>