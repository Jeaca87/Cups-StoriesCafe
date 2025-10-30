<?php
require 'dbconnect.php';
session_start();

if (isset($_POST["submit"]) && isset($_FILES["fileupload"])) {
    $target_dir = "upload/";
    $uniqueName = uniqid() . "_" . basename($_FILES["fileupload"]["name"]);
    $target_file = $target_dir . $uniqueName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // kunin menu id
    $m_id = $_SESSION['m_id'];

    // kunin old image
    $sql = "SELECT image FROM menu WHERE m_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$m_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $old_image = $row['image'] ?? null;

    // check file size
    if ($_FILES["fileupload"]["size"] > 500000) {
        echo "File is too large.";
        $uploadOk = 0;
    }

    // check file type
    if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
        echo "Only JPG, JPEG & PNG are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        // delete old image if exists
        if (!empty($old_image) && file_exists($target_dir . $old_image)) {
            unlink($target_dir . $old_image);
        }

        // upload new image
        if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) {
            echo "Your image has been uploaded.";

            // update database
            $update = "UPDATE menu SET image = ? WHERE m_id = ?";
            $stmt = $pdo->prepare($update);
            $stmt->execute([$uniqueName, $m_id]);
        } else {
            echo "Error uploading image.";
        }
    }
}
