<?php
try {
  require 'dbInfo.php';
  include 'isSession.php';
  // echo $_SESSION["userName"].' --> My Page';
?>
<!doctype html>
  <head>
    <link rel="shortcut icon" href="img/funwareFavicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/funware_src/nav.css">
    <script
      type="text/javascript"
      src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js"
      charset="utf-8"
    ></script>

    <title>펀웨어 - 회원가입</title>

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

      #join-container{
        /* background-color: salmon; */
        /* height: 1000px; */
        opacity: 0;
        max-width: var(--width);
        margin: 0 auto;
        display: flex;
        justify-content: center;
      }
      #join-box{
        /* 추가_재영 */
        margin-top: 50px;
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
      /* 추가_재영 */
      input{
        border:0;
        border-radius:10px;
      }
      .input-title{
        font-size: 1.063rem;
        color: #626562;
      }
      .join-input{
        width:100%;
        height: 49px;
        background: #f1f3f5;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
        padding:10px;
        margin-bottom: 15px;
        font-size: 0.938rem;
      }
      #joinForm-footer{text-align: center;}
      #chkboxes{margin: 10px 0px 26px 130px;}
      #chkboxes  span{
        font-size: 0.938rem;
        margin-left: 12px;
        color:#707070;
      }
      #chkboxes span a{
        text-decoration: none;
        /* color: #707070; */
      }
      #msg-join{
        color: #707070;
        margin-top: 30px;
      }
      #btn-join{
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
      #btn-join:hover{
        transition: 0.5s ease;
        background: var(--gray2);
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
        .join-input{
          height:32px;
        }
        #btn-join{
          width:280px;
          height:45px;
        }
        #btn-join > img{
          width:26.5px;
          height:26.5px;
        }
        #chkboxes{
          width:100%;
          margin-left:80px;
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
      <div id="join-container">
        <div id="join-box">
  				<p id="title">이메일로 가입하기</p>
  				<form id="join-form" action="" method="post">
            <div id="inputBox">
              <div id="inputName">
                <p class="input-title">이름</p>
            		<input type="text" id="name" class="join-input" placeholder=" 사용하실 이름을 입력해주세요.">
          		</div>
              <div id="inputEmail">
                <p class="input-title">이메일 주소</p>
            		<input type="text" id="email" class="join-input" placeholder=" 이메일 주소를 입력해주세요.">
          		</div>
          		<div id="inputPW">
                <p class="input-title">비밀번호</p>
            		<input type="password" id="pw" class="join-input" placeholder=" 비밀번호를 입력해주세요.">
                <input type="password" id="chkPW" class="join-input" placeholder=" 비밀번호를 확인합니다.">
          		</div>
            </div>
            <div id="chkboxes">
            <div>
               <input type="checkbox" id="chkTerm" value=""/>
               <span><a href="javascript:void(window.open('termsPrivacy.html', '_blank','width=525, height=635, top=80, left=500, location=no'))">
                 <u>이용약관</u>
               </a>동의하기</span>
               </div>
               <div>
               <input type="checkbox" id="chkMkt" value=""/>
               <span>마케팅 수신 동의하기</span>
               </div>
            </div>
            <div id="joinForm-footer">
    					<button type="button" id="btn-join">회원가입</button>
              <p id="msg-join">이미 FunWare계정이 있으신가요?</p>
              <a href="login.php" style="color: #27a3ff;">기존 계정으로 로그인하기</a>
            </div>
  				</form>
  			</div>
      </div>

    </div>

    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/burger.js"></script>
    <script>
      $(function(){
        const { href } = location;
        const tempEmail = href.indexOf('=');
        if(tempEmail === -1){
          console.log('없엉');
        }else{
          const queryEmail = href.slice(tempEmail+1);
          console.log(queryEmail);
          document.getElementById("email").value = queryEmail;
        }

        $("body div").fadeIn(500, function () {
          $("#join-container").animate({
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

      // naver
      var naver_id_login = new naver_id_login("ltuhWOjdAfK3qSseLYN5", "http://funware.shop/joinDetail.php");
      // 접근 토큰 값 출력
      // console.log("토큰 : " + naver_id_login.oauthParams.access_token);
      // 네이버 사용자 프로필 조회
      naver_id_login.get_naver_userprofile("naverSignInCallback()");
      // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
      function naverSignInCallback(res) {
        const email = naver_id_login.getProfileData("email");
        const nickname = naver_id_login.getProfileData("nickname");
        const name = naver_id_login.getProfileData("name");
        console.log(email);
        console.log(nickname);
        console.log(name);
        document.getElementById("email").value = email;
      }

      $(function(){
        $('#btn-join').click(function(){
          // 이름
          if($('#name').val().trim() == ""){
            alert('이름을 입력해주세요.');
            return;
          }
          // 이메일
          if($('#email').val().trim() == ""){
            alert('이메일 주소를 입력해주세요.');
            return;
          }else if($('#email').val().indexOf('@') == -1){
            alert('올바른 이메일 주소를 입력해주세요.');
            return;
          }
          // 비밀번호
          if($('#pw').val().trim() == "" || $('#chkPW').val().trim() == ""){
            alert('비밀번호를 입력란을 확인해주세요.');
            return;
          }else if($('#pw').val() != $('#chkPW').val()){
            alert('비밀번호가 일치하지 않습니다.');
            return;
          }
          // 이용약관
          if($('#chkTerm').is(":checked") == false){
            alert('이용약관에 동의하셔야 서비스 이용이 가능합니다.');
            return;
          }

          $("#join-form").submit();
          // $("#name").val(currentUserInputName);
          // 디비 돌려 ~~~~!~!!!!
          $.ajax({
            url: "ajax_src/ajaxJoin.php",
            type: "post",
            dataType: "json",
            async: false,
            data: {
              name:     $("#name").val(),
              email:    $("#email").val(),
              password: $("#pw").val(),
              chkMkt:   $("#chkMkt").is(":checked")
            },
            success: (res) => {
              if(res.msg){
                alert('가입이 완료되었습니다.');
                // window.location.assign('login.php');
                // 페이지 이동이 왜 안 될까앙
                location.replace('login.php');
              }else{
                alert('이미 가입된 이메일입니다.');
              }
            },
          });
        })
      })
    </script>
  </body>
</html>
<?php
}catch(Exception $e){
  echo $e;
}
 ?>