<?php
require_once('../config.php');
if (!isset($_SESSION["user"])) {
   Header('location:../login.php');
}

// query for total number of members
$total_users_query = "SELECT COUNT(*) as total_users FROM registration_form";
$total_users_result = mysqli_query($con, $total_users_query);

if ($total_users_result) {
    $total_users_row = mysqli_fetch_assoc($total_users_result);
    $total_users = $total_users_row['total_users'];
} else {
    $total_users = 0; // Default value if query fails
    error_log("Error Counting Users: " . mysqli_error($con));
}

// query for total number of garbage Collectors
$total_garbage_query = "SELECT COUNT(*) as total_users FROM registration_form where isadmin=2";
$total_garbage_result = mysqli_query($con, $total_garbage_query);

if ($total_garbage_result) {
    $total_garbage_row = mysqli_fetch_assoc($total_garbage_result);
    $total_garbage = $total_garbage_row['total_users'];
} else {
    $total_garbage = 0; // Default value if query fails
    error_log("Error Counting Garbage Collectors: " . mysqli_error($con));
}

// query for the total garbage collected
$total_garbage_collected_query = "SELECT COUNT(*) as total_users FROM menber_records where status=1";
$total_garbage_collected_result = mysqli_query($con, $total_garbage_collected_query);

if ($total_garbage_collected_result) {
    $total_garbage_collected_row = mysqli_fetch_assoc($total_garbage_collected_result);
    $total_garbage_collected = $total_garbage_collected_row['total_users'];
} else {
    $total_garbage = 0; // Default value if query fails
    error_log("Error Counting Garbage Collected: " . mysqli_error($con));
}



$userid = $_SESSION['user'];
$q = "SELECT * FROM registration_form WHERE isadmin=1  ORDER BY id DESC";
$query = mysqli_query($con, $q);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="../asset/img/icon.png">
   <title>Plastic-Waste-Management-System</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/style.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
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
               <a class="nav-link" href="#" role="button">
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
         <a href="index.php" class="brand-link">
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
                     <a href="garbage-type.php" class="nav-link">
                        <img src="../asset/img/garbage-type.png" width="30">
                        <p>
                           Garbage Type
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="member.php" class="nav-link">
                        <img src="../asset/img/member.png" width="30">
                        <p>
                           Members
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
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <img src="../asset/img/report.png" width="30">
                        <p>
                           Reports
                        </p>
                        <i class="right fas fa-angle-left"></i>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="garbage-type-report.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Garbage Type</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="income-report.php" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Income by Center</p>
                           </a>
                        </li>
                     </ul>
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
                        <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12 col-sm-8 col-md-8 offset-sm-2 offset-md-2 offset-lg-2">
                     <div class="info-box">
                        <span class="info-box-icon text-success elevation-4"><img src="../asset/img/recycle-center.png" width="50"></span>

                        <div class="info-box-content">
                           <span class="info-box-text">
                              <h5>Recycling Centers</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>5</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-8 col-md-8 offset-sm-2 offset-md-2 offset-lg-2">
                     <div class="info-box">
                        <span class="info-box-icon text-info elevation-4"><img src="../asset/img/member.png" width="50"></span>

                        <div class="info-box-content">
                           <span class="info-box-text">
                              <h5>Members</h5>
                           </span>
                           <span class="info-box-number">
                              <h2><?php
                                    echo $total_users;
                                    ?></h2>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-8 col-md-8 offset-sm-2 offset-md-2 offset-lg-2">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/Collector.jpeg" width="50"></span>

                        <div class="info-box-content">
                           <span class="info-box-text">
                              <h5>Garbage Collector</h5>
                           </span>
                           <span class="info-box-number">
                              <h2><?php
                                    echo $total_garbage;
                                    ?></h2>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-8 col-md-8 offset-sm-2 offset-md-2 offset-lg-2">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/garbage-collect.png" width="50"></span>

                        <div class="info-box-content">
                           <span class="info-box-text">
                              <h5>Garbage Collected</h5>
                           </span>
                           <span class="info-box-number">
                              <h2><?php
                                    echo $total_garbage_collected;
                                    ?></h2>
                           </span>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
</body>

</html>