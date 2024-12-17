<?php
session_start();

include 'DatabaseConnection.php';

if(isset($_POST['submit'])) {
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->startConnection();

    if($conn) {    
        $email = $_POST['email'];
        $password = md5($_POST['password']);
   
        $sql = "SELECT * FROM user_form WHERE email = :email AND password = :password";
     
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();

        
        if ($user) {      
            $user_type = $user['user_type'];
            if ($user_type == 'admin') {          
                $_SESSION['admin_name'] = $user['name'];           
                header('Location: homeAdmin.php');
                exit();
            } 
             
                if($user_type == 'user'){
                  $_SESSION['user_name'] = $user['name'];
                 header('Location: homeUser.php');
                 exit();
         }
            
        } else {
            $error[] = 'Email-i ose password-i janë gabim!';
        }
    } else {
        $error[] = 'Problem në lidhjen me bazën e të dhënave!';
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="register.css">
    
</head>
<header>
</header>
<body>
    <section class="container-forms">
        <div class="form-login">
            <div class="form-content">

                <form id="form" action="" method="post" onsubmit="return validateForm()">
                <header class="login-header">Login</header>

                
                    <div class="input-field">
                        <input id="email" type="email" placeholder="Email" class="input">
                    </div>
                    <div class="error-message" id="emailError"></div>


                    <div class="input-field">
                        <input id="password" type="password" placeholder="Password" class="password">
                        <i class="bx bx-hide eye-icon"></i>
                    </div>
                    <div class="error-message" id="passwordError"></div>


                    <div class="form-link">
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <div class="btn-group">
                        <button type="button" onclick="validateForm()">Login</button>
                    </div>

                    <div class="form-link">
                        <span>Don't have an account?</span><a href="register.html" class=" link login-link">Signup</a>
                    </div>
                </form>
            </div>
        </div>
    
    </section>
    <script>

function validateForm(){     
    let email = document.getElementById('email').value;
       let emailError = document.getElementById('emailError');

       let password = document.getElementById('password').value;
       let passwordError = document.getElementById('passwordError');

       emailError.innerText='';
       passwordError.innerText='';
       var emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if(email.trim()==''||!emailRegex.test(email)){
      emailError.innerText='Invalid email';

    return;
   }
   if(password.trim()==''||password.length<=6){
       passwordError.innerText = 'invalid password';

    return;
   }
}
    </script>
</body>
</html>