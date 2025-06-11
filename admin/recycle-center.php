<?php
require_once('../config.php');
if (!isset($_SESSION["user"])) {
   header('location:../index.php');
   exit();
}
$userid = $_SESSION['user'];

if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
   // Sanitize inputs
   $garbagetype = mysqli_real_escape_string($con, $_POST['garbage_type']);
   $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
   $amount = mysqli_real_escape_string($con, $_POST['amount']);
   $date = mysqli_real_escape_string($con, $_POST['date']);




}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="../asset/img/icon.png">
      <title>plastic-Waste-Management-System</title>
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
                     <h1 class="m-0"><img src="../asset/img/recycle-center.png" width="40"> Recycling Center</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Recycling Center</li>
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
               <div class="card card-info elevation-2">
                  <br>
                  <div class="col-md-12">
                     <table id="example1" class="table">
                        <thead class="btn-cancel">
                           <tr>
                              <th>Junkshop Name</th>
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
                                 <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#edit"><i
                                       class="fa fa-edit"></i> update</a>
                                 <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete"><i
                                       class="fa fa-trash-alt"></i> delete</a>
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
                                 <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#edit"><i
                                       class="fa fa-edit"></i> update</a>
                                 <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete"><i
                                       class="fa fa-trash-alt"></i> delete</a>
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
                                 <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#edit"><i
                                       class="fa fa-edit"></i> update</a>
                                 <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete"><i
                                       class="fa fa-trash-alt"></i> delete</a>
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
   <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body text-center">
               <img src="../asset/img/sent.png" alt="" width="50" height="46">
               <h3>Are you sure want to delete this Junkshop?</h3>
               <div class="m-t-20">
                  <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-danger">Delete</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="map" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form>
                           <div class="card-header">
                              <h5><img src="../asset/img/recycle-center.png" width="40"> Junkshop Location</h5>
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
   <div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-body text-center">
              <form>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5><img src="../asset/img/recycle-center.png" width="40"> Junkshop Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Junkshop Name</label>
                                    <input type="text" class="form-control" placeholder="Junkshop Name" name="shop">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Address</label>
                                    <input type="text" class="form-control" placeholder="Address" id="edit-address" name="address">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Latitude</label>
                                    <input type="text" class="form-control" placeholder="Latitude" id="edit-latitude" name="lat">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Longitude</label>
                                    <input type="text" class="form-control" placeholder="Longitude" id="edit-longitude" name="long">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <button type="button" class="btn btn-info float-left" onclick="getCoordinates('edit')">Get Coordinates from Address</button>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Contact</label>
                                    <input type="text" class="form-control" placeholder="Contact" name="contact">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email">
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
   <div id="add" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5><img src="../asset/img/recycle-center.png" width="40"> Junkshop Information</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Junkshop Name</label>
                                    <input type="text" class="form-control" placeholder="Junkshop Name">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Address</label>
                                    <input type="text" class="form-control" placeholder="Address" id="address">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Latitude</label>
                                    <input type="text" class="form-control" placeholder="Latitude" id="latitude">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="float-left">Longitude</label>
                                    <input type="text" class="form-control" placeholder="Longitude" id="longitude">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <button type="button" class="btn btn-info float-left" onclick="getCoordinates()">Get Coordinates from Address</button>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Contact</label>
                                    <input type="text" class="form-control" placeholder="Contact">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Email</label>
                                    <input type="text" class="form-control" placeholder="Email">
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

      // Function to get coordinates from address using Geocoding API
      function getCoordinates(formType = 'add') {
         const addressId = formType === 'edit' ? 'edit-address' : 'address';
         const latId = formType === 'edit' ? 'edit-latitude' : 'latitude';
         const lngId = formType === 'edit' ? 'edit-longitude' : 'longitude';
         
         const address = document.getElementById(addressId).value + ', Cameroon';
         // You'll need to replace YOUR_API_KEY with an actual Google Maps API key
         const geocodingUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=YOUR_API_KEY`;
         
         fetch(geocodingUrl)
            .then(response => response.json())
            .then(data => {
               if (data.results && data.results[0]) {
                  const location = data.results[0].geometry.location;
                  document.getElementById(latId).value = location.lat;
                  document.getElementById(lngId).value = location.lng;
               } else {
                  alert('Address not found in Cameroon. Please try again.');
               }
            })
            .catch(error => {
               console.error('Error:', error);
               alert('Error getting coordinates. Please try again.');
            });
      }

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