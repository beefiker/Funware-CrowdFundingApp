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
                <h4 class="page-title">Enterprise</h4>
                <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                 
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
                      <p>funware_enterprise Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">ai_enterprise_id

                                  </th>
                                  <th class="th-sm">sys_project_id

                                  </th>
                                  <th class="th-sm">f_etp_name

                                  </th>
                                  <th class="th-sm">f_etp_desc

                                  </th>
                                  <th class="th-sm">f_etp_logo

                                  </th>
                                  <th class="th-sm">f_etp_url

                                  </th>
                                  <th class="th-sm">f_etp_value

                                  </th>
                                  <th class="th-sm">f_etp_ir

                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_enterprise'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["ai_enterprise_id"].'</td>';
                                      echo '<td>'.$row["sys_project_id"].'</td>';
                                      echo '<td><form action="update/update_etp.php" method="post"><textarea name="f_etp_name" cols="20" rows="1">'.$row["f_etp_name"].'</textarea><input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                      echo '<td><form action="update/update_etp.php" method="post"><textarea name="f_etp_desc" cols="70" rows="3">'.$row["f_etp_desc"].'</textarea><input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form></td>';
                                      echo '<td>'.'<form action="update/update_etp.php" method="post"><input type="text" name="f_etp_logo" value='.$row["f_etp_logo"].'> <input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_etp.php" method="post"><input type="text" name="f_etp_url" value='.$row["f_etp_url"].'> <input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_etp.php" method="post"><input type="text" name="f_etp_value" value='.$row["f_etp_value"].'> <input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                      echo '<td>'.'<form action="update/update_etp.php" method="post"><input type="text" name="f_etp_ir" value='.$row["f_etp_ir"].'> <input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
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
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                        
                      </div>
                      <p>Ent Value Change</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample2" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">ai_enterprise_id

                                  </th>
                                  <th class="th-sm">sys_project_id

                                  </th>
                                  <th class="th-sm">f_etp_name

                                  </th>
                                  
                                  <th class="th-sm">f_etp_value

                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_enterprise'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["ai_enterprise_id"].'</td>';
                                      echo '<td>'.$row["sys_project_id"].'</td>';
                                      echo '<td><textarea name="f_etp_name" cols="20" rows="1">'.$row["f_etp_name"].'</textarea><input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'></td>';
                                      echo '<td>'.'<form  action="update/update_etp_change.php" method="post"><input type="text" name="f_etp_value" value='.$row["f_etp_value"].'> &nbsp; &nbsp; &nbsp; &nbsp; <input type="text" name="f_etp_value_change" value=""><input type="hidden" name="ai_enterprise_id" value='.$row["ai_enterprise_id"].'><input type="hidden" name="sys_project_id" value='.$row["sys_project_id"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
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
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                      </div>
                      <p>funware_enterprise_change Table</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample3" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">sys_enterprise_id

                                  </th>
                                  <th class="th-sm">f_change_per

                                  </th>
                                  <th class="th-sm">f_etp_new

                                  </th>
                                  <th class="th-sm">auto_date

                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT * FROM funware_etp_value_history'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                      echo '<td>'.$row["sys_enterprise_id"].'</td>';
                                      echo '<td>'.$row["f_change_per"].'</td>';
                                      echo '<td>'.$row["f_etp_new"].'</td>';
                                      echo '<td>'.$row["auto_date"].'</td>';
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
        <script src="assets/js/shared/off-canvas.js"></script>
        <script src="assets/js/shared/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="assets/js/demo_1/dashboard.js"></script>
        <!-- End custom js for this page-->
        
        <script type="text/javascript" src="js/addons/datatables.min.js"></script>
        <script>
          $(document).ready(function () {

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample').DataTable({
              
              "responsive": true
            });
          });
          $(document).ready(function () {

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample2').DataTable({
              
              "responsive": true
            });
          });
          $(document).ready(function () {

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample3').DataTable({
              
              "responsive": true
            });
          });
        </script>
</body>

</html>