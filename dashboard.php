
<?php 
session_start();
include "DatabaseConnection.php";
include_once "aplikimetRepository.php";
include ("ContactRepository.php");
include("RezervimiRepository.php");
include("PerdoruesitRepository.php");

// if(!isset($_SESSION['admin_name'])){
//     header('location:login.php');
//     exit(); 
//  }


$strep = new aplikimetRepository();
$allAplikimet = $strep->getAllAplikimetPunes();

$stre1 = new ContactRepository();
$allKontaktat = $stre1->getAllKontakti();

$stre2 = new RezervimiRepository();
$allRezervimi = $stre2->getAllRezervimet();


$stre3 = new PerdoruesitRepository();
$allUsers = $stre3->getAllUsers();

?>


<!DOCTYPE html>

<html>
    <body>
        <link rel="stylesheet" href="dashboard.css"> 
        <table>
            <thead>
            <tr>
                <h3 id="h3">USERS</h3>
                <th>Emri</th>
                <th>Email</th>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($allUsers as $Perdoruesi) { ?> <!--e hapim foreach-->
                    <tr>
                        <td><?php echo $Perdoruesi['name'];?></td>
                        <td><?php echo $Perdoruesi['email'];?></td>
                        <td><?php echo $Perdoruesi['role'];?></td>
                        <td><a href='editPerdoruesit.php?id=<?php echo $Perdoruesi['id']?>'>Edit</a></td> <!--e dergojme id ne url permes pjeses ?id= dhe permes kodit ne php e marrim nga studenti i cili eshte i paraqitur ne kete rresht-->
                        <td><a href='deletePerdoruesit.php?id=<?php echo $Perdoruesi['id']?>'>Delete</a></td>
                    </tr>
                <?php }?> <!--e mbyllim foreach-->
            </tbody>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html>
    <body>
        <table>
            <thead>
            <tr>
                <h3 id="h3">ORDERS</h3>
                <th>Emri</th>
                <th>Email</th>
                <th>NrKontaktues</th>
                <th>Lokacioni</th>
                <th></th>
                <th></th>
         
            </tr>
            </thead>
            <tbody>
                <?php foreach($allRezervimi as $rezervim) { ?> <!--e hapim foreach-->
                    <tr>
                        <td><?php echo $rezervim['emri'];?></td>
                        <td><?php echo $rezervim['email'];?></td>
                        <td><?php echo $rezervim['nrkontaktues'];?></td>
                        <td><?php echo $rezervim['vendndodhja'];?></td>
                 
                     
                        <td><a href='editRezervimi.php?id=<?php echo $rezervim['id']?>'>Edit</a></td> <!--e dergojme id ne url permes pjeses ?id= dhe permes kodit ne php e marrim nga studenti i cili eshte i paraqitur ne kete rresht-->
                        <td><a href='deleteRezervimi.php?id=<?php echo $rezervim['id']?>'>Delete</a></td>
                    </tr>
                <?php }?> <!--e mbyllim foreach-->
            </tbody>
        </table>
    </body>
</html>

<!DOCTYPE html>
<html>
    <body>
        <table >
            <thead>
            <tr>
                <h3 id="h3">APLIKANTET E PUNES</h3>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Emaili</th>
                <th>Nenshtetsia</th>
                <th>Qyteti</th>
                <th>Adresa</th>
                <th></th>
                <th></th>
               
            </tr>
            </thead>
            <tbody>
                <?php foreach($allAplikimet as $student) { ?> <!--e hapim foreach-->
                    <tr>
                        <td><?php echo $student['emri'];?></td>
                        <td><?php echo $student['mbiemri'];?></td>
                        <td><?php echo $student['email'];?></td>
                        <td><?php echo $student['nenshtetsia'];?></td>
                        <td><?php echo $student['qyteti'];?></td>
                        <td><?php echo $student['adresa'];?></td>
                     
                        <td><a href='edit.php?id=<?php echo $student['id']?>'>Edit</a></td> <!--e dergojme id ne url permes pjeses ?id= dhe permes kodit ne php e marrim nga studenti i cili eshte i paraqitur ne kete rresht-->
                        <td><a href='delete.php?id=<?php echo $student['id']?>'>Delete</a></td>
                    </tr>
                <?php }?> <!--e mbyllim foreach-->
            </tbody>
        </table>
    </body>
</html>

<!DOCTYPE html>
<html>
    <body>
        <table>
            <thead>
            <tr>
                <h3 id="h3">CONTACT LIST</h3>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Emaili</th>
                <th>Ankesa</th>
                <th></th>
                <th></th>
         
            </tr>
            </thead>
            <tbody>
                <?php foreach($allKontaktat as $student) { ?> <!--e hapim foreach-->
                    <tr>
                        <td><?php echo $student['fname'];?></td>
                        <td><?php echo $student['lname'];?></td>
                        <td><?php echo $student['email'];?></td>
                        <td><?php echo $student['subject'];?></td>
                      
                        <td><a href='editContact.php?id=<?php echo $student['id']?>'>Edit</a></td> <!--e dergojme id ne url permes pjeses ?id= dhe permes kodit ne php e marrim nga studenti i cili eshte i paraqitur ne kete rresht-->
                        <td><a href='deleteContact.php?id=<?php echo $student['id']?>'>Delete</a></td>
                    </tr>
                <?php }?> <!--e mbyllim foreach-->
            </tbody>
        </table>
    </body>