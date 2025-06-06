<?php
require_once('config.php');
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
         $query = "INSERT INTO profileid (gabageType, description, reward, pic) VALUES ('$garbagetype', '$message ', '$amount','$fileName')";

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
      <title>Plastic-Waste-Management-System</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="asset/css/adminlte.min.css">
      <link rel="stylesheet" href="asset/css/style.css">
   </head>
   <body class="hold-transition login-page">
      <a href="javascript:history.back()" class="back-btn">
         <i class="fas fa-arrow-left"></i> Back
      </a>
      <div class="login-box" style="width: 70%">
         <!-- /.login-logo -->
         <div class="card card-outline">
            <section class="content">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-header" style="background-color: rgba(28,153,84);color: rgb(235,235,235)">
                        <h3 class="card-title">Profile Information</h3>
                     </div>
                     <!-- /.card-header -->
                     <!-- form start -->
                     <form method="POST" action="profile.php" enctype="multipart/form-data">
                              <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <img src="asset/img/profile.png" width="150" style="border-radius: 5px">
                                    <label for="exampleInputFile">Choose Profile</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile">
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="card-header">
                                    <span class="fa fa-user"> Profile Information</span>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">First Name</label>
                                          <input type="email" class="form-control" placeholder="first name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Middle Name</label>
                                          <input type="email" class="form-control" placeholder="middle name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Last Name</label>
                                          <input type="email" class="form-control" placeholder="last name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Gender</label>
                                          <select class="form-control">
                                             <option>Male</option>
                                             <option>Female</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Birthday</label>
                                          <input type="date" class="form-control" placeholder="last name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Contact</label>
                                          <input type="number" class="form-control" placeholder="contact">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Email</label>
                                          <input type="email" class="form-control" placeholder="email">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Address</label>
                                          <input type="email" class="form-control" placeholder="address">
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
                                          <input type="email" class="form-control" placeholder="username">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Password</label>
                                          <input type="email" class="form-control" placeholder="**********">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="row">
                        <div class="col-6">
                        <button type="submit" class="btn btn-block" style="background-color: rgba(28,153,84);color: rgb(235,235,235)">Edit</button>
                     </div>
                     <div class="col-6">
                        <a href="" class="text-center btn btn-block" style="font-family: fantasy;background-color: rgba(28,153,84);color: rgb(235,235,235)">Save</a>
                     </div>
                  </div><br>
                     </form>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
   </body>
</html>