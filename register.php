<?php
session_start();
include 'Perdoruesit.php';
include 'PerdoruesitRepository.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        $role = 'user';

        if(empty($name) || empty($email) || empty($password) || empty($confirm)){
                echo "<script> alert('Please fill all fields!');</script>";
        }
        else{
            $user = new Perdoruesit(null, $name, $email, $password, $confirm, $role);
            $userRepository = new PerdoruesitRepository();
            $userRepository->insertUser($user);
            echo "<script> alert('Register was successful!'); 
            window.location = 'login.php';</script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <section class="container-forms">
        <div class="form-login">
            <div class="form-content">
                <form id="form" action="" method="post" onsubmit="return validateForm()">
                    <header class="login-header">Register</header>

                    <?php
                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo "<div class='error-message'>$err</div>";
                        }
                    }
                    ?>

                    <div class="input-field">
                        <input id="name" name="name" type="text" placeholder="Full Name" class="input">
                    </div>
                    <div class="error-message" id="nameError"></div>

                    <div class="input-field">
                        <input id="email" name="email" type="email" placeholder="Email" class="input">
                    </div>
                    <div class="error-message" id="emailError"></div>

                    <div class="input-field">
                        <input id="password" name="password" type="password" placeholder="Password" class="password">
                    </div>
                    <div class="error-message" id="passwordError"></div>

                    <div class="input-field">
                        <input id="confirm" name="confirm" type="password" placeholder="Confirm Password" class="password">
                    </div>
                    <div class="error-message" id="confirmPasswordError"></div>

                    <div class="btn-group">
                        <button type="submit" name="submit">Register</button>
                    </div>

                    <div class="form-link">
                        <span>Already have an account?</span> 
                        <a href="login.php" class="link login-link">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
    function validateForm() {     
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let confirmPassword = document.getElementById('confirm').value;

        let nameError = document.getElementById('nameError');
        let emailError = document.getElementById('emailError');
        let passwordError = document.getElementById('passwordError');
        let confirmPasswordError = document.getElementById('confirmPasswordError');

        nameError.innerText = '';
        emailError.innerText = '';
        passwordError.innerText = '';
        confirmPasswordError.innerText = '';

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let valid = true;

        if (name.trim() === '') {
            nameError.innerText = 'Name is required';
            valid = false;
        }

        if (email.trim() === '' || !emailRegex.test(email)) {
            emailError.innerText = 'Invalid email';
            valid = false;
        }

        if (password.trim() === '' || password.length < 7) {
            passwordError.innerText = 'Password must be at least 7 characters';
            valid = false;
        }

        if (confirmPassword !== password) {
            confirmPasswordError.innerText = 'Passwords do not match';
            valid = false;
        }

        return valid;
    }
    </script>
</body>
</html>