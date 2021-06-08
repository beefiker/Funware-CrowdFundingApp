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
    $q_user = $db->query('SELECT * FROM funware_user WHERE ai_id = '.$_SESSION['userId'].'');
    $row_user = $q_user->fetch(PDO::FETCH_ASSOC);
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/funware_src/nav.css">

    <title>펀웨어 - 계정 정보 변경</title>

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
        background: #f1f3f5;
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

      #update-container{
        /* background-color: salmon; */
        /* height: 1000px; */
        max-width: var(--width);
        margin: 0 auto;
        display: flex;
        justify-content: center;
      }
      #update-box{
        /* 추가_재영 */
        margin-top: 50px;
        margin-bottom: 50px;
        border-radius:10px;
        box-shadow:  14px 14px 15px #caccce,
                    -14px -14px 15px #ffffff;
        background-image: linear-gradient(144deg, #e8ebf2, #f2f3f7 100%);
    		max-width: 500px;
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
        width: 80%;
        height: 49px;
        background: #f1f3f5;
        box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff;
        padding:10px;
        margin-bottom: 15px;
        font-size: 0.938rem;
      }
      .join-inputBtn{
        width: 15%;
        height: 49px;
        background: #d1d1d1;
        border: none;
        border-radius: 5px;
        /* box-shadow: inset 6px 6px 12px #e5e7e9,
                    inset -6px -6px 12px #fdffff; */
        padding:10px;
        margin-left: 10px;
        margin-bottom: 15px;
        font-size: 1.063rem;
        font-weight: 300;
      }

      #wrapAuthNumber{
        display: none;
      }

      #joinForm-footer{text-align: center;}
      #chkArea{
        margin: 0 auto;
        padding: 25px;
        display: flex;
        width: 70%;
        align-items:center;
        justify-content: space-between;
      }
      #chkArea span{
        font-size: 0.938rem;
        margin-left: 12px;
        color:#707070;
      }
      /* 토글 */
      /* .toggleBG{
        background: #CCCCCC;
        width: 68px;
        height: 29px;
        border: 1px solid #CCCCCC;
        border-radius: 15px;
      }
      .toggleFG{
        background: #FFFFFF;
        width: 26px;
        height: 26px;
        border: none;
        border-radius: 15px;
        position: relative; left: 0px;
      } */

      /* The switch - the box around the slider */
      .switch {
        position: relative;
        display: inline-block;
        width: 73px;
        /* width: 60px; */
        height: 34px;
        vertical-align:middle;
      }

      /* Hide default HTML checkbox */
      .switch input {display:none;}

      /* The slider */
      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: var(--mainColor);
      }

      input:focus + .slider {
        box-shadow: 0 0 1px var(--mainColor);
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }

      /* p {
        margin:0px;
        display:inline-block;
        font-size:15px;
        font-weight:bold;
      } */

      #btnChangeInfo{
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
      #btnChangeInfo:hover{
        transition: 0.5s ease;
        background: var(--gray2);
      }

      @media (max-width: 768px) {
        html{
          font-size:10px;
        }
        #update-container{
          max-width: 768px;
        }
        #update-box{
          max-width: 350px;
        }
        .join-input{
          height:32px;
        }
        .join-inputBtn{
          height:32px;
        }
        #btnChangeInfo{
          width:280px;
          height:45px;
        }
        #chkArea{
          width:75%;
        }
        .switch {
          width:40px;
          height:14px;
        }

      .slider:before {
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        left: 1px;
        bottom: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(14px);
        -ms-transform: translateX(14px);
        transform: translateX(14px);
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

      <!-- form -->
      <div id="update-container">
        <div id="update-box">
  				<p id="title">계정 정보 변경</p>
  				<form id="update-form" action="" method="post">
            <div>
              <div id="inputTop">
                <p class="input-title">이메일 변경</p>
            		<input type="text" id="email" class="join-input" placeholder=" <?=$row_user["f_email"]?>">
                <input type="button" id="btnChange" class="join-inputBtn" value="변경">
                <!-- <button type="button" id="btnChange" class="join-inputBtn" name="button">변경</button>  onclick="sendMail();" -->
                <div id="wrapAuthNumber">
                  <p>입력하신 이메일로 인증코드가 전송되었습니다.</p>
                  <input type="text" id="authNumber" class="join-input" placeholder=" 인증번호 입력">
                  <button type="button" id="btnAuthNum" class="join-inputBtn" name="button">확인</button>
                </div>
          		</div><br><br>
              <div id="inputBottom">
                <p class="input-title">비밀번호 변경</p>
            		<input type="password" id="currentPW" class="join-input" placeholder=" 현재 비밀번호 입력">
                <input type="password" id="newPW" class="join-input" placeholder=" 새 비밀번호 입력">
                <input type="password" id="checkNewPW" class="join-input" placeholder=" 새 비밀번호 확인">
                <input type="button" id="btnCheckPW" class="join-inputBtn" value="확인">
          		</div>
            </div>
            <div id="chkboxes">
              <label id="chkArea">
                <span>이벤트 · 혜택 수신 동의</span>
                <!-- <div class='toggleBG'>
                    <button type="button" id="tglBtn" class='toggleFG'></button>
                </div> -->
                <label class="switch">
                  <input type="checkbox" id="checkMarketing">
                  <span class="slider round"></span>
                </label>
                <!-- <p>OFF</p><p style="display:none;">ON</p> -->
              </label>
            </div>
            <div id="joinForm-footer">
    					<button type="button" id="btnChangeInfo">변경하기</button>
            </div>
  				</form>
  			</div>
      </div>

    </div>
                        
    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/channelTalk.js"></script>
    <script src="js/burger.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js">// onOff</script>
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


      let memberDivNum = 0;
      let passChecked = false;
      let changeWhat = "";
      let agreeMarketing = false;

      // 마케팅 동의 여부
      $("#checkMarketing").click(function(){
        agreeMarketing = ($(this).is(":checked") == true) ? true : false;
      });
      
      
      // 인증코드 전송
      $('#btnChange').click(function() {
        if($("#email").val().indexOf('@') == -1){
          alert('올바른 이메일 주소를 입력해주세요.');
        }else{
          $.ajax({
            url: "ajax_src/ajaxChangeEmail.php",
            type: "post",
            dataType: "json",
            async: false,
            data: {
              email: $("#email").val(),
              authNum : $("#authNumber").val(),
              workNum : 1,
              memberDiv : memberDivNum,
              agreeMarketing : agreeMarketing
            },
            success: (res) => {
              // $("#wrapAuthNumber > p").html("success");
              if(res.memberDiv == 2){
                alert('이미 가입된 이메일입니다.');
                memberDivNum = res.memberDiv;
              }else{
                $("#wrapAuthNumber").slideDown();
                memberDivNum = res.memberDiv;
                console.log(memberDivNum);
              }
              console.log(res.msg);
            },
          });
        }
      });

      // 인증코드 확인
      $('#btnAuthNum').click(function() {
        if($("#authNumber").val() == ""){
          alert('인증코드를 입력해주세요.');
        }else{
          // 인증코드 일치여부 확인(ajax)
          $.ajax({
            url: "ajax_src/ajaxChangeEmail.php",
            type: "post",
            dataType: "json",
            async: false,
            data: {
              email: $("#email").val(),
              authNum : $("#authNumber").val().trim(),
              workNum : 2,
              memberDiv : memberDivNum,
              agreeMarketing : agreeMarketing
            },
            success: (res) => {
              console.log("something");
              // console.log(res.msg);

              if(res.authSuccess){
                $("#wrapAuthNumber > p").html("인증되었습니다. <br>이메일 변경을 완료하려면 아래 변경하기 버튼을 눌러주세요.");
                changeWhat = "email";
                console.log(memberDivNum);
                console.log(changeWhat);
              }else{
                $("#wrapAuthNumber > p").html("인증코드를 확인해주세요.");
              }
              
            },
          });
        }
      });

      // 비밀번호 확인
      $("#btnCheckPW").click(function() {

        if($("#currentPW").val() == "" || $("#newPW").val() == "" || $("#checkNewPW").val() == ""){
          alert('입력란을 확인해주세요.');
        }else{
          if($("#newPW").val() === $("#checkNewPW").val()){
            $.ajax({
              url: "ajax_src/ajaxChangePW.php",
              type: "post",
              dataType: "json",
              // async: false,
              data: {
                currentPW: $("#currentPW").val(),
                newPW : $("#newPW").val(),
                checkNewPW : $("#checkNewPW").val(),
                workNum : 1,
                agreeMarketing : agreeMarketing
              },
              success: (res) => {
                if(res.currChecked){
                  console.log('현재 비밀번호 일치');
                  changeWhat = "password";
                  passChecked = true;
                  alert('확인되었습니다.');
                }else{
                  console.log('현재 비밀번호 불일치');
                  alert('현재 비밀번호가 아닙니다.');
                }
              },
            });

          }else{
            alert('비밀번호가 다릅니다.');
          }
        }
        
      });

      // 이메일/비밀번호 변경 btnChangeInfo
      $("#btnChangeInfo").click(function() {
        if(changeWhat === "email"){
          // 이메일 변경
          console.log('이메일 바꿀 차례');
          $.ajax({
            url: "ajax_src/ajaxChangeEmail.php",
            type: "post",
            dataType: "json",
            async: false,
            data: {
              email: $("#email").val(),
              authNum : $("#authNumber").val().trim(),
              workNum : 3,
              memberDiv : memberDivNum,
              agreeMarketing : agreeMarketing
            },
            success: (res) => {
              console.log(agreeMarketing);
              console.log(res.msg);
              if(res.authSuccess){
                alert('이메일이 변경되었습니다.');
                $("#wrapAuthNumber > p").html("인증 성공");
              }else{
                alert('인증코드가 다릅니다');
              }
              
            },
          });

        }else if(changeWhat === "password"){
          // 비밀번호 변경
          $.ajax({
            url: "ajax_src/ajaxChangePW.php",
            type: "post",
            dataType: "json",
            // async: false,
            data: {
              currentPW: $("#currentPW").val(),
              newPW : $("#newPW").val(),
              checkNewPW : $("#checkNewPW").val(),
              workNum : 2,
              agreeMarketing : agreeMarketing
            },
            success: (res) => {
              console.log(res.pwChanged);
              if(res.pwChanged){
                alert('비밀번호가 변경되었습니다.');
                history.back();
              }else{
                alert('비밀번호 변경란을 작성하신 후 확인 버튼을 눌러주세요.');
              }
            },
          });
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
