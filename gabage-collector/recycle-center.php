<?php
require_once('../config.php');

if(!isset($_SESSION["user"])){
   header('location:../index.php');
   exit();
}
$userid = $_SESSION['user'];

// Select query to fetch all users from registration_form
try {
    $stmt = $con->prepare("SELECT id, CONCAT(firstName, ' ', lastName) as fullName, address, contact, email
                          FROM registration_form 
                         
                          ORDER BY fullName");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $con->error);
    }
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
} catch (Exception $e) {
    die("Database error: " . htmlspecialchars($e->getMessage()));
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
                              <th>User Name</th>
                              <th>Address</th>
                              <th>Contact</th>
                              <th>Email</th>
                              <th class="text-center" colspan="2">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                           <tr>
                              <td><?php echo htmlspecialchars($row['fullName']); ?></td>
                              <td><?php echo htmlspecialchars($row['address']); ?></td>
                              <td><?php echo htmlspecialchars($row['contact']); ?></td>
                              <td><?php echo htmlspecialchars($row['email']); ?></td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="<?php echo htmlspecialchars($row['latitude'] ?? '4.0511'); ?>" 
                                    data-lng="<?php echo htmlspecialchars($row['longitude'] ?? '9.7679'); ?>"
                                    title="View user location">
                                    <i class="fa fa-map-marker-alt"></i> Location
                                 </a>
                              </td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" 
                                    data-toggle="modal" 
                                    data-target="#waste-details"
                                    data-id="<?php echo htmlspecialchars($row['id']); ?>"
                                    title="View waste details">
                                    <i class="fa fa-recycle"></i> Details
                                 </a>
                              </td>
                           </tr>
                        <?php endwhile; ?>
                           <tr>
                              <td>Bamenda Waste Solutions</td>
                              <td>Bamenda, Northwest Region, Cameroon</td>
                              <td>+237 655443322</td>
                              <td>contact@bamendawaste.cm</td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="5.9631" data-lng="10.1591"><i
                                       class="fa fa-map"></i>User location</a>
                              </td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="4.0511" data-lng="9.7679"><i
                                       class="fa fa-map"></i>Waste location</a>
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
                                       class="fa fa-map"></i>User location</a>
                              </td>
                              <td class="text-center">
                                 <a class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#map"
                                    data-lat="4.0511" data-lng="9.7679"><i
                                       class="fa fa-map"></i>Waste location</a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <?php if ($result->num_rows === 0): ?>
                     <div class="alert alert-info m-3">
                        <i class="fas fa-info-circle"></i> No records found.
                     </div>
                     <?php endif; ?>
                     <?php 
                     // Close the statement and result set
                     $stmt->close();
                     $result->close();
                     ?>
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
                     <p id="location-address" class="text-muted mb-3"></p>
                     <div class="mapouter">
                        <div class="gmap_canvas">
                           <iframe width="750" height="500" id="gmap_canvas" 
                              src="https://maps.google.com/maps?q=cameroon&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                              frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                           </iframe>
                        </div>
                     </div>
                     <style>
                        .mapouter {
                           position: relative;
                           text-align: right;
                           height: 500px;
                           width: 100%;
                        }
                        .gmap_canvas {
                           overflow: hidden;
                           background: none !important;
                           height: 500px;
                           width: 100%;
                        }
                        .gmap_canvas iframe {
                           width: 100%;
                        }
                     </style>
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
      function showLocation(latitude, longitude, name, address) {
         const mapUrl = `https://maps.google.com/maps?q=${latitude},${longitude}&t=&z=13&ie=UTF8&iwloc=&output=embed`;
         document.getElementById('gmap_canvas').src = mapUrl;
         document.querySelector('#map .card-header h5').innerHTML = 
            `<img src="../asset/img/recycle-center.png" width="40"> ${name}'s Location`;
         document.querySelector('#location-address').textContent = address;
      }

      // Event listener for location buttons
      document.addEventListener('DOMContentLoaded', function() {
         const locationButtons = document.querySelectorAll('[data-target="#map"]');
         locationButtons.forEach(button => {
            button.addEventListener('click', function() {
               const lat = this.getAttribute('data-lat');
               const lng = this.getAttribute('data-lng');
               const row = this.closest('tr');
               const name = row.cells[0].textContent.trim();
               const address = row.cells[1].textContent.trim();
               
               if (lat && lng) {
                  showLocation(lat, lng, name, address);
               } else {
                  // Try to geocode the address
                  geocodeAddress(address, name);
               }
            });
         });
      });
   </script>
</body>

</html>