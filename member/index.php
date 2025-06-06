<?php
require_once('../config.php');
if(!isset($_SESSION["user"])){
   Header('location:../index.php');
}
$userid = $_SESSION['user'];
 // fetch user data from database
$q = "SELECT * FROM garbage_type WHERE id='$userid'";
$query = mysqli_query($con, $q);
// if($query){
//    $row = mysqli_fetch_assoc($query);
//    $garbagetype = $row['garbage_type'];
//    $message = $row['description'];
//    $amount = $row['reward'];
// }
// else{
//    echo "Error: " . mysqli_error($con);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../asset/img/icon.png">
      <title>Platic-Waste-Management-System</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/style.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css?<?php echo date('Y-m-d H:i:s') ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-light" style="background-color: rgb(86,181,42)">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="../profile.php" role="button">
                  <img src="../asset/img/avatar.png" class="img-circle" alt="User Image" width="40" style="margin-top: -8px;">
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="../logout.php">
                  <i class="fas fa-sign-out-alt"></i>
               </a>
            </li>
         </ul>
      </nav>
      <aside class="main-sidebar sidebar-light-primary">
            <!-- Brand Logo -->
            <a href="index.html" class="brand-link">
         <img src="../asset/img/logo.png" alt="DSMS Logo" width="200">
         </a>
         <div class="sidebar">
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                     <a href="index.php" class="nav-link">
                        <img src="../asset/img/dashboard.png" width="30">
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="recycle-center.php" class="nav-link">
                        <img src="../asset/img/recycle-center.png" width="30">
                        <p>
                           Recycling Center
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="records.php" class="nav-link">
                        <img src="../asset/img/records.png" width="30">
                        <p>
                           Collection Record
                        </p>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
      </aside>
      <div class="content-wrapper">
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0"><img src="../asset/img/dashboard.png" width="40"> Dashboard</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Garbage Type</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12 col-sm-8 col-md-8">
                     <div class="row">
                     <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                           <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/bottle.png" width="50"></span>
                           <div class="info-box-content">
                              <span class="info-box-text">
                                 <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                          data-target="#delete"><i
                                          class="fa fa-trash-alt text-danger"></i></a></span>
                                 <h5> Platic Bottle</h5>
                              </span>
                              <span class="info-box-number">
                                 <h2>Price 1500frs</h2>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                           <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/plastic-bag.png" width="50"></span>
                           <div class="info-box-content">
                              <span class="info-box-text">
                                 <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                          data-target="#delete"><i
                                          class="fa fa-trash-alt text-danger"></i></a></span>
                                 <h5>Plastic Bags</h5>
                              </span>
                              <span class="info-box-number">
                                 <h2>Price 1500frs</h2>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                           <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/paper.png" width="50"></span>
                           <div class="info-box-content">
                              <span class="info-box-text">
                                 <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                          data-target="#delete"><i
                                          class="fa fa-trash-alt text-danger"></i></a></span>
                                 <h5>Plastic Paper</h5>
                              </span>
                              <span class="info-box-number">
                                 <h2>Price 1000frs</h2>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                           <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/recyclable_3271305.png" width="50"></span>
                           <div class="info-box-content">
                              <span class="info-box-text">
                                 <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                          data-target="#delete"><i
                                          class="fa fa-trash-alt text-danger"></i></a></span>
                                 <h5>Plastic Cups</h5>
                              </span>
                              <span class="info-box-number">
                                 <h2>Price 2500frs</h2>
                              </span>
                           </div>
                        </div>
                     </div>
                     </div>
                </div>
                <div class="col-12 col-sm-4 col-md-4">
                 <div class="col-12 col-sm-12 col-md-12">
                    <div class="info-box">
                       <div class="info-box-content">
                          <span class="info-box-text">
                             <h5>Total Income</h5>
                          </span>
                          <span class="info-box-number">
                             <h1 class="text-danger"> 6500frs</h1>
                          </span>
                       </div>
                    </div>
                 </div>
              </div>
               </div>
            </div>
         </section>
      </div>
   </div>
      <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <img src="../asset/img/sent.png" alt="" width="50" height="46">
                  <h3>Are you sure want to delete this Item?</h3>
                  <div class="m-t-20"> 
                     <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                     <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <div id="add" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5><img src="../asset/img/garbage-collect.png" width="40"> Garbage Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Garbage Type</label>
                                    <input type="text" class="form-control" placeholder="Garbage Type">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Description</label>
                                    <textarea class="form-control" placeholder="Descriptions"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Reward</label>
                                    <input type="text" class="form-control" placeholder="Reward">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-cancel" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-save">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/bootstrap.bundle.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script>
      $(function () {
         $("#example1").DataTable();
      });
   </script>
</body>

</html>