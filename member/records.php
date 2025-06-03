<?php
require_once('../config.php');
if (!isset($_SESSION["user"])) {
   header('location:../index.php');
   exit();
}
$userid = $_SESSION['user'];

// Check for database connection
if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
   // Sanitize inputs
   $garbagetype = mysqli_real_escape_string($con, $_POST['garbage_type']);
   $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
   $amount = mysqli_real_escape_string($con, $_POST['amount']);
   $date = mysqli_real_escape_string($con, $_POST['date']);

   // Image upload
   $originalFileName = $_FILES["fileName"]["name"];
   $ext = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
   $allowedTypes = array("jpg", "jpeg", "png", "gif");
   $maxFileSize = 5 * 1024 * 1024; // 5MB
   $tempName = $_FILES["fileName"]["tmp_name"];

   // Generate unique filename
   $fileName = uniqid('waste_') . '.' . $ext;
   $targetPath = "uploads/" . $fileName;

   // Check file size
   if ($_FILES["fileName"]["size"] > $maxFileSize) {
      echo "File is too large. Maximum size is 5MB.";
      exit();
   }

   // Check file type
   if (in_array($ext, $allowedTypes)) {
      // Move uploaded file to the target directory
      if (move_uploaded_file($tempName, $targetPath)) {
         // Insert the data into the database
         $query = "INSERT INTO menber_records (member_id, garbageType, quantity, amount, date, pic) VALUES (?, ?, ?, ?, ?, ?)";
         $stmt = mysqli_prepare($con, $query);
         mysqli_stmt_bind_param($stmt, "issdss", $userid, $garbagetype, $quantity, $amount, $date, $fileName);

         if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Transaction successful";
            header("Location: records.php");
            exit(); // Make sure to exit after redirect
         } else {
            $_SESSION['error'] = "Error: " . mysqli_error($con);
         }
      } else {
         $_SESSION['error'] = "Failed to upload file.";
      }
   } else {
      $_SESSION['error'] = "Invalid file type.";
   }
}



// Fetch records - show all records regardless of status
$q = "SELECT * FROM menber_records WHERE member_id = ? ORDER BY id DESC";
$stmt = mysqli_prepare($con, $q);
mysqli_stmt_bind_param($stmt, "i", $userid);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);




// Close the database connection
mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../asset/img/icon.png">
   <title> Plastic-Waste-Management-System</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/adminlte.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/css/style.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css ?<?php echo date('Y-m-d H:i:s') ?>">
   <style type="text/css">
      table tr td {
         padding: 0.3rem !important;
      }

      table tr td p {
         margin-top: -0.8rem !important;
         margin-bottom: -0.8rem !important;
         font-size: 0.9rem;
      }

      td a.btn {
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
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0"><img src="../asset/img/records.png" width="40"> Collection Records</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Collection Records</li>
                     </ol>
                  </div>
                  <a class="btn btn-sm elevation-4" href="#" data-toggle="modal" data-target="#add"
                     style="margin-top: 20px;margin-left: 10px;background-color: rgb(86,181,42)"><i
                        class="fa fa-plus-square"></i>
                     Upload Items</a>
               </div>
            </div>
         </div>
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
                  <br>
                  <div class="col-md-12">
                     <?php
                     $sn = 1;
                     if (mysqli_num_rows($query) > 0) {
                     ?>
                        <table id="example1" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>Sn</th>
                                 <th>Garbage Type</th>
                                 <th>Quantity</th>
                                 <th>Total Amount</th>
                                 <th>Date</th>
                                 <th>Upload of scan Garbage</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $sn = 1;
                              while ($record = mysqli_fetch_assoc($query)) {
                              ?>
                                 <tr>
                                    <td> <?php echo $sn ?></td>
                                    <td>
                                       <?php echo $record['garbageType'] ?>
                                    </td>
                                    <td>
                                       <?php echo $record['quantity'] ?>
                                    </td>
                                    <td>
                                       <?php echo $record['amount'] ?>
                                    </td>
                                    <td>
                                       <?php echo $record['date'] ?>
                                    </td>
                                    <td>
                                       <?php if (!empty($record['pic'])): ?>
                                          <img src="uploads/<?php echo htmlspecialchars($record['pic']); ?>"
                                             width="60"
                                             height="60"
                                             style="border: 2px solid #ddd; object-fit: cover;"
                                             onerror="this.src='../asset/img/no-image.png';"
                                             alt="Garbage Image">
                                       <?php else: ?>
                                          <img src="../asset/img/no-image.png"
                                             width="60"
                                             height="60"
                                             style="border: 2px solid #ddd;"
                                             alt="No Image Available">
                                       <?php endif; ?>
                                    </td>                                    <td class="text-center">
                                       <?php 
                                          switch($record['status']) {
                                             case 1:
                                                echo '<span class="badge bg-success" style="font-size: 0.85rem; padding: 8px 12px; border-radius: 4px; font-weight: 500; letter-spacing: 0.3px;">Accepted</span>';
                                                break;
                                             case 2:
                                                echo '<span class="badge bg-danger" style="font-size: 0.85rem; padding: 8px 12px; border-radius: 4px; font-weight: 500; letter-spacing: 0.3px;">Rejected</span>';
                                                break;
                                             default:
                                                echo '<span class="badge bg-warning" style="font-size: 0.85rem; padding: 8px 12px; border-radius: 4px; font-weight: 500; letter-spacing: 0.3px;">Pending</span>';
                                          }
                                       ?>
                                    </td>
                                    <td class="text-center">
                                       <a class="btn btn-sm btn-success" href="#" data-toggle="modal"
                                          data-target="#edit" data-id="<?php echo $record['id']; ?>"
                                          data-garbage-type="<?php echo $record['garbageType']; ?>"
                                          data-quantity="<?php echo $record['quantity']; ?>"
                                          data-amount="<?php echo $record['amount']; ?>"
                                          data-date="<?php echo $record['date']; ?>"
                                          data-pic="<?php echo $record['pic']; ?>"><i
                                             class="fa fa-edit"></i> Update</a>
                                       <a class="btn btn-sm btn-danger" href="#" data-toggle="modal"
                                          data-target="#delete" data-id="<?php echo $record['id']; ?>"><i
                                             class="fa fa-trash"></i> Delete</a>
                                    </td>
                                 </tr>
                              <?php $sn++;
                              } ?>
                           </tbody>
                        </table>
                     <?php
                     } else {
                        echo '<p>No Records found.</p>';
                     }
                     ?>
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
               <h3>Are you sure want to delete this Record?</h3>
               <div class="m-t-20">
                  <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                  <a href="#" class="btn btn-danger confirm-delete">Delete</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
            <div class="modal-body text-center">
               <form action="edit-records.php" method="POST" enctype="multipart/form-data">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5><img src="../asset/img/garbage-collect.png" width="40"> Edit Collection</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Garbage Type</label>
                                    <select class="form-control" name="garbage_type">
                                       <option value="Plastic Bag">Plastic Bag</option>
                                       <option value="Plastic Bottle">Plastic Bottle</option>
                                       <option value="Plastic Cup">Plastic Cup</option>
                                       <option value="Plastic Paper">Plastic Paper</option>
                                       <option value="Plastic Can">Plastic Can</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" value="<?php echo $record['quantity']; ?>" id="weight" min="0" step="0.01" oninput="calculateTotalPrice()" required>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Total Amount MTN Momo</label>
                                    <input type="text" class="form-control" name="amount" id="edit_result" value="<?php echo $record['amount']; ?>" readonly>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Date</label>
                                    <input type="date" class="form-control" name="date" value="<?php echo $record['date']; ?>" required>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Current Picture</label>
                                    <div>
                                       <img src="uploads/<?php echo $record['pic']; ?>" width="100" style="border: 2px solid #ddd; margin-bottom: 10px;">
                                    </div>
                                    <label class="float-left">Choose New Picture (optional)</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile" name="fileName">
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                  <input type="hidden" name="update" value="1">
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-save">Save Changes</button>
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
               <form method="POST" action="records.php" enctype="multipart/form-data">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-header">
                              <h5><img src="../asset/img/garbage-collect.png" width="40"> Add Collection</h5>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Garbage Type</label>
                                    <select class="form-control" name="garbage_type">
                                       <option value="Plastic Bag">Plastic Bag</option>
                                       <option value="Plastic Bottle">Plastic Bottle</option>
                                       <option value="Plastic Cup">Plastic Cup</option>
                                       <option value="Plastic Paper">Plastic Paper</option>
                                       <option value="Plastic Can">Plastic Can</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Quantity</label>
                                    <input type="number" class="form-control" placeholder="Quantity" name="quantity" id="weight" min="0" step="0.01" oninput="calculateTotalPrice()" required>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Total Amount MTN Momo</label>
                                    <input type="text" class="form-control" id="result" name="amount" readonly>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="float-left">Choose Picture</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile" name="fileName" required>
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" name="status" value="pending">
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <a href="#" class="btn btn-cancel" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-save" onclick="calculateTotalPrice()">
                        <input type="submit" name="submit" value="Save"></button>
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
      // $(function () {
      //   $("#example1").DataTable();
      // });

      // // Confirm transaction before saving
      // document.querySelector('#add .btn-save').addEventListener('click', function(e) {
      //    e.preventDefault();
      //    if (confirm('Do you want to confirm this transaction?')) {
      //       // Here you would submit the form
      //       this.closest('form').submit();
      //    }
      // });
      $(function() {
         // Handle edit modal data
         $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            // Get data from button
            var id = button.data('id');
            var garbageType = button.data('garbage-type');
            var quantity = button.data('quantity');
            var amount = button.data('amount');
            var date = button.data('date');
            var pic = button.data('pic');

            // Set values in form
            modal.find('input[name="id"]').val(id);
            modal.find('select[name="garbage_type"]').val(garbageType);
            modal.find('input[name="quantity"]').val(quantity);
            modal.find('input[name="amount"]').val(amount);
            modal.find('input[name="date"]').val(date);
            modal.find('img').attr('src', 'uploads/' + pic);
         });

         // Handle delete modal data
         $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            // Set up delete button click handler
            $(this).find('.confirm-delete').attr('href', 'delete-records.php?id=' + id);
         });

         // Garbage type prices in XAF
         const garbagePrices = {
            'Plastic Bag': 1500,
            'Plastic Bottle': 1500,
            'Plastic Cup': 1000,
            'Plastic Paper': 1000,
            'Plastic Can': 2500
         };

         function calculatePrice(form) {
            const garbageType = $(form).find('select[name="garbage_type"]').val();
            const quantity = parseFloat($(form).find('input[name="quantity"]').val()) || 0;
            const pricePerUnit = garbagePrices[garbageType];
            const total = quantity * pricePerUnit;

            // Update the amount input in the specific form
            $(form).find('input[name="amount"]').val(total + ' XAF');
         }

         // Add form calculations
         const addForm = $('#add form');
         addForm.find('input[name="quantity"], select[name="garbage_type"]').on('input change', function() {
            calculatePrice(addForm);
         });

         // Edit form calculations
         const editForm = $('#edit form');
         editForm.find('input[name="quantity"], select[name="garbage_type"]').on('input change', function() {
            calculatePrice(editForm);
         });

         // Initial calculations
         calculatePrice(addForm);
         calculatePrice(editForm);
      });
   </script>
</body>

</html>