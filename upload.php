<?php
session_start();
include 'DatabaseConnection.php';

if (isset($_POST['submit']) && isset($_FILES['image_url'])) {
    $img_name = $_FILES['image_url']['name'];
    $img_size = $_FILES['image_url']['size'];
    $tmp_name = $_FILES['image_url']['tmp_name'];
    $error = $_FILES['image_url']['error'];

    if ($error === 0) {
        if ($img_size > 1250000000) { 
            $em = "Imazhi është shumë i madh";
            header("Location: addContent.php");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                // Generate unique file name and upload path
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'images/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert image name into the database
                $conn = new DatabaseConnection();
                $db_conn = $conn->startConnection();

                if ($db_conn) {
                    $sql = "INSERT INTO images(image_url) VALUES(:image_url)";
                    $stmt = $db_conn->prepare($sql);
                    $stmt->bindParam(':image_url', $new_img_name);
                    $stmt->execute();

                    header("Location: homeAdmin.php");
                    exit();
                } else {
                    $em = "Gabim në lidhjen me bazën e të dhënave!";
                    header("Location: addContent.php");
                    exit();
                }
            } else {
                $em = "Ju nuk mund të ngarkoni skedarë të këtij lloji";
                header("Location: addContent.php");
                exit();
            }
        }
    } else {
        $em = "Gabim i panjohur ka ndodhur!";
        header("Location: addContent.php?error=$em");
        exit();
    }
} else {
    header("Location: homeAdmin.php");
    exit();
}
?>