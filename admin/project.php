<?php
  try {
  require 'dbInfo.php';
  include 'isSession.php';
  }catch(Exception $e){
    echo $e;
  }
    
  if(!$user_login) {
    echo "<script>";
    echo    "alert('로그인이 필요한 서비스입니다.');";
    echo    "location.href='login.php'";
    echo "</script>";
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Funware Admin Console</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
  <link href="css/addons/datatables.min.css" rel="stylesheet">

</head>
<style>
  input[type=text] {
    color : black;
    border: none;
    background : aliceblue;
}
input[type=date] {
    color: black;
    border: none;
    background: aliceblue;
  }
  #sidebar{
    position:fixed;
  }
  @media (min-width: 991px){
.main-panel{
  position: absolute;
  margin-left:270px;
  }
}

</style>


<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="assets/images/logo.svg" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
          <img src="assets/images/logo-mini.svg" alt="logo" /> </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +8210 8559 2680</li>
     
        </ul>
     
        
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
              <img class="img-xs rounded-circle" src="img/cat.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
              <?php
 echo '<p class="profile-name">'.$_SESSION['user_id'].'</p>';
?>
                <p class="designation">Premium user</p>
              </div>
            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Main</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="project.php">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Project</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payment.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Payment History</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notice.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Notice/Event</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="etp.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">Enterprise</span>
            </a>
          </li>
          <?php
          if(!isset($_SESSION['user_id'])){
          ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">login</span>
            </a>
          </li>
          <?
          }else{
          ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="menu-icon typcn typcn-th-large-outline"></i>
              <span class="menu-title">logout</span>
            </a>
          </li>
          <?
          }
        ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-12">
              <div class="page-header">
                <h4 class="page-title">Project</h4>
                <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                  <ul class="quick-links">
                    <li><a href="#project">Project data</a></li>
                    <li><a href="#reward">Reward data</a></li>
                    <li><a href="#story">Story line data</a></li>
                    <li><a href="#img">Img line data</a></li>
                  </ul>
                </div>
              </div>
            </div>
           
          </div>
          <!-- Page Title Header Ends-->

         
          <div class="row">
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                        
                      </div>
                      <p>Project Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">f_div

                                  </th>
                                  <th class="th-sm">ai_project_id

                                  </th>
                                  <th class="th-sm">f_project_name

                                  </th>
                                  <th class="th-sm">f_donate_limit

                                  </th>
                                  <th class="th-sm">f_cardbank

                                  </th>
                                  
                                  <th class="th-sm">f_cardnum

                                  </th>
                                  <th class="th-sm">auto_date

                                  </th>
                                  <th class="th-sm">f_date_limit

                                  </th>
                                  <th class="th-sm">f_par_value

                                  </th>
                                  <th class="th-sm">sys_register_id

                                  </th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_project'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["f_div"].'</td>';
                                      echo '<td>'.$row["ai_project_id"].'</td>';
                                      echo '<td>'.$row["f_project_name"].'</td>';
                                      echo '<td>'.$row["f_donate_limit"].'</td>';
                                      echo '<td>'.$row["f_cardbank"].'</td>';
                                      echo '<td>'.$row["f_cardnum"].'</td>';
                                      echo '<td>'.$row["auto_date"].'</td>';
                                      echo '<td>'.$row["f_date_limit"].'</td>';
                                      echo '<td>'.$row["f_par_value"].'</td>';
                                      echo '<td>'.$row["sys_register_id"].'</td>';
                                      
                                    echo '</tr>';
                                  }
                                ?>
                              </tbody>

                            </table>
                          </div>
                          <a name="project"></a>
                        </div>
                      </div>

                    </div>


                  </div>
                </div>
               
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                        
                      </div>
                      <p>Project Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample2" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">Y/N

                                  </th> 
                                  <th class="th-sm">ai_project_id

                                  </th>
                                  <th class="th-sm">sys_register_id

                                  </th>
                                  <th class="th-sm">f_project_name

                                  </th>
                                  <th class="th-sm">f_donate_limit

                                  </th>
                                  <th class="th-sm">f_cardbank

                                  </th>
                                  
                                  <th class="th-sm">f_cardnum

                                  </th>
                                  <th class="th-sm">auto_date

                                  </th>
                                  <th class="th-sm">f_date_limit

                                  </th>
                                  <th class="th-sm">f_par_value

                                  </th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_project'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input style="width: 2em"; type="text" name="f_div" value='.$row["f_div"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.$row["ai_project_id"].'</td>';
                                      echo '<td>'.$row["sys_register_id"].'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_project_name" value="'.$row["f_project_name"].'"> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_donate_limit" value='.$row["f_donate_limit"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_cardbank" value='.$row["f_cardbank"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_cardnum" value='.$row["f_cardnum"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="date" name="auto_date" value='.$row["auto_date"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="date" name="f_date_limit" value='.$row["f_date_limit"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_par_value" value='.$row["f_par_value"].'> <input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                    
                                    echo '</tr>';
                                  }
                                ?>
                              </tbody>

                            </table>
                            <a name="reward"></a>     
                          </div>
                        </div>
                      </div>

                    </div>
                       

                  </div>
                </div>
                
                <div class="col-md-12 grid-margin">
               
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                        
                      </div>
                     
                      <p>Reward Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample4" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                    <th class="th-sm">Y/N

                                    </th>
                                  <th class="th-sm">project.f_div

                                  </th>
                                  <th class="th-sm">ai_project_id

                                  </th>
                                  <th class="th-sm">ai_rewards

                                  </th>
                                  <th class="th-sm">f_project_name

                                  </th>
                                  <th class="th-sm">f_reward_div

                                  </th>
                                  <th class="th-sm">f_reward_desc

                                  </th>
                                  <th class="th-sm">f_reward_cont

                                  </th>
                                  <th class="th-sm">f_reward_money

                                  </th>
                                  
                                </tr>
                                
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT funware_project.f_div as p_div
                                                          ,ai_project_id
                                                          ,ai_rewards
                                                          ,f_project_name
                                                          ,f_reward_div
                                                          ,f_reward_desc
                                                          ,f_reward_cont
                                                          ,f_reward_money
                                                          ,funware_rewards.f_div as r_div
                                                  FROM funware_project
                                                  LEFT JOIN funware_rewards
                                                    ON funware_project.ai_project_id = funware_rewards.sys_project_id'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                    echo '<td>'.'<form action="update/update_project.php" method="post"><input style="width: 2em"; type="text" name="r_div" value='.$row["r_div"].'> <input type="hidden" name="ai_rewards" value='.$row["ai_rewards"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.$row["p_div"].'</td>';
                                      echo '<td>'.$row["ai_project_id"].'</td>';
                                      echo '<td>'.$row["ai_rewards"].'</td>';
                                      echo '<td>'.$row["f_project_name"].'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_reward_div" value="'.$row["f_reward_div"].'"> <input type="hidden" name="ai_rewards" value='.$row["ai_rewards"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_reward_desc" value="'.$row["f_reward_desc"].'"> <input type="hidden" name="ai_rewards" value='.$row["ai_rewards"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_reward_cont" value="'.$row["f_reward_cont"].'"> <input type="hidden" name="ai_rewards" value='.$row["ai_rewards"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post"><input type="text" name="f_reward_money" value="'.$row["f_reward_money"].'"> <input type="hidden" name="ai_rewards" value='.$row["ai_rewards"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                    echo '</tr>';
                                  }
                                ?>
                              </tbody>

                            </table>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a name="story"></a>
                </div>
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                       
                      </div>
                      <p>StoryLine Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                        
                          <div class="table-responsive">
                            <table id="dtBasicExample3" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">ai_project_id

                                  </th>
                                  <th class="th-sm">f_project_name

                                  </th>
                                  <th class="th-sm">f_storyline

                                  </th>
                                  <th class="th-sm">f_summary

                                  </th>
                                </tr>
                                
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_project'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["ai_project_id"].'</td>';
                                      echo '<td>'.$row["f_project_name"].'</td>';
                                      echo '<td><form action="update/update_project.php" method="post"><textarea name="f_storyline" cols="70" rows="4">'.$row["f_storyline"].'</textarea><input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset;" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                      echo '<td><form action="update/update_project.php" method="post"><textarea name="f_summary" cols="70" rows="4">'.$row["f_summary"].'</textarea><input type="hidden" name="ai_project_id" value='.$row["ai_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                    echo '</tr>';
                                  }
                                ?>
                              </tbody>

                            </table>
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                      </div>
                      <p>Img Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                        <a name="img"></a>
                          <div class="table-responsive">
                            <table id="dtBasicExample5" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">sys_project_id

                                  </th>
                                  <th class="th-sm">f_thumbnail

                                  </th>
                                  <th class="th-sm">f_thumbnail_big

                                  </th>
                                  <th class="th-sm">f_storyline_img

                                  </th>
                                  <th class="th-sm">f_summary_img

                                  </th>
                                  <th class="th-sm">f_gamepv

                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_img'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["sys_project_id"].'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post" enctype="multipart/form-data"><input type="file" name="f_thumbnail" value='.$row["f_thumbnail"].'><textarea name="" cols="70" rows="1">'.$row["f_thumbnail"].'</textarea> <input type="hidden" name="ai_img" value='.$row["ai_img"].'><input type="hidden" name="sys_project_id" value='.$row["sys_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post" enctype="multipart/form-data"><input type="file" name="f_thumbnail_big" value='.$row["f_thumbnail_big"].'><textarea name="" cols="70" rows="1">'.$row["f_thumbnail_big"].'</textarea> <input type="hidden" name="ai_img" value='.$row["ai_img"].'><input type="hidden" name="sys_project_id" value='.$row["sys_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post" enctype="multipart/form-data"><input type="file" name="f_storyline_img" value='.$row["f_storyline_img"].'><textarea name="" cols="70" rows="1">'.$row["f_storyline_img"].'</textarea> <input type="hidden" name="ai_img" value='.$row["ai_img"].'><input type="hidden" name="sys_project_id" value='.$row["sys_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_project.php" method="post" enctype="multipart/form-data"><input type="file" name="f_summary_img" value='.$row["f_summary_img"].'><textarea name="" cols="70" rows="1">'.$row["f_summary_img"].'</textarea> <input type="hidden" name="ai_img" value='.$row["ai_img"].'><input type="hidden" name="sys_project_id" value='.$row["sys_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td><form action="update/update_project.php" method="post"><textarea name="f_gamepv" cols="70" rows="1">'.$row["f_gamepv"].'</textarea><input type="hidden" name="ai_img" value='.$row["ai_img"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                    echo '</tr>';
                                  }
                                ?>
                              </tbody>

                            </table>
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                    

              </div>

              <!-- content-wrapper ends -->
              <!-- partial:partials/_footer.html -->
              <footer class="footer">
                <div class="container-fluid clearfix">
                  <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                    bootstrapdash.com 2020</span>
                  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                      href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                      templates</a> from Bootstrapdash.com</span>
                </div>
              </footer>
              <!-- partial -->
            </div>
            <!-- main-panel ends -->
          
          <!-- page-body-wrapper ends -->
        
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
     
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="assets/js/demo_1/dashboard.js"></script>
        <!-- End custom js for this page-->
        
        <script type="text/javascript" src="js/addons/datatables.min.js"></script>
        <script>
          $(document).ready(function () {

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample').DataTable({
              ordering: true,
              "responsive": true
            });
          });
          $(document).ready(function () {

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample2').DataTable({

              ordering: false,
              "responsive": true
            });
          });
          $(document).ready(function () {

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample3').DataTable({

              ordering: false,
              "responsive": true
            });
            });
            $(document).ready(function () {

              $('.dataTables_length').addClass('bs-select');
              $('#dtBasicExample4').DataTable({

                ordering: false,
                "responsive": true
              });
              });
              $(document).ready(function () {

              $('.dataTables_length').addClass('bs-select');
              $('#dtBasicExample5').DataTable({

                ordering: false,
                "responsive": true
              });
              });
        </script>
        
</body>

</html>