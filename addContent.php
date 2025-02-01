<?php
session_start();
include 'DatabaseConnection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>ADD COMPANY</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        h1 {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        #foto {
            display: block;
            justify-content: space-between;
            padding: 5px;
            margin: 50px;
        }
    </style>
</head>
<body>
    <h1>Shto Foton :</h1>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php endif ?>

    <?php if (isset($_GET['success'])): ?>
        <script>
            alert("<?php echo $_GET['success']; ?>");
        </script>
    <?php endif ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input id="foto" type="file" name="image_url">
        <input id="foto" type="submit" name="submit" value="Upload">
    </form>

</body>
</html>