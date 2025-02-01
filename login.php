<?php
    session_start();
    include 'Perdoruesit.php';
    include 'PerdoruesitRepository.php';

    if(isset($_POST['login'])){
        if(empty($_POST['email']) || empty($_POST['password'])){
            echo '<script>alert("Please fill all fields!");</script>';
        }
        else{
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userRepository = new PerdoruesitRepository();
            $users = $userRepository->getAllUsers();
            foreach($users as $user){
                if($user['email'] == $email && $user['password'] == $password){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['role'] = $user['role'];
                    
                    if ($_SESSION['role'] == 'admin') {
                        header("Location: homeAdmin.php");
                        exit();
                    } else {
                        header("Location: homeUser.php");
                        exit();
                    }
                }
            }
            if(!$userRepository->emailExists($email)){
                $emailError = 'Email doesn\'t exist! Please register!';
            } 
            else if(!password_verify($password, $user['password'])){
                $pswError = 'Password incorrect!';
            }
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
<body>
    <section class="container-forms">
        <div class="form-login">
            <div class="form-content">
                <form id="form" action="" method="post" onsubmit="return validateForm()">
                    <header class="login-header">Login</header>

                    
                    <?php
                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo "<div class='error-message'>$err</div>";
                        }
                    }
                    ?>

                    <div class="input-field">
                        <input id="email" name="email" type="email" placeholder="Email" class="input">
                    </div>
                    <div class="error-message" id="emailError"></div>

                    <div class="input-field">
                        <input id="password" name="password" type="password" placeholder="Password" class="password">
                        <i class="bx bx-hide eye-icon"></i>
                    </div>
                    <div class="error-message" id="passwordError"></div>

                    <div class="form-link">
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <div class="btn-group">
                        <button type="submit" name="login">Login</button>
                    </div>

                    <div class="form-link">
                        <span>Don't have an account?</span> 
                        <a href="register.php" class="link login-link">Signup</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    function validateForm() {     
        let email = document.getElementById('email').value;
        let emailError = document.getElementById('emailError');

        let password = document.getElementById('password').value;
        let passwordError = document.getElementById('passwordError');

        emailError.innerText = '';
        passwordError.innerText = '';

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email.trim() === '' || !emailRegex.test(email)) {
            emailError.innerText = 'Invalid email';
            return false; 
        }
        
        if (password.trim() === '' || password.length <= 6) {
            passwordError.innerText = 'Password must be at least 7 characters';
            return false; 
        }

        return true;
    }
    </script>
</body>
</html>