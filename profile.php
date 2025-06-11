<?php
require_once('config.php');
if(!isset($_SESSION["user"])){
   Header('location:../login.php');
}
$userid = $_SESSION['user'];

// Check for database connection
if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}
// Fetch existing user data
$query = "SELECT * FROM profileid WHERE id = '$userid'";
$result = mysqli_query($con, $query);
$user_data = mysqli_fetch_assoc($result);

if (isset($_POST['action'])) {
   $action = $_POST['action'];
   
   // Sanitize inputs
   $middlename = !empty($_POST['middleName']) ? mysqli_real_escape_string($con, $_POST['middleName']) : '';
   $birthday = !empty($_POST['birthday']) ? mysqli_real_escape_string($con, $_POST['birthday']) : '';
   $username = !empty($_POST['userName']) ? mysqli_real_escape_string($con, $_POST['userName']) : '';
   
   if ($action == 'edit') {
       // Make form fields editable (handled by HTML)
       $success_message = "You can now edit your profile.";
   } elseif ($action == 'save') {
      // Check if user exists
      $check_query = "SELECT * FROM profileid WHERE id = '$userid'";
      $check_result = mysqli_query($con, $check_query);
      
      if(mysqli_num_rows($check_result) > 0) {
         // Update existing record
         $update_query = "UPDATE profileid SET middleName='$middlename', birthday='$birthday', userName='$username' WHERE id='$userid'";
         if(mysqli_query($con, $update_query)) {
            $success_message = "Profile updated successfully!";
            // Refresh user data after update
            $result = mysqli_query($con, "SELECT * FROM profileid WHERE id = '$userid'");
            $user_data = mysqli_fetch_assoc($result);
         } else {
            $error_message = "Error updating profile: " . mysqli_error($con);
         }
      } else {
         // Insert new record
         $insert_query = "INSERT INTO profileid (id, middleName, birthday, userName) VALUES ('$userid', '$middlename', '$birthday', '$username')";
         if(mysqli_query($con, $insert_query)) {
            $success_message = "Profile created successfully!";
            // Refresh user data after insert
            $result = mysqli_query($con, "SELECT * FROM profileid WHERE id = '$userid'");
            $user_data = mysqli_fetch_assoc($result);
         } else {
            $error_message = "Error creating profile: " . mysqli_error($con);
         }
      }
   }
}

// Handle image upload
if (isset($_POST['upload']) && isset($_FILES["profile_pic"]) && !empty($_FILES["profile_pic"]["name"])) {
   $fileName = $_FILES["profile_pic"]["name"];
   $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
   $allowedTypes = array("jpg", "jpeg", "png", "gif");
   $tempName = $_FILES["profile_pic"]["tmp_name"];
   
   // Generate unique filename
   $uniqueFileName = uniqid('profile_') . '.' . $ext;
   $uploadDir = "../member/uploads/";
   
   // Create directory if it doesn't exist
   if (!file_exists($uploadDir)) {
       mkdir($uploadDir, 0777, true);
   }
   
   $targetPath = $uploadDir . $uniqueFileName;

   // Check file type
   if (in_array($ext, $allowedTypes)) {
      // Move uploaded file to the target directory
      if (move_uploaded_file($tempName, $targetPath)) {
         // Check if user exists first
         $check_query = "SELECT * FROM profileid WHERE id = '$userid'";
         $check_result = mysqli_query($con, $check_query);
         
         if(mysqli_num_rows($check_result) > 0) {
            // Update existing record
            $update_pic_query = "UPDATE profileid SET pic='$uniqueFileName' WHERE id='$userid'";
         } else {
            // Insert new record
            $update_pic_query = "INSERT INTO profileid (id, pic) VALUES ('$userid', '$uniqueFileName')";
         }

         if (mysqli_query($con, $update_pic_query)) {
            $success_message = "Profile picture updated successfully!";
            header("Location: profile.php");
            exit(); // Make sure to exit after redirect
         } else {
            $error_message = "Error updating profile picture: " . mysqli_error($con);
         }
      } else {
         $error_message = "Failed to upload file.";
      }
   } else {
      $error_message = "Invalid file type. Allowed types are: jpg, jpeg, png, gif";
   }
}

// Refresh user data after any changes
if (isset($userid)) {
    $result = mysqli_query($con, "SELECT * FROM profileid WHERE id = '$userid'");
    $user_data = mysqli_fetch_assoc($result);
}



