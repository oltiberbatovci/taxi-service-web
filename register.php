<?php
include 'DatabaseConnection.php';
session_start();

$error = [];

if (isset($_POST['submit'])) {
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->startConnection();

    if ($conn) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Check if fields are empty
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            $error[] = "All fields are required!";
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Invalid email format!";
        }

        // Check if password matches confirm password
        if ($password !== $confirm_password) {
            $error[] = "Passwords do not match!";
        }

        // Ensure password is secure
        if (strlen($password) < 7) {
            $error[] = "Password must be at least 7 characters!";
        }

        // Check if email already exists in the database
        $sql = "SELECT * FROM user_form WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            $error[] = "Email already exists!";
        }

        // If no errors, insert into database and log in automatically
        if (empty($error)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_sql = "INSERT INTO user_form (name, email, password) VALUES (:name, :email, :password)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password
            ]);

            // Automatically log in the user
            $_SESSION['user_name'] = $name;
            
            // Redirect to homeUser.php
            header("Location: homeUser.php");
            exit();
        }
    } else {
        $error[] = "Database connection error!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
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
                        <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password" class="password">
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
        let confirmPassword = document.getElementById('confirm_password').value;

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
