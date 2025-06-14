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
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                     <h1 class="m-0"><img src="../asset/img/member.png" width="40"> Members</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Members</li>
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
                           <table id="example1" class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>Profile</th>
                                    <th>Full Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Account</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><img src="../asset/img/profile.png" width="60" style="border: 2px solid #ddd"></td>
                                    <td>John Doe</td>
                                    <td>09987654321</td>
                                    <td>john@gmail.com</td>
                                    <td>Manggahan, Pasig</td>
                                    <td>
                                       <p class="info">Username: <b>john</b></p>
                                       <p class="info">Password: <b>***********</b></p>
                                    </td>
                                    <td class="text-center">
                                       <a class="btn btn-sm btn-success" href="#" data-toggle="modal"
                                          data-target="#edit"><i
                                          class="fa fa-user-edit"></i> Update</a>
                                       <a class="btn btn-sm btn-danger" href="#" data-toggle="modal"
                                          data-target="#delete"><i
                                          class="fa fa-trash"></i> Delete</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><img src="../asset/img/profile.png" width="60" style="border: 2px solid #ddd"></td>
                                    <td>Jane Doe</td>
                                    <td>09987654321</td>
                                    <td>jane@gmail.com</td>
                                    <td>Rosario, Pasig</td>
                                    <td>
                                       <p class="info">Username: <b>jane</b></p>
                                       <p class="info">Password: <b>***********</b></p>
                                    </td>
                                    <td class="text-center">
                                       <a class="btn btn-sm btn-success" href="#" data-toggle="modal"
                                          data-target="#edit"><i
                                          class="fa fa-user-edit"></i> Update</a>
                                       <a class="btn btn-sm btn-danger" href="#" data-toggle="modal"
                                          data-target="#delete"><i
                                          class="fa fa-trash"></i> Delete</a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
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
      <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <img src="../asset/img/sent.png" alt="" width="50" height="46">
                  <h3>Are you sure want to delete this Member?</h3>
                  <div class="m-t-20"> 
                     <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                     <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
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
                              <h5><img src="../asset/img/member.png" width="40"> Member Information</h5>
                              </div>
                              <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>Account Status</label>
                                          <select class="form-control">
                                             <option>Active</option>
                                             <option>Inactive</option>
                                          </select>
                                       </div>
                                    </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
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