// Close the database connection
mysqli_close($con);

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Plastic-Waste-Management-System</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="asset/css/adminlte.min.css">
      <link rel="stylesheet" href="asset/css/style.css">
      <style>
         @media (max-width: 768px) {
            .login-box {
               width: 95% !important;
               margin-top: 10px;
            }

            .card-body {
               padding: 1rem;
            }

            .col-md-3, .col-md-9 {
               flex: 0 0 100%;
               max-width: 100%;
            }

            .col-md-4, .col-md-6 {
               flex: 0 0 100%;
               max-width: 100%;
               margin-bottom: 15px;
            }

            .form-group {
               margin-bottom: 1rem;
            }

            .profile-img-container {
               text-align: center;
               margin-bottom: 20px;
            }

            .profile-img-container img {
               width: 120px;
               height: 120px;
               object-fit: cover;
               margin: 0 auto;
            }

            .card-header {
               padding: 0.75rem;
            }

            .btn {
               margin-bottom: 10px;
               width: 100%;
            }

            .back-btn {
               position: fixed;
               top: 10px;
               left: 10px;
               z-index: 1000;
               background: rgba(28,153,84,0.9);
               color: white;
               padding: 8px 15px;
               border-radius: 5px;
               text-decoration: none;
            }

            .back-btn:hover {
               background: rgba(28,153,84,1);
               color: white;
            }

            .card-outline {
               margin-top: 40px;
            }

            .col-md-3, .col-md-9 {
               width: 100%;
               padding: 10px;
            }

            .form-group {
               margin-bottom: 1rem;
            }

            .row {
               margin: 0;
            }

            .card {
               border-radius: 5px;
            }

            .custom-file-input, .custom-file-label {
               font-size: 14px;
            }
         }

         /* General improvements */
         .form-control {
            margin-bottom: 10px;
         }

         .card-outline {
            border-top: 3px solid rgba(28,153,84);
         }

         .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
         }
      </style>
   </head>
   <body class="hold-transition login-page">
      <div class="wrapper">
      <section class="content">
         <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-md-12">
                  <div class="card card-outline">
                     <a href="javascript:void(0)" onclick="window.history.back()" class="back-btn">Back</a>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-3 text-center">
                              <img id="avatar-preview" class="img-fluid" 
                                 src="<?php echo !empty($user_data['pic']) ? '../member/uploads/' . $user_data['pic'] : 'asset/img/avatar.png'; ?>" 
                                 alt="Profile Picture" style="max-width: 200px; margin-bottom: 15px;">
                              <!-- File upload section -->
                              <form action="profile.php" method="post" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <div class="custom-file">
                                       <input type="file" class="custom-file-input" id="customFile" name="profile_pic" accept="image/*">
                                       <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                 </div>
                                 <button type="submit" name="upload" class="btn btn-success btn-block">Upload Picture</button>
                              </form>
                           </div>
                           <div class="col-md-9">
                              <form action="profile.php" method="post">
                                 <div class="card-header">
                                    <span class="fa fa-user"> Profile Information</span>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Middle Name</label>
                                          <input type="text" class="form-control" name="middleName" placeholder="middle name" 
                                                 value="<?php echo isset($user_data['middleName']) ? htmlspecialchars($user_data['middleName']) : ''; ?>">
                                       </div>
                                    </div>
                                   
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Birthday</label>
                                          <input type="date" class="form-control" name="birthday" 
                                                 value="<?php echo isset($user_data['birthday']) ? htmlspecialchars($user_data['birthday']) : ''; ?>">
                                       </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                       <div class="card-header">
                                          <span class="fa fa-key"> Account</span>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Username</label>
                                          <input type="text" class="form-control" name="userName" placeholder="username"
                                                 value="<?php echo isset($user_data['userName']) ? htmlspecialchars($user_data['userName']) : ''; ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row mt-3">
                                    <div class="col-6">
                                       <button type="submit" class="btn btn-block" style="background-color: rgba(28,153,84);color: rgb(235,235,235)" name="action" value="edit">Edit</button>
                                    </div>
                                    <div class="col-6">
                                       <button type="submit" class="btn btn-block" style="background-color: rgba(28,153,84);color: rgb(235,235,235)" name="action" value="save">Save</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div><br>
                     <?php if (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                     <?php endif; ?>
                     <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                     <?php endif; ?>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->

      <!-- JavaScript for image preview -->
      <script>
         $(document).ready(function() {
            // Image preview
            $('.custom-file-input').change(function() {
               var file = this.files[0];
               if (file) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                     $('#avatar-preview').attr('src', e.target.result);
                     $('#avatar-preview').show();
                  }
                  reader.readAsDataURL(file);
               }
            });
         });
      </script>
   </body>
</html>