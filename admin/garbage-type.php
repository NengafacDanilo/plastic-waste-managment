<?php
require_once('../config.php');
// if(!isset($_SESSION["user"])){
//    Header('location:../login.php');
// }
// $userid = $_SESSION['member_id'];

// Check for database connection
if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
   // Sanitize inputs
   $garbagetype = mysqli_real_escape_string($con, $_POST['garbage_type']);
   $message = mysqli_real_escape_string($con, $_POST['message']);
   $amount = mysqli_real_escape_string($con, $_POST['amount']);
    
       
// Image upload
   $fileName = $_FILES["fileName"]["name"];
   $ext = pathinfo($fileName, PATHINFO_EXTENSION);
   $allowedTypes = array("jpg", "jpeg", "png", "gif");
   $tempName = $_FILES["fileName"]["tmp_name"];
   $targetPath = "uploads/" . $fileName;

   // Check file type
   if (in_array($ext, $allowedTypes)) {
      // Move uploaded file to the target directory
      
      if (move_uploaded_file($tempName, $targetPath)) {
         // Insert the data into the database
         $query = "INSERT INTO garbage_type (gabageType, description, reward, pic) VALUES ('$garbagetype', '$message ', '$amount','$fileName')";

         if (mysqli_query($con, $query)) {
            echo " Successful Created";
            header("Location: garbage-type.php");
            exit(); // Make sure to exit after redirect
         } else {
            echo "Error: " . mysqli_error($con);
         }
      } else {
         echo "Failed to upload file.";
      }
   } else {
      echo "Invalid file type.";
   }
}



// Close the database connection
mysqli_close($con);

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
   <style type="text/css">
      .card-info {
         max-height: calc(100vh - 200px);
         overflow: hidden;
      }

      .table-responsive {
         height: calc(100vh - 250px);
         overflow-y: auto;
         position: relative;
      }

      #example1 {
         position: relative;
         width: 100%;
         background-color: #ffffff;
         border-collapse: collapse;
      }

      #example1 thead {
         position: sticky;
         top: 0;
         z-index: 1;
         background-color: #ffffff;
      }

      #example1 thead th {
         background-color: #f4f6f9;
         border-bottom: 2px solid #dee2e6;
         padding: 12px 8px;
         font-weight: 600;
         text-align: left;
         vertical-align: middle;
      }

      #example1 tbody tr:hover {
         background-color: rgba(0,0,0,0.02);
      }

      table tr td {
         padding: 0.3rem !important;
         vertical-align: middle;
      }

      table tr td p {
         margin-top: -0.8rem !important;
         margin-bottom: -0.8rem !important;
         font-size: 0.9rem;
      }

      td a.btn {
         font-size: 0.7rem;
      }

      /* Scrollbar Styling */
      .table-responsive::-webkit-scrollbar {
         width: 6px;
         height: 6px;
      }

      .table-responsive::-webkit-scrollbar-track {
         background: #f1f1f1;
         border-radius: 3px;
      }

      .table-responsive::-webkit-scrollbar-thumb {
         background: #888;
         border-radius: 3px;
      }

      .table-responsive::-webkit-scrollbar-thumb:hover {
         background: #555;
      }

      @media (max-width: 768px) {
         .card-info {
            max-height: calc(100vh - 150px);
         }
         
         .table-responsive {
            height: calc(100vh - 200px);
         }
      }
   </style>
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
               <a class="nav-link" data-widget="fullscreen" href="../index.php">
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
                     <h1 class="m-0"><img src="../asset/img/garbage-type.png" width="40"> Garbage Type</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Garbage Type</li>
                     </ol>
                  </div>
                  <a class="btn btn-sm elevation-4" href="#" data-toggle="modal" data-target="#add"
                     style="margin-top: 20px;margin-left: 10px;background-color: rgb(86,181,42)"><i
                        class="fa fa-plus-square"></i>
                     Add New</a>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/bottle.png" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastic Bottle</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 1500frs</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                    <div class="col-6 col-sm-6 col-md-3">
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
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/carton.png" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastic chairs</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 3000frs</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/plastic-bag.png" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastics Bags</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 1500frs</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/can.png" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastic Cans</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 2500frs</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/Plastic Cups.jpg" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastic Cups</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 1000frs</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/electrical.png" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastic Elec</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 600frs</h2>
                           </span>
                        </div>
                     </div>
                  </div>
                    <div class="col-6 col-sm-6 col-md-3">
                     <div class="info-box">
                        <span class="info-box-icon text-warning elevation-4"><img src="../asset/img/tire.png" width="50"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">
                              <span class="float-sm-right"><a class="btn btn-sm" href="#" data-toggle="modal"
                                       data-target="#delete"><i
                                       class="fa fa-trash-alt text-danger"></i></a></span>
                              <h5>Plastic buckets</h5>
                           </span>
                           <span class="info-box-number">
                              <h2>Price 1200frs</h2>
                           </span>
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
               <form method="POST" action="garbage-type.php" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" placeholder="Garbage Type" name="garbage_type">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Description</label>
                                    <textarea class="form-control" placeholder="Descriptions" name="message"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Reward</label>
                                    <input type="text" class="form-control" placeholder="Reward" name="amount"> 
                                 </div>
                                  <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile" name="fileName" required>
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-cancel" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-save" name="submit">Save</button>
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