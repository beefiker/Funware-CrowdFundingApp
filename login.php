<?php
  try {
  require 'dbInfo.php';
  include 'isSession.php';
  $ini = parse_ini_file('config.ini');

    if($user_login){
      echo "<script>location.href='index.php'</script>";
    }
  }catch(Exception $e){
    echo $e;
  }
 ?>
<!DOCTYPE html>
  <head>
  <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js" charset="utf-8"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/hellojs/1.19.2/hello.js"
      integrity="sha512-G/Vw6c6C9Z5y5ypd9BZaFRD0zgeD+gygazBzKCJcZmSJn29AFS1t+Plomp/R18Lpj+t5/Njy2WMnZLsyrfmJbg=="
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <title>펀웨어 - 로그인</title>
    <script>
      var googleUser = {};
      var startApp = function() {
        gapi.load('auth2', function(){
          // Retrieve the singleton for the GoogleAuth library and set up the client.
          auth2 = gapi.auth2.init({
            client_id: <?=$ini["g_client_id"]?>,
            additional_scope: 'profile email'
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
          });
          attachSignin(document.getElementById('customBtn'));
        });
      };
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
        /* 색 변수 xx */
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

      #login-container{
        /* background-color: salmon; */
        /* height: 1000px; */
        max-width: var(--width);
        margin: 0 auto;
        display: flex;
        justify-content: center;
      }
      #login-box{
        /* 추가_재영 */
        margin-top: 50px;
        background: var(--gray1);
        /* background: red; */
        background-image: linear-gradient(156deg, #e8ebf2, #f6f2f7);
        border-radius:10px;
        box-shadow:  14px 14px 15px #caccce,
                    -14px -14px 15px #ffffff;
    		max-width: 500px;
    		/* height: 769px; */
    		padding: 38px;

        opacity:0;
    	}
      #login-title{
        color:#212121;
        margin-bottom: 30px;
        font-size: 1.875rem;
        font-weight: 500;
      }
      #login-socialBox{
        /* background-color: grey; */
        text-align: center;
      }
      #social-login img{
        width: 44px;
        height: 44px;
        /* margin: 15px; */
        cursor: pointer;
      }
      /* 추가_재영 */
      input{
        border:0;
        border-radius:10px;
      }
      .login-input{
        width:100%;
        height: 49px;
        background:var(--gray0);
        /* background: #f1f3f5; */
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;

        padding:10px;
        font-size: 0.938;
        margin-bottom: 15px;
      }
      #msg-join{
        color: #666666;
        margin-top: 30px;
      }
      #btn-login{
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
        /* color: var(--mainColor); */
        /* color:white; */
        font-size: 1.313rem;
        font-weight: 500;
        transition: 0.5s ease;
      }
      #btn-login:hover{
        transition: 0.5s ease;
        background: var(--gray2);
      }
      #social-login{
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
        #wrap-container {
          width: 100%;
        }
        #login-container{
          max-width: 768px;
        }
        #login-box{
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
        #btn-login{
          width:280px;
          height:45px;
        }
      }
      @media (max-width: 375px) {
        #login-container{
          max-width: 375px;
        }
        #login-box{
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
                  <a class="topMenuItems" href="indexhelpCenter.html"><li>헬프센터</li></a>
              </ul>
            </div>
            <?php
            }
            ?>
          
      </div>

      <!-- login form -->
      <div id="login-container">
        <div id="login-box">
  				<p id="login-title">로그인</p>
  				<form id="login-form" action="" method="post">
            <div id="login-inputBox">
              <div class="emailForm">
            		<input type="text" id = "email" class="login-input" placeholder=" 이메일 주소 입력">
          		</div>
          		<div class="passForm">
            		<input type="password" id = "pw" class="login-input" placeholder=" 비밀번호 입력">
          		</div>
    					<img src="img/loginOr.png" style="width:100%;">
            </div>
  					<div id="login-socialBox">
              <div id="social-login">
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
                <!-- <div onClick="testAPI();"><img src="img/facebook@3x.png"></div> -->
                <!-- <div id="fb-root"></div>


                <div
                        class="fb-login-button"
                        data-width="44px"
                        data-size="small"
                        data-button-type="login_with"
                        data-layout="default"
                        data-auto-logout-link="false"
                        data-use-continue-as="false"
                        onlogin="checkLoginState();"
                >
                </div> -->
                <!-- <div id="status"></div> -->
                <div id="naver_id_login">
                  <!-- <img src="img/naver@3x.png"> -->
                </div>

                <div id="kakaoBtn"><a href="javascript:KakaoLogin();"><img src="img/kakao@3x.png"></a></div>
                </div>
                <br><span style="color: #666666;">소셜 네트워크로 로그인 하세요.</span><br><br>

    					<button type="submit" id="btn-login">로그인</button>
              <p id="msg-join">아직 FunWare 계정이 없으신가요? | <a href="join.php" style="color: #27a3ff;">가입하기<a></p>
              <a href="findPW.php" style="color: #27a3ff;">혹시 비밀번호를 잊으셨나요?</a>
            </div>
  				</form>
  			</div>
      </div>

    </div>

    <script src="js/burger.js"></script>
    <script>

    $(function () {
      $("body div").fadeIn(500, function () {
          $("#login-box").animate({
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

    $(function(){
      $('#btn-login').click(function(){
        // 이메일
        if($('#email').val().trim() == ""){
          alert('이메일 주소를 입력해주세요.');
          return;
        }else if($('#email').val().indexOf('@') == -1){
          alert('올바른 이메일 주소를 입력해주세요.');
          return;
        }
        // 비밀번호
        if($('#pw').val().trim() == ""){
          alert('비밀번호를 입력란을 확인해주세요.');
          return;
        }

        $("#login-form").submit();
        // 디비 돌려 ~~~~!~!!!!
        $.ajax({
          url: "ajax_src/ajaxLogin.php",
          type: "post",
          dataType: "json",
          async: true,
          data: {
            email:    $("#email").val(),
            password: $("#pw").val()
          },
          success: (res) => {
            console.log('1');
            if(res.success){
              // alert(res.msg);
              // location.replace('index.php');
              console.log('2');
            }else{
              alert(res.msg);
            }
          }
        });
        console.log('???');
      });
    });

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

        $.ajax({
          url: "ajax_src/ajaxSocialLogin.php",
          type: "post",
          dataType: "json",
          async: true,
          data: {
            email: profile.getEmail().trim(),
            name : profile.getName().trim()
          },
          success: (res) => {
            if(res.success){
              // alert(res.msg);
              // console.log('이동할 차례');
              location.replace('index.php');
            }else{
              alert(res.msg);
            }
          }
        });

      }, function(error) {
        alert(JSON.stringify(error, undefined, 2));
      });
    }

    let kakaoKey = '<?=$ini["kakao_key"]?>';
      // kakao
      Kakao.init(kakaoKey);
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
                console.log(res.kakao_account.email);
                document.getElementById("email").value = res.kakao_account.email;

                $.ajax({
                  url: "ajax_src/ajaxSocialLogin.php",
                  type: "post",
                  dataType: "json",
                  async: true,
                  data: {
                    email: res.kakao_account.email,
                    name : res.kakao_account.profile.nickname
                  },
                  success: (res) => {
                    if(res.success){
                      // alert(res.msg);
                      // console.log('이동할 차례');
                      location.replace('index.php');
                    }else{
                      alert(res.msg);
                    }
                  }
                });
              },
            });
          },
        });
      }

      //naver
      let naverKey = '<?=$ini["naver_key"]?>';
      var naver_id_login = new naver_id_login(naverKey, "http://beefiker.cafe24.com/funware/login.php");
      // var naver_id_login = new naver_id_login("ltuhWOjdAfK3qSseLYN5", "http://funware.shop/login_callback.html");
      var state = naver_id_login.getUniqState();
      // naver_id_login.setButton("white", 2,50);
      naver_id_login.setDomain("http://beefiker.cafe24.com/funware/");
      naver_id_login.setState(state);
      // naver_id_login.setPopup();
      naver_id_login.init_naver_id_login();

      if(naver_id_login.is_callback == true){
        naver_id_login.get_naver_userprofile("naverSignInCallback()");
      }

      function naverSignInCallback(res) {
        const email = naver_id_login.getProfileData("email");
        const nickname = naver_id_login.getProfileData("nickname");
        const name = naver_id_login.getProfileData("name");
        console.log(email);
        console.log(nickname);
        console.log(name);
        document.getElementById("email").value = email;

        $.ajax({
          url: "ajax_src/ajaxSocialLogin.php",
          type: "post",
          dataType: "json",
          async: true,
          data: {
            email: email,
            name : name
          },
          success: (res) => {
            if(res.success){
              // alert(res.msg);
              // console.log('이동할 차례');
              location.replace('index.php');
            }else{
              alert(res.msg);
            }
          }
        });
      }


    </script>

     <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

  </body>
</html>
