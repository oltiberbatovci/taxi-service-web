
<?php
include 'PerdoruesitRepository.php';
$id = $_GET['id'];//e merr id e studentit prej url

$strep = new PerdoruesitRepository();
$Perdoruesi = $strep->getUserById($id);
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="edit.css"> 
<body>
    <h3 id="h3">Edit Perdoruesin</h3>
    <form action=" #" method="post">
     <!-- nese nuk duam t'i ndryshojme te gjitha te dhenat, e perdorim kete pjesen tek value qe te na shfaqen vlerat aktuale, ashtu qe atributet qe nuk duam t'i ndryshojme mbesin te njejta pa pasur nevoje t'i shkruajme prape-->
      <p>Emri</p> 
     <input type="text" name="name" placeholder="Emri" value="<?php echo $Perdoruesi['name']?>"> <br> <br> <!-- Pjesa brenda [] eshte emri i sakte i atributit si ne Databaze-->
     <p>Email</p>   
     <input type="email" name="email" placeholder="Email" value="<?php echo $Perdoruesi['email']?>"> <br> <br>
     <p>Role</p>  
     <input type="text" name="user_type" placeholder="Role" value="<?php echo $Perdoruesi['role']?>"> <br> <br>

        <input type="submit" name="buton" value="SAVE"> <br> <br>
    </form>
</body>
</html>

<?php 

if(isset($_POST['buton'])){
    $id = $Perdoruesi['id']; //merret nga studenti me siper
    $name = $_POST['name']; //merret nga formulari
    $email = $_POST['email'];
    $role = $_POST['role'];


    $strep->updateUser($id,$name,$email,$password,$role);
    header("location:dashboard.php");
}

?>