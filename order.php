<?php
include_once 'Rezervimi.php';
include_once 'RezervimiRepository.php';

if (isset($_POST['submit'])) {
    $emri = $_POST['emri'];
    $email = $_POST['email'];
    $nrkontaktues = $_POST['Nrcontact'];
    $vendndodhja = $_POST['location'];

    $errors = array();

    if(empty($emri) || empty($email) || empty($nrkontaktues) || empty($vendndodhja)){
            $errors[] = "All fields are required!";
        }else{
    $Rezervim = new Rezervimi($emri, $email, $nrkontaktues,$vendndodhja);
    $rezervimiRepository = new RezervimiRepository();
    $rezervimiRepository->insertRezervimet($Rezervim);
    header("location:order.php");
}
}
?>
<?php if (!empty($errors)) { ?>
    <div class="error-message" id="allFieldsError">
        <?php foreach ($errors as $error) {
            echo $error . "<br>";
        } ?>
    </div>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <title>YOUR ORDER</title>
</head>
<body>
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-logo" href="index.php">ThirreTaxin</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">HOME</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about.php">ABOUT</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="order.php">POROSIT</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACT</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="punesimi.php">PUNESOHU</a>
                  </li>
                </ul>
                <a href="login.html"><button id="login-btn">Login</button></a>
              </div>
            </div>
          </nav>
    </section>

     <main>

        <div class="form-container">
            <form id="form" action="" method="post" onsubmit="return validateForm()">
               <h3>REZERVO UDHETIMIN TEND</h3>

               <div class="input-field">
                <p style="font-size: 16px;">Emri dhe Mbiemri</p>
               <input type="text" name="emri"  id="emri" placeholder="Shkruaj emrin">
               <div class="error-message" id="emriError"></div>
            </div>
         
            <div class="input-field">
               <p style="font-size: 16px;">Email</p>
               <input type="email" name="email" id="email"  placeholder="Shkruaj email-in">
               <div class="error-message" id="emailError"></div>
            </div>

            <div class="input-field">
               <p style="font-size: 16px;">Numri kontaktues</p>
                <input id="Nrcontact" type="number" name="Nrcontact" placeholder="Shkruaj numrin e telefonit:">
                <div class="error-message" id="NrcontactError"></div>
            </div>

            <div class="input-field">
                <p style="font-size: 16px;">Shkruaj vendndodhjen tuaj</p>
                <input id="location" type="text" name="location" placeholder="Tregoni ku gjendeni:">
            <div class="error-message" id="locationError"></div>
            </div>

            <select name="cars" id="cars">
                <option value="disabled" style="text-align: center;">Zgjedh Kompanine</option>
                <option value="tesla">E-Taxi TESLA</option>
                <option value="online">Online TAXI</option>
                <option value="urban">Urban TAXI</option>
                <option value="pink">PINK TAXI</option>
                <option value="golden">Golden TAXI</option>
                <option value="blue">Blue TAXI</option>
              </select>

              <p style="justify-content: center;"><small>Detajet e porosise do t'i pranoni me email.</small></p>

            <button name="submit"class="porosia-butoni" type="submit" onclick="return validateForm()"> Porosit</button>        
        </form>
    </div>

    <script>
      function validateForm(){
          let emri=document.getElementById('emri').value;
          let emriError=document.getElementById('emriError');
  
          let email=document.getElementById('email').value;
          let emailError=document.getElementById('emailError');

          let Nrcontact=document.getElementById('Nrcontact').value;
          let NrcontactError=document.getElementById('NrcontactError');
          
          let location=document.getElementById('location').value;
          let locationError=document.getElementById('locationError');
  
          emriError.innerText='';
          emailError.innerText='';
          NrcontactError.innerText='';
          locationError.innerText='';
  
          let emriRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
              if(emri.trim()==""||!emriRegex.test(emri)){
                emriError.innerText="Emri eshte invalid";
                  return false;
              }
              if(email.trim()==""){
                emailError.innerText='Email-i eshte i zbrazet';
                  return false;
              }
              return true;

              if(Nrcontact<1){
                NrcontactError.innerText='Duhet te shkruash numrin!';
                return false;
              }
              return true;
      }
  </script>
  
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">START</th>
                        <th scope="col">DESTINACIONI</th>
                        <th scope="col">CMIMI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>PRISHTINE</td>
                        <td>RRETHINE</td>
                        <td>TAXIMETER</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>PRISHTINE</td>
                        <td>PEJE</td>
                        <td>40 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>PRISHTINE</td>
                        <td>GJILAN</td>
                        <td>30 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>PRISHTINE</td>
                        <td>FERIZAJ</td>
                        <td>40 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">5</th>
                        <td>PRISHTINE</td>
                        <td>PODUJEVE</td>
                        <td>25 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">6</th>
                        <td>PRISHTINE</td>
                        <td>DEQAN</td>
                        <td>60 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">7</th>
                        <td>PRISHTINE</td>
                        <td>BREZOVICE</td>
                        <td>55 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">8</th>
                        <td>PRISHTINE</td>
                        <td>PRIZREN</td>
                        <td>50 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">9</th>
                        <td>PRISHTINE</td>
                        <td>KAMENICE</td>
                        <td>40 EUR</td>
                      </tr>
                      <tr>
                        <th scope="row">10</th>
                        <td>PRISHTINE</td>
                        <td>AEROPORT</td>
                        <td>15 EUR</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  

    </main>
    <footer>
        <div class="footermain">
            <a class="footer-logo" href="index.html">ThirreTaxin</a>
            <p class="p2-description" style="width: 40%; padding: 20px;">Zgjedhja juaj sapo eshte bere me e lehte. Me ne do te keni mundesine te kurseni kohen tuaj. Shpejte, sigurt dhe efikas. Te gjitha ne nje vend!
            Platforma me e re ne treg e flotes se taksive me gjithsej 6 operatore nen sherbimin tuaj 24/7.</p>
        
    
        <div class="footer-center">
            <h4>Links</h4>
            <a href="https://www.facebook.com/">Facebook</a>
            <a href="https://www.instagram.com/">Instagram</a>
            <a href="https://www.google.com/">Google</a>
        </div>
    
        <div class="footer-right">
            <h4>Contact</h4>
                <p>044 123 123</p>
                <p>045 345 678</p>
                <p>0800 1111 55</p>
        </div>
        </div>
        <p class="paragrafi-footer">
            <small>All rights reserved &copy; Created By Olti</small>
        </p>
    </footer>
        <script>
               
            let i=0;
            let imgArray =['blue-taxi2.png','e-taxi-tesla.png','golden-taxi.png','online-taxi.png','Pink-taxi.png','urban-taxi.png'];
       
            function changeImg(){
                
                document.getElementById('slideshow').scr=imgArray[i];
                    if(i<imgArray.length-1){
                        i++;
                    }
                    else{
                        i=0;
                        }
            }
                document.addEventListener(onload,changeImg());
       

            function validateForm() {
    let emri = document.getElementById('emri').value;
    let emriError = document.getElementById('emriError');

    let email = document.getElementById("email").value;
    let emailError = document.getElementById('emailError');

    let Nrcontact = document.getElementById('Nrcontact').value;
    let NrcontactError = document.getElementById('NrcontactError');

    let location = document.getElementById('location').value;
    let locationError = document.getElementById('locationError');
    let allFieldsError = document.getElementById('allFieldsError');

    let hasErrors = false; 

    emriError.innerText = '';
    emailError.innerText = '';
    NrcontactError.innerText = '';
    locationError.innerText = '';
    allFieldsError.innerText = '';

    let regxemri = /[a-zA-Z]/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let NrcontactRegex =  /[0-9]/;
    let locationRegex = /[a-zA-Z]/;

    if ( !regxemri.test(NameAndLastName)) {
        emriError.innerText = 'Emri invalid';
        hasErrors = true;
        return false;
    }

    if (!emailRegex.test(email)) {
        emailError.innerText = 'Invalid email';
        hasErrors = true;
        return false;
    }

    if (!NrcontactRegex.test(Nrcontact)) {
        NrcontactError.innerText = 'Invalid nrContact';
        hasErrors = true;
        return false;
    }

    if (!locationRegex.test(location)) {
        locationError.innerText = 'invalid location';
        hasErrors = true;
        return false;
    }
    
    if (emri.trim() === "" || email.trim() === "" || Nrcontact.trim() === "" || location.trim() === "") {
        hasErrors = true;
        return false;
    }
    if (hasErrors) {
        document.getElementById('allFieldsError').innerText = 'Te gjitha hapsirat duhet te jene te mbushura ';
        return false;
    }
    return true;

}   
       </script>
</body>
</html>