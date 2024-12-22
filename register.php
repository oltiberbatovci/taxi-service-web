<?php
session_start();

include_once 'DatabaseConnection.php';

if(isset($_POST['submit'])){

   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   // Krijo një instancë të klasës së lidhjes me bazën e të dhënave
   $dbConnection = new DatabaseConnection();
   // Fillo lidhjen me bazën e të dhënave
   $conn = $dbConnection->startConnection();

   $select = " SELECT * FROM user_form WHERE email = :email && password = :password ";
   $stmt = $conn->prepare($select);
   $stmt->execute(['email' => $email, 'password' => $pass]);

   if($stmt->rowCount() > 0){
     $error[] = 'user already exist! ';

   }else{
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(firstName, email, password) VALUES(:name, :email, :password)";
         $stmt = $conn->prepare($insert);
         $stmt->execute(['firstName' => $firstName, 'email' => $email, 'password' => $pass]);
         header('location:login.php');
      }
   }
};
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register form</title>
    
</head>
<!-- onsubmit=" validateForm();" action="home.html" -->
<body>
        
    <section class="container-forms">
        <div class="form-login">
            <div class="form-content">
                    <header class="login-header">Register</header>
         
           
                    <div class="input-field" >
                        <input id="firstName" type="text" placeholder="Name" class="input"  >

                    </div>
                    <div class="error-message" id="firstNameError"></div>
                    <!-- <p id="errorFName" style="color: red;"></p> -->

                  

                    <div class="input-field">

                        <input id="lastName" type="text" placeholder="Last name" class="input"  >
                    </div>                    
                    <div class="error-message" id="lastNameError"></div>
                    <!-- <p id="errorLName" style="color: red;"></p> -->



                    <div class="input-field">

                        <input type="email" placeholder="Email" class="input" id="email" >

                    </div>
                    <div class="error-message" id="emailError"></div>
                    <!-- <p id="errorEmail" style="color: red;"></p> -->



                    <div class="input-field">

                        <input type="password" placeholder="Password" class="password" id="password" >

                        <i class="bx bx-hide eye-icon"></i>
                    </div>
                        <div class="error-message" id="passwordError"></div>
                        <!-- <p id="errorPassword" style="color: red;"></p> -->



                    <div class="input-field">

                        <input type="password" placeholder="Confirm Password" class="password" id="confirmPassword" >

                        <i class="bx bx-hide eye-icon"></i>
                    </div>
                        <div class="error-message" id="confirmPasswordError"></div>
                        <!-- <p id="errorConfirmPassword" style="color: red;"></p> -->

                    <div class="btn-group">
                    <!--onclick="validateForm()" <button type="button" id="submit" onclick="validateForm()">Register</button> -->
                         <button  type="button" onclick="validateForm()">Register</button> 
                    </div>

                    <div class="form-link">
                        <span>Already have an account?</span><a href="login.html" class=" link login-link">Login</a>
                    </div>

            </div>
        </div>
    </section>
<script >
    function validateForm(){     
       let firstName = document.getElementById("firstName").value;
       let firstNameError = document.getElementById('firstNameError');

       let lastname = document.getElementById('lastName').value;
       let lastNameError = document.getElementById('lastNameError');
      
       let email = document.getElementById('email').value;
       let emailError = document.getElementById('emailError');

       let password = document.getElementById('password').value;
       let passwordError = document.getElementById('passwordError');

       let confirmPassword = document.getElementById('confirmPassword').value;
       let confirmPasswordError = document.getElementById('confirmPasswordError');

       firstNameError.innerText='';
       lastNameError.innerText='';
       emailError.innerText='';
       passwordError.innerText='';
       confirmPasswordError.innerText='';


   
     let regxname= /[a-zA-Z]/ ;
   if(firstName.trim()==""||!regxname.test(firstName)){
   firstNameError.innerText='invalid name';

     return;
   }
   let LastnameRegex=/[a-zA-Z]/;
    if (!LastnameRegex.test(lastname)){
     lastnameError.innerText='invalid last name';

        return;
   }
   var emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if(!emailRegex.test(email)){
      emailError.innerText='Invalid email';

    return;
   }
    if(password.length<=6){
       passwordError.innerText = 'invalid password';

    return;
   }
     if( password !== confirmPassword){
       //alert('no blank email');
     //  document.getElementById('confirmPasswordid').style.visibility='visible';
     confirmPasswordError.innerText = 'password in not same';
     return;
   }

}




</script>  
</body>
</html>