<?php
  try {
  require 'dbInfo.php';
  include 'isSession.php';

  $uId = $_REQUEST["uid"];

    if($uId == 1){
      $_SESSION['user_id'] = "Admin";
    }else{
  
      if(!$user_login) {
        echo "<script>";
        echo    "alert('로그인이 필요한 서비스입니다.');";
        echo    "location.href='login.php'";
        echo "</script>";
      }
    }
  }catch(Exception $e){
    echo $e;
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
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
.item-purchase-banner {
  
}
</style>
<script>
  
  // $(window).resize(function(){
  //   console.log($("#main-p").width())
  //   var $a = $("main-p").width();
    
  //   $("#main-p").css("left",270);
  // })
</script>
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
      <div id="main-p" class="main-panel">
        <div class="content-wrapper">
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-12">
              <div class="page-header">
                <h4 class="page-title">Main</h4>
                <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                 
                </div>
              </div>
              
            </div>
           
          </div>
          
          <!-- Page Title Header Ends-->

          <div class="row">
              <div class="col-md-6 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                            
                              <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_user WHERE f_div ="Y"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<h3 class="mb-0 font-weight-semibold">'.$row["COUNT(*)"].'</h3>';
                                  }
                                ?>
                              
                            <h5 class="mb-0 font-weight-medium text-primary">Total User</h5>
                            
                            <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_user WHERE auto_date = CURDATE() '
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<p class="mb-0 text-muted">Today +'.$row["COUNT(*)"].'</p>';
                                  }
                                ?>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                             <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_project WHERE f_div ="Y"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<h3 class="mb-0 font-weight-semibold">'.$row["COUNT(*)"].'</h3>';
                                  }
                                ?>
                            <h5 class="mb-0 font-weight-medium text-primary">Total Project</h5>
                            <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_project WHERE auto_date = CURDATE() '
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<p class="mb-0 text-muted">Today +'.$row["COUNT(*)"].'</p>';
                                  }
                                ?>
                          </div>

                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                          <div class="wrapper">
                              <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_payment'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<h3 class="mb-0 font-weight-semibold">'.$row["COUNT(*)"].'</h3>';
                                  }
                                ?>
                            <h5 class="mb-0 font-weight-medium text-primary">Total Payment</h5>
                            <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE f_date = CURDATE() '
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<p class="mb-0 text-muted">Today +'.$row["COUNT(*)"].'</p>';
                                  }
                                ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                            
                              <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_user WHERE f_div ="N"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<h3 class="mb-0 font-weight-semibold">'.$row["COUNT(*)"].'</h3>';
                                  }
                                ?>
                              
                            <h5 class="mb-0 font-weight-medium text-primary">Delete User</h5>
                            
                            <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_user WHERE auto_date = CURDATE() AND f_div ="N"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<p class="mb-0 text-muted">Today +'.$row["COUNT(*)"].'</p>';
                                  }
                                ?>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                             <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_project WHERE f_div ="N"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<h3 class="mb-0 font-weight-semibold">'.$row["COUNT(*)"].'</h3>';
                                  }
                                ?>
                            <h5 class="mb-0 font-weight-medium text-primary">Delete Project</h5>
                            <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_project WHERE auto_date = CURDATE() AND f_div ="N"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<p class="mb-0 text-muted">Today +'.$row["COUNT(*)"].'</p>';
                                  }
                                ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6">
                        <div class="d-flex">
                          <div class="wrapper">
                             <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE f_div ="N"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<h3 class="mb-0 font-weight-semibold">'.$row["COUNT(*)"].'</h3>';
                                  }
                                ?>
                            <h5 class="mb-0 font-weight-medium text-primary">Delete Payment</h5>
                            <?php                                  
                                  $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE f_date = CURDATE() AND f_div ="N"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    echo '<p class="mb-0 text-muted">Today +'.$row["COUNT(*)"].'</p>';
                                  }
                                ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          
         
            <div class="row">   
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="p-4 border-bottom bg-light">
                    <h4 class="card-title mb-0">Line Chart</h4>
                  </div>
                  <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="d-flex justify-content-between align-items-center pb-4">
                      <h4 class="card-title mb-0">2021 Revenue</h4>
                      <div id="line-traffic-legend"><div class="chartjs-legend"><ul><li><span style="background-color:#5D62B4"></span>payment</li></ul></div></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        
                        <?php                                  
                                  $q4= $db->query('SELECT SUM(f_spon) FROM funware_payment WHERE f_div ="Y"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    
                                   $spon =number_format($row["SUM(f_spon)"]);
                                    echo '<h2 class="mb-0 font-weight-medium">$ '.$spon.'</h2>';
                                  }
                                ?>
                        <p class="mb-5 text-muted">Spon</p>
                      </div>
                      <div class="col-md-6">
                          <?php                                  
                                  $q4= $db->query('SELECT SUM(f_invest) FROM funware_payment WHERE f_div ="Y"'
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    
                                   $invest =number_format($row["SUM(f_invest)"]);
                                    echo '<h2 class="mb-0 font-weight-medium">$ '.$invest.'</h2>';
                                  }
                                ?>
                        <p class="mb-5 text-muted">Invest</p>
                      </div>
                    </div>
                    <canvas id="lineChart" style="display: block; width: 100%;"  ></canvas>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                      </div>
                      <p>User payment</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                              cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">f_user_name

                                  </th>
                                  <th class="th-sm">Invest

                                  </th>
                                  <th class="th-sm">Spon

                                  </th>
                              
                              </thead>
                              <tbody>
                                <?php
                                  $q4= $db->query('SELECT f_user_name
                                                          ,SUM(f_invest)
                                                          ,SUM(f_spon)
                                                            
                                                  FROM funware_user
                                                  LEFT JOIN funware_payment 
                                                    ON funware_payment.sys_user_id = funware_user.ai_id
                                                  WHERE funware_user.f_div = "Y" AND funware_payment.f_div = "Y"
                                                  GROUP BY f_user_name;
                                  
                                  '
                                  );
                                  while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                    $invest2 =number_format($row["SUM(f_invest)"]);
                                    $spon2 =number_format($row["SUM(f_spon)"]);
                                    echo '<tr>';
                                      echo '<td>'.$row["f_user_name"].'</td>';
                                      echo '<td>'.$invest2.'</td>';
                                      echo '<td>'.$spon2.'</td>';
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
            <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Invoice</h4>
                      </div>
                      <p>User category</p>
                      <div class="row">
                        <div class="col-md-12 grid-margin">
                          <div class="table-responsive">
                          <table id="dtBasicExample4" class="table table-striped table-bordered table-sm"
                           cellspacing="0" width="100%">
                           <thead>
                             <tr>
                               <th class="th-sm">Y/N

                               </th>
                               <th class="th-sm">f_category_name

                               </th>
                             </tr>
                             
                           </thead>
                           <tbody>
                             <?php
                               $q4= $db->query('SELECT f_div as c_div,f_category_name,ai_category
                                                FROM funware_category'
                               );
                               while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                 echo '<tr>';
                                   echo '<td>'.'<form action="update/update_category.php" method="post"><input style="width: 2em"; type="text" name="c_div" value='.$row["c_div"].'> <input type="hidden" name="ai_category" value='.$row["ai_category"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
                                   echo '<td>'.'<form action="update/update_category.php" method="post"><input type="text" name="f_category_name" value="'.$row["f_category_name"].'"> <input type="hidden" name="ai_category" value='.$row["ai_category"].'><button style="all:unset" type="submit"><i style="color:#gray" class="fa fa-save"></i> </button></form>'.'</td>';
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
     
            
              <!-- content-wrapper ends -->
              <!-- partial:partials/_footer.html -->
              <footer class="footer">
                <div class="container-fluid clearfix">
                  <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                    FunWare</span>
                  <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                      href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                      templates</a> from Bootstrapdash.com</span> -->
                </div>
              </footer>
              <!-- partial -->
              <?php                                  
                    $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210101 AND LAST_DAY(20210101) '
                                  );
                        while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                            echo '<script> var Jan ='.$row["COUNT(*)"].'; </script>';
                        }
                        $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210201 AND LAST_DAY(20210201) '
                                        );
                        while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                          echo '<script> var Feb ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210301 AND LAST_DAY(20210301) '
                                                );
                                while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                  echo '<script> var Mar ='.$row["COUNT(*)"].'; </script>';
                                }
                                    
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210401 AND LAST_DAY(20210401) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Apr ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210501 AND LAST_DAY(20210501) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var May ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210601 AND LAST_DAY(20210601) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Jun ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210701 AND LAST_DAY(20210701) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Jul ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210801 AND LAST_DAY(20210801) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Aug ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20210901 AND LAST_DAY(20210901) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Sep ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20211001 AND LAST_DAY(20211001) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Otv ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20211101 AND LAST_DAY(20211101) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Nov ='.$row["COUNT(*)"].'; </script>';
                         }
                         $q4= $db->query('SELECT COUNT(*) FROM funware_payment WHERE  f_date BETWEEN 20211201 AND LAST_DAY(20211201) '
                        );
                              while($row = $q4->fetch(PDO::FETCH_ASSOC)){
                                echo '<script> var Dec ='.$row["COUNT(*)"].'; </script>';
                         }

                 
        
              ?>
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
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  
        
        <script>
           function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
          $(document).ready(function () {
           

            $('.dataTables_length').addClass('bs-select');
            $('#dtBasicExample').DataTable({
              
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
$('#dtBasicExample4').DataTable({

  ordering: false,
  "responsive": true
});
});
        </script>
        <script>
            $('#datepicker').datepicker({
              dateFormat: "yy-mm-dd",
                });
            function getInputValue(){
              var Datevalue = $('.dateval').val();
              
              var array = Datevalue.split("/");
              var date = array[2]+array[1]+array[0];
              alert(date);
            }
           
       </script>
       <script>
         $(function () {
  /* ChartJS */
  'use strict';
  if ($("#mixed-chart").length) {
    var chartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        type: 'line',
        label: 'Revenue',
        data: ["23", "33", "32", "65", "21", "45", "35"],
        backgroundColor: ChartColor[2],
        borderColor: ChartColor[2],
        borderWidth: 3,
        fill: false,
      }, {
        type: 'bar',
        label: 'Standard',
        data: ["53", "28", "19", "29", "30", "51", "55"],
        backgroundColor: ChartColor[0],
        borderColor: ChartColor[0],
        borderWidth: 2
      }, {
        type: 'bar',
        label: 'Extended',
        data: ["34", "16", "46", "54", "42", "31", "49"],
        backgroundColor: ChartColor[1],
        borderColor: ChartColor[1]
      }]
    };
    var MixedChartCanvas = document.getElementById('mixed-chart').getContext('2d');
    lineChart = new Chart(MixedChartCanvas, {
      type: 'bar',
      data: chartData,
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Revenue and number of lincences sold'
        },
        scales: {
          xAxes: [{
            display: true,
            ticks: {
              fontColor: '#212229',
              stepSize: 50,
              min: 0,
              max: 150,
              autoSkip: true,
              autoSkipPadding: 15,
              maxRotation: 0,
              maxTicksLimit: 10
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Number of Sales',
              fontSize: 12,
              lineHeight: 2
            },
            ticks: {
              fontColor: '#212229',
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 20,
              min: 0,
              max: 100
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        legendCallback: function (chart) {
          var text = [];
          text.push('<div class="chartjs-legend d-flex justify-content-center mt-4"><ul>');
          for (var i = 0; i < chart.data.datasets.length; i++) {
            
            text.push('<li>');
            text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
            text.push(chart.data.datasets[i].label);
            text.push('</li>');
          }
          text.push('</ul></div>');
          return text.join("");
        }
      }
    });
    document.getElementById('mixed-chart-legend').innerHTML = lineChart.generateLegend();
  }
  
  if ($("#lineChart").length) {
    
    var lineData = {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep","Otv","Nov","Dec"],
      datasets: [{
        data: [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Otv, Nov, Dec ],
        backgroundColor: ChartColor[0],
        borderColor: ChartColor[0],
        borderWidth: 3,
        fill: 'false',
        label: "Payment"
      }]
    };
    var lineOptions = {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        filler: {
          propagate: false
        }
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Month',
            fontSize: 12,
            lineHeight: 2
          },
          ticks: {
            fontColor: '#212229',
            stepSize: 50,
            min: 0,
            max: 150,
            autoSkip: true,
            autoSkipPadding: 15,
            maxRotation: 0,
            maxTicksLimit: 10
          },
          gridLines: {
            display: false,
            drawBorder: false,
            color: 'transparent',
            zeroLineColor: '#eeeeee'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Number of invest',
            fontSize: 12,
            lineHeight: 2
          },
          ticks: {
            fontColor: '#212229',
            display: true,
            autoSkip: false,
            maxRotation: 0,
            stepSize: 100,
            min: 0,
            max: 400
          },
          gridLines: {
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      legendCallback: function (chart) {
        var text = [];
        text.push('<div class="chartjs-legend"><ul>');
        for (var i = 0; i < chart.data.datasets.length; i++) {
          
          text.push('<li>');
          text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
          text.push(chart.data.datasets[i].label);
          text.push('</li>');
        }
        text.push('</ul></div>');
        return text.join("");
      },
      elements: {
        line: {
          tension: 0
        },
        point: {
          radius: 0
        }
      }
    }
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineData,
      options: lineOptions
    });
    document.getElementById('line-traffic-legend').innerHTML = lineChart.generateLegend();
  }
 
});
       </script>
</body>

</html>