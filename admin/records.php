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

   // Image upload handling
   if (isset($_FILES['fileName']) && $_FILES['fileName']['error'] === UPLOAD_ERR_OK) {
      $originalFileName = $_FILES["fileName"]["name"];
      $ext = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
      $allowedTypes = array("jpg", "jpeg", "png", "gif");
      $maxFileSize = 5 * 1024 * 1024; // 5MB

      // Generate unique filename
      $fileName = uniqid('waste_') . '.' . $ext;
      $uploadPath = "../member/uploads/";
      
      // Create uploads directory if it doesn't exist
      if (!file_exists($uploadPath)) {
          mkdir($uploadPath, 0777, true);
      }
      
      $targetPath = $uploadPath . $fileName;
      // Check file size
      if ($_FILES["fileName"]["size"] > $maxFileSize) {
         $_SESSION['error'] = "File is too large. Maximum size is 5MB.";
         header("Location: records.php");
         exit();
      }

      // Check file type
      if (!in_array($ext, $allowedTypes)) {
         $_SESSION['error'] = "Invalid file type. Allowed types: jpg, jpeg, png, gif";
         header("Location: records.php");
         exit();
      }

      // Move uploaded file
      if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $targetPath)) {
         // Insert into database using prepared statement
         $stmt = $con->prepare("INSERT INTO menber_records (member_id, garbageType, quantity, amount, date, pic) VALUES (?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("issdss", $userid, $garbagetype, $quantity, $amount, $date, $fileName);

         if ($stmt->execute()) {
            $_SESSION['success'] = "Record added successfully";
            header("Location: records.php");
            exit();
         } else {
            $_SESSION['error'] = "Database error: " . $stmt->error;
            // Delete uploaded file if database insert fails
            unlink($targetPath);
            header("Location: records.php");
            exit();
         }
      } else {
         $_SESSION['error'] = "Failed to upload file.";
         header("Location: records.php");
         exit();
      }
   } else {
      $_SESSION['error'] = "Please select an image file";
      header("Location: records.php");
      exit();
   }
}

// Fetch records using prepared statement
$stmt = $con->prepare("SELECT * FROM menber_records  ORDER BY id DESC");
if (!$stmt) {
   die("Prepare failed: " . $con->error);
}
if (!$stmt) {
   die("Prepare failed: " . $con->error);
}

if (!mysqli_stmt_execute($stmt)) {
   die("Execute failed: " . $stmt->error);
}

$query = mysqli_stmt_get_result($stmt);

// Now check the number of rows
if (mysqli_num_rows($query) > 0) {
   // Display table header
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
            background-color: rgba(0, 0, 0, 0.02);
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
               max-height: none;
               overflow: visible;
            }

            .table-responsive {
               height: auto;
               overflow-x: auto;
            }

            #example1 {
               font-size: 14px;
            }

            #example1 thead th {
               min-width: 100px;
               padding: 8px 4px;
            }

            #example1 td {
               min-width: 100px;
               white-space: normal;
               word-break: break-word;
            }

            td a.btn {
               display: block;
               margin: 2px 0;
               white-space: nowrap;
            }

            .table-responsive::-webkit-scrollbar {
               height: 4px;
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
                        <h1 class="m-0"><img src="../asset/img/records.png" width="40"> Collection Records</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Collection Records</li>
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
                        <div class="table-responsive">
                           <table id="example1" class="table table-bordered table-striped">
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
                                       <td class="text-center">
                                          <?php
                                          if (!empty($record['pic'])) {
                                             $imagePath = "../member/uploads/" . $record['pic'];
                                             if (file_exists($imagePath)) { ?>
                                                <a href="javascript:void(0)" onclick="showImageModal('<?php echo htmlspecialchars($imagePath); ?>', '<?php echo htmlspecialchars($record['garbageType']); ?>')">
                                                   <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                                      width="60"
                                                      height="60"
                                                      style="border: 2px solid #ddd; object-fit: cover; border-radius: 4px; cursor: pointer;"
                                                      onerror="this.src='../asset/img/no-image.png';"
                                                      alt="<?php echo htmlspecialchars($record['garbageType']); ?> Image">
                                                </a>
                                             <?php } else { ?>
                                                <img src="../asset/img/no-image.png"
                                                   width="60"
                                                   height="60"
                                                   style="border: 2px solid #ddd; border-radius: 4px;"
                                                   alt="Image Not Found">
                                             <?php }
                                          } else { ?>
                                             <img src="../asset/img/no-image.png"
                                                width="60"
                                                height="60"
                                                style="border: 2px solid #ddd; border-radius: 4px;"
                                                alt="No Image Available">
                                          <?php } ?>
                                       </td>
                                       <td>
                                          <?php
                                          $status_class = '';
                                          $status_text = '';
                                          if ($record['status'] == 1) {
                                             $status_class = 'bg-success';
                                             $status_text = 'Accepted';
                                          } elseif ($record['status'] == 2) {
                                             $status_class = 'bg-danger';
                                             $status_text = 'Rejected';
                                          } else {
                                             $status_class = 'bg-warning';
                                             $status_text = 'Pending';
                                          }
                                          ?>
                                          <span class="badge <?php echo $status_class; ?>" style="font-size: 0.85rem; padding: 8px 12px; border-radius: 4px; font-weight: 500; letter-spacing: 0.3px;">
                                             <?php echo $status_text; ?>
                                          </span>
                                       </td>
                                       <td class="text-center">
                                          <?php if ($record['status'] == 0) { // Only show accept/reject for pending records 
                                          ?>
                                             <form action="update-record-status.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-sm btn-success" style="margin-right: 5px;">
                                                   <i class="fa fa-check"></i> Accept
                                                </button>
                                             </form>
                                             <form action="update-record-status.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
                                                <input type="hidden" name="status" value="2">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                   <i class="fa fa-times"></i> Reject
                                                </button>
                                             </form>
                                          <?php } else { ?>
                                             <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                Status Updated
                                             </button>
                                          <?php } ?>

                                       </td>
                                    </tr>
                                 <?php $sn++;
                                 } ?>
                              </tbody>
                           </table>
                        </div>
                     <?php
                  } else {
                     echo '<p>No Records found.</p>';
                  }

                  // Free the result
                  mysqli_free_result($query);
                  mysqli_stmt_close($stmt);
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
      <!-- Image Preview Modal -->
      <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="imagePreviewModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body text-center">
                  <img id="previewImage" src="" alt="Preview" style="max-width: 100%; border: 3px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
         $(function() {
            $("#example1").DataTable();
         });

         function showImageModal(imagePath, garbageType) {
            // Update modal content
            document.getElementById('previewImage').src = imagePath;
            document.getElementById('imagePreviewModalLabel').textContent = 'Garbage Type: ' + garbageType;

            // Show modal
            $('#imagePreviewModal').modal('show');

            // Handle image load error
            document.getElementById('previewImage').onerror = function() {
               this.src = '../asset/img/no-image.png';
               this.onerror = null;
            };
         }
      </script>
   </body>

   </html>