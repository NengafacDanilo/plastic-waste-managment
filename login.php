<?php  
            require_once("config.php");
           
              
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="asset/css/main.css">
</head>
<body>
    <section class="sign-in">
         <?php
         if(isset($_POST['submit'])){
            $email =$_POST['email'];
            $password =$_POST['password'];
            $password =md5($password);

            
            $result = mysqli_query($con,"SELECT  email, password FROM registration_form WHERE email='$email' ") ;



            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                if(($password === $row['password'])){
                   if($row['isadmin'] == 1){
                    $_SESSION['user'] = $row['id'];
                    $_SESSION['lastName'] = $row['lastName'];
                    header("Location: admin\index.php");
                   } else {
                    $_SESSION['user'] = $row['id'];
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['lastName'] = $row['lastName'];
                    header("Location: member\index.php");
                    exit();
                   }
               
            }
            else{
                echo "<div class='message'>
                        <p>Wrong Email or Password</p>
                      </div> <br>";
                
            }
          }
        

         }
        ?> 
       
        <article class="sign-in_details">
            
            <h1>Sign In</h1>
            <p>Log in to your account using your credentials</p>
            <form action="login.php" method="POST" class="sign-in_form">
                <div class="form_control">
                    <label for="email">Email</label>
                    <input type="email" id="email" 
                    name="email" placeholder="Enter your email">       
                </div>
                <div class="form_control">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">       
                </div>
                <div class="sign-in_extras">
                    <div>
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember for 30 days</label>
                    </div>
                        <a href="">Forgot password?</a>
                </div>
                <button class="btn primary" type="submit" name="submit">Sign In</button>
                <button class="btn">
                    <img src="./download.png" alt="">
                    <p>Sign in with google</p>
                </button>
            </form>
            <small class="next__page">Don't have an account? <a href="signup.php">Sign up</a></small>
        </article>
        <article class="sign-in__logo">
            <img src="asset/img/logo.png" alt="" width="200">
            <h1 id="center-text">TRANSCYCLE </h1> 
            <p id="text">TransCycle has a maximun of 1 hour to complian if waste is not been collected </p>
        </article>
    </section>  

  
</body>
</html>