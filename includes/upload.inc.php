<?php
require 'includes/dbconnect.php';
session_start();

$target_dir = "upload/";
$target_file = $target_dir . uniqid() . "_" . basename($FILES["fileupload"]["name"]); //use unique name to overwrite
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$id = $_SESSION['id'];
$sql = "SELECT cus_pic FROM customer WHERE id = ?";
$stmt = $pdo->prepare($sql);
$row = $stmt([$cus_id]);
$old_image = $row['pic'];

//check if $uploadOk is set to 0 by an error
if (isset($_POST["submit"])) {

    //check the image file size
    if ($_FILES["fileupload"]["name"] > 500000) {
        echo "File is too large";
        $uploadOk = 0;
    }

    //check image file format
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Only jpg, png, and jpeg are allowed";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        //papaltan yung old image if nag exists
        if (!empty($old_image) && (file_exists("upload/" . $old_image))) {
            unlink("upload/" . $old_image); // dito ay madedelete yung old image
        }

        //upload new image
        if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)) {
            echo "Your image has been uploaded";

            //upload yung image sa database
            $new_image = basename($target_file);
            $update = "UPDATE customer SET cus_pic = ?";
            $stmt = $pdo->prepare($update);
            $stmt->execute([$new_image, $cus_id]);
        } else {
            echo "Error upload image";
        }
    }
}
