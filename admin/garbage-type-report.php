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
      table tr td {
         padding: 0.3rem !important;
      }
      table tr td p{
         margin-top: -0.8rem !important;
         margin-bottom: -0.8rem !important;
         font-size: 0.9rem;
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                     <h1 class="m-0"><img src="../asset/img/report.png" width="40"> Garbage Type Reports</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Reports</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            <section class="content">
               <div class="container-fluid">
                  <div class="card card-info">
                     <br>
                     <div class="col-md-12">
                        <div class="table-responsive-mobile">
                           <table class="table table-bordered mytable">
                           <thead>
                              <td><strong>Garbage Type</strong></td>
                              <td>January</td>
                              <td>February</td>
                              <td>March</td>
                              <td>April</td>
                              <td>May</td>
                              <td>June</td>
                              <td>July</td>
                              <td>August</td>
                              <td>September</td>
                              <td>October</td>
                              <td>November</td>
                              <td>December</td>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><strong>Plastic Bag</strong></td>
                                 <td>500</td>
                                 <td>600</td>
                                 <td>700</td>
                                 <td>800</td>
                                 <td>900</td>
                                 <td>1000</td>
                                 <td>1100</td>
                                 <td>1200</td>
                                 <td>1300</td>
                                 <td>1400</td>
                                 <td>1500</td>
                                 <td>1600</td>
                              </tr>
                              <tr>
                                 <td><strong>Plastic Cups</strong></td>
                                 <td>900</td>
                                 <td>1000</td>
                                 <td>1100</td>
                                 <td>1200</td>
                                 <td>1300</td>
                                 <td>1400</td>
                                 <td>1500</td>
                                 <td>1600</td>
                                 <td>1700</td>
                                 <td>1800</td>
                                 <td>1900</td>
                                 <td>2000</td>
                              </tr>
                              <tr>
                                 <td><strong> Plastic Paper</strong></td>
                                 <td>900</td>
                                 <td>1000</td>
                                 <td>1100</td>
                                 <td>1200</td>
                                 <td>1300</td>
                                 <td>1400</td>
                                 <td>1500</td>
                                 <td>1600</td>
                                 <td>1700</td>
                                 <td>1800</td>
                                 <td>1900</td>
                                 <td>2000</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="col-md-12">
                     <canvas id="bargraph"></canvas>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/bootstrap.bundle.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
      <!-- DataTables  & Plugins -->
      <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
      <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      
   <script src="../asset/js/chart.js"></script>
   <script>
      document.addEventListener("DOMContentLoaded", function () {
         // Bar Chart
         var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novermber", "December"],
            datasets: [{
               label: 'Plastic Bags',
               backgroundColor: 'rgb(79,129,189)',
               borderWidth: 1,
               data: [50,60,70,80,90,100,110,120,130,140,150,160]
            },
            {
               label: 'Plastic Cups',
               backgroundColor: 'rgb(192,80,77)',
               borderWidth: 1,
               data: [55,65,75,85,95,105,115,125,135,145,155,165]
            },
            {
               label: 'Plastic Papers',
               backgroundColor: 'rgb(46,231,126)',
               borderWidth: 1,
               data: [60,70,80,90,100,110,120,130,140,150,160,170]
            }]
         };

         var ctx = document.getElementById('bargraph').getContext('2d');
         window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
               responsive: true,
               legend: {
                  display: true,
               }
            }
         });

      });
   </script>
   </body>
</html>