<?php  
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="asset/css/main.css">
</head>
<body>
    <section class="sign-in">
         <?php
         if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = md5($_POST['password']);

            // Using prepared statement to prevent SQL injection
            $stmt = $con->prepare("SELECT id, email, password, lastName, isadmin FROM registration_form WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($password === $row['password']){
                    $_SESSION['user'] = $row['id'];
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['lastName'] = $row['lastName'];
                    
                    if($row['isadmin'] == 1){
                        header("Location: admin/index.php");
                    } else if($row['isadmin'] == 0){
                        $_SESSION['success'] = "Welcome " . $row['lastName'];
                        $_SESSION['user'] = $row['id'];
                        $_SESSION['valid'] = $row['email'];
                        $_SESSION['lastName'] = $row['lastName'];
                        header("Location: member/index.php");
                    } else {
                        header("Location: gabage-collector\index.php");
                    }
                    exit();
                } else {
                    $_SESSION['error'] = "Wrong Password";
                }
            } else {
                $_SESSION['error'] = "Email not found";
            }
            $stmt->close();
        }

        // Replace the existing popup code with this
        if (isset($_SESSION['error']) || isset($_SESSION['success'])) {
            $type = isset($_SESSION['error']) ? 'error' : 'success';
            $message = isset($_SESSION['error']) ? $_SESSION['error'] : $_SESSION['success'];
            $icon = $type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';
            
            echo '
            <div class="popup-overlay"></div>
            <div class="popup-message ' . $type . '" id="popup">
                <div class="popup-content">
                    <i class="fas ' . $icon . '"></i>
                    <p>' . htmlspecialchars($message) . '</p>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const popup = document.getElementById("popup");
                    const overlay = document.querySelector(".popup-overlay");
                    
                    // Show popup
                    setTimeout(() => {
                        overlay.style.visibility = "visible";
                        overlay.style.opacity = "1";
                        popup.classList.add("show");
                    }, 100);
                    
                    // Hide popup
                    setTimeout(() => {
                        popup.classList.remove("show");
                        overlay.style.opacity = "0";
                        setTimeout(() => {
                            overlay.style.visibility = "hidden";
                            popup.style.display = "none";
                        }, 400);
                    }, 3000);
                });
            </script>
            ';
            
            unset($_SESSION['error'], $_SESSION['success']);
        }
        ?> 
       
        <article class="sign-in_details">
            
            <h1>Sign In</h1>
            <p>Log in to your account using your credentials</p>
            <form action="login.php" method="POST" class="sign-in_form">
                <div class="form_control">
                    <label for="email">Email</label>
                    <input type="email" id="email" 
                    name="email" placeholder="Enter your email" required>       
                </div>
                <div class="form_control">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password " required>       
                </div>
                <div class="sign-in_extras">
                    <div>
                        <input type="checkbox" id="remember" >
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