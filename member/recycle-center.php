<?php
require_once('../config.php');
if(!isset($_SESSION["user"])){
   Header('location:../index.php');
}
$userid = $_SESSION['user'];

// Fetch records using prepared statement
$stmt = $con->prepare("SELECT * FROM recycling_center  ORDER BY id DESC");
if (!$stmt) {
   die("Prepare failed: " . $con->error);
}






?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../asset/img/icon.png">
      <title>Plastic-Waste-Management-System</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/style.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <style type="text/css">
      table tr td {
         padding: 0.3rem !important;
      }
      td a.btn{
         font-size: 0.7rem;
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
                     <h1 class="m-0"><img src="../asset/img/recycle-center.png" width="40"> Recycling Center</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Recycling Center</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info elevation-2">
                  <br>
                  <div class="col-md-12">
                     <table id="example1" class="table">
                        <thead class="btn-cancel">
                           <tr>
                              <th>Recycling-shop Name</th>
                              <th>Address</th>
                              <th>Contact</th>
                              <th>Email</th>
                              <th class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Fokou Recyclage</td>
                              <td>Douala, Littoral, Cameroon</td>
                              <td>+237 699123456</td>
                              <td>fokou@recyclage.cm</td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="4.0511" data-lng="9.7679"><i
                                       class="fa fa-map"></i> location</a>
                              </td>
                           </tr>
                           <tr>
                              <td>Yaoundé Recycling Center</td>
                              <td>Yaoundé, Centre Region, Cameroon</td>
                              <td>+237 677889900</td>
                              <td>info@yaounderecycle.cm</td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="3.8480" data-lng="11.5021"><i
                                       class="fa fa-map"></i> location</a>
                              </td>
                           </tr>
                           <tr>
                              <td>Bamenda Waste Solutions</td>
                              <td>Bamenda, Northwest Region, Cameroon</td>
                              <td>+237 655443322</td>
                              <td>contact@bamendawaste.cm</td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="5.9631" data-lng="10.1591"><i
                                       class="fa fa-map"></i> location</a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <div id="map" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form>
                           <div class="card-header">
                              <h5><img src="../asset/img/recycle-center.png" width="40"> Recycling-Shop Location</h5>
                           </div>
                  <div class="card-body">
                     <div class="mapouter"><div class="gmap_canvas"><iframe width="750" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=manila&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org">123movies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:700px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:700px;}</style></div></div>
                  </div>

                  <div class="card-footer">
                     <a href="#" class="btn btn-info" data-dismiss="modal">Close</a>
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

      // Function to show location on map
      function showLocation(latitude, longitude, name) {
         const mapUrl = `https://maps.google.com/maps?q=${latitude},${longitude}&t=&z=13&ie=UTF8&iwloc=&output=embed`;
         document.getElementById('gmap_canvas').src = mapUrl;
         document.querySelector('#map .card-header h5').innerHTML = 
            `<img src="../asset/img/recycle-center.png" width="40"> ${name} Location`;
      }

      // Event listener for location buttons
      document.addEventListener('DOMContentLoaded', function() {
         const locationButtons = document.querySelectorAll('[data-target="#map"]');
         locationButtons.forEach(button => {
            button.addEventListener('click', function() {
               const lat = this.getAttribute('data-lat');
               const lng = this.getAttribute('data-lng');
               const name = this.closest('tr').cells[0].textContent;
               
               if (lat && lng) {
                  showLocation(lat, lng, name);
               } else {
                  // Fallback to center of Cameroon if no coordinates are provided
                  showLocation(7.3697, 12.3547, name);
               }
            });
         });
      });
   </script>
</body>

</html>