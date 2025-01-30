<?php
session_start();

include 'DatabaseConnection.php';


if(!isset($_SESSION['user_name'])){
   header('location:login.php');
   exit(); 

}
$dbConnection = new DatabaseConnection();
$conn = $dbConnection->startConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                <a href="login.php"><button id="login-btn">Login</button></a>
              </div>
            </div>
          </nav>
    </section>


    <!-- Home -->
    <main>

    <section id="home-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="p1-title">WELCOME TO ONE OF THE LARGEST <span>TAXI</span> FLEETS OF <span id="span-pr">PRISHTINA</span></p>
                    <p class="p2-description">Zgjedhja juaj sapo eshte bere me e lehte. Me ne do te keni mundesine te kurseni kohen tuaj. Shpejte, sigurt dhe efikas. Te gjitha ne nje vend!</p>
                    <h1 class="welcome" style="text-align:center;font-size:13px;">Welcome User : <span><?php echo $_SESSION['user_name'] ?></span></h1>                
                </div>
                <div id="kontenti">
                  <header>
                  <img id="slideshow" />
                  </header>
              </div>
              <style type ="text/css">
              #kontenti {
                  display: flex ;
                  /* padding: 20px; */
                  padding-bottom: 30px;
                  flex-direction: column;
                  justify-content: end;
                  align-items: center;
                  font-family: 'Segoe UI light', Tahoma;
                  width: 500px;
                  margin:0 auto;
              }
              #kontenti img {
                  max-width: 700px;
                  height: 400px;
                  border-radius: 50px;
                  box-shadow: 5px 5px 7px rgba(0, 0, 0, 0.4);
              }
            
              </style>
            <script>
                  let i = 0;
                  let imgArray = ['images/blue-taxi1.png','images/golden-taxi2.png','images/Pink-taxi2.png','images/urban-taxi.png','images/e-taxi-tesla.png'];
            
                  function changeImg(){
                      document.getElementById('slideshow').src = imgArray[i];
            
                      if(i< imgArray.length -1){
                          i++;
                      }
                      else{
                          i=0;
                      }
                      setTimeout("changeImg()", 2600);
                  }
                  document.addEventListener(onload, changeImg());
                  
              </script>
            </div>
        </div>

        <img src="images/wave1.png" class="botom-img">
    </section>

    <!-- boxes -->
    <h1 style="display: flex;justify-content: center; font-weight: bolder; color: black;">BASHKEPUNIMI ME NE OFRON:</h1>
    <div class="cards">
        <div class="box-container">
            <div class="box">
                <img src="images/operator.png" alt="">                
                <p>SHERBIM CILESOR</p>
            </div>
    
            <div class="box">
                <img src="images/shield.png" alt="">
                <p>SIGURI MAKSIMALE</p>
            </div>
    
            <div class="box">
                <img src="images/24-7.png" alt="">
                <p>SHERBIM 24 ORE</p>
            </div>
    
            <div class="box">
                <img src="images/euro.png" alt="">
                <p>CMIME KONKURUESE</p>                   
            </div>
        </div>
    </div>

    <!-- Content -->

    <h2 style="font-weight: bolder; color: black;padding-top: 40px;">PARTNERET TANE KRYESOR JANE</h2>
    <div class="photos">
            
             
          <?php 
                $sql = "SELECT * FROM images ORDER BY id DESC";
                 $res = $conn->query($sql);

                if ($res->rowCount() > 0) {
                    while ($images = $res->fetch(PDO::FETCH_ASSOC)) {  
        ?>
             <div class="rubrika" >
             	<img src="images/<?=$images['image_url']?>" alt="" class="img" height="500px" width="450px" >
                 <div class="button">
                  <button onclick="location.href='order.php'" type="button" class="blue-button">REZERVO TAXI</button>
              </div>
            </div>
             
      <?php } }?>
  </div>
</main>

<!-- Footer -->
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
</body>
</html>