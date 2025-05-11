<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="asset/css/main.css?v=<?php echo date('Y-m-d-H-i-s'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
 <?php
            $firstname = $lastname = $email = $gender = $contact = $address = $role = $password = "";

            // process form data if it was submitted
            if (isset($_POST['submit'])) {
                $firstname = $_POST["firstname"];
                $lastname = ($_POST["lastname"]);
                $email = $_POST["email"];
                $gender = $_POST["gender"];
                $contact = $_POST["contact"];
                $address = $_POST["address"];
                $password = $_POST["password"];
                $password = md5($password);

                //verifying the unique email

                $verify_query = mysqli_query($con, "SELECT email FROM registration_form WHERE email='$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {

                    mysqli_query($con, "INSERT INTO registration_form(firstName, lastName, email, gender,contact,address,  password) VALUES('$firstname', '$lastname', '$email',  '$gender','$contact','$address', '$password')") or die("Erroe Occured");

                    echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
                    Header('Location:login.php');
                }
            } else {



            ?> 

    <section class="sign-in">
        <article class="sign-in_details">
            <h1>Sign Up</h1>
            <p>Sign up in to your account</p>
            <form id="form" method="post" action="">

                <div class="form_control">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" placeholder="Enter your First Name" name="firstname"
                        value="">
                    <small></small>
                </div>
                <div class="form_control">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" placeholder="Enter your Last Name" name="lastname"
                        value="" >
                    <small></small>
                </div>
                <div class="form_control">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your Email" name="email"
                        value="" required>
                    <small></small>
                </div>
                <div class="form-control">
                <label for="gender">Gender</label>
                <br>
                    <select name="gender" id="gender">
                    <option>Male</option>
                    <option>Female</option>
                    </select>
                       
        
                </div>
                <div class="form_control">
                    <label for="contact">Contact</label>
                    <input type="text" id="department" placeholder="Enter your Contact" name="contact"
                        value="" required>

                </div>
                <div class="form_control">
                    <label for="address">Address</label>
                    <input type="text" id="department" placeholder="Enter your Address" name="address"
                        value="" required>

                </div>

                <div class="form_control">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password" name="password" required>
                    <small></small>
                </div>
                <div class="sign-in_extras">
                    <div>
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember for 30 days</label>
                    </div>
                    <a href="">Forgot password?</a>
                    <br>
                </div>
                <div>
                    <button class="btn primary" type="submit" name="submit"><a href=""></a>Sign Up</button>

                </div>
                <div>
                    <button class="btn">
                        <li><i class='bx bxl-google'></i></li>

                        <p>Sign Up with Google</p>
                    </button>
                </div>
            </form>
        </article>
        <article class="sign-in__logo">
            <img src="asset/img/logo.png" width="200">
            <h1 id="center-text">TRANSCYCLE </h1>
            <br>
            <p id="text">TransCycle is a web-based application that helps to manage Plastic waste collection process in a more efficient and effective way.</p>
        </article>
         <?php } ?> 
    </section>
    <!-- <script src="./form.js"></script> -->
</body>

</html>