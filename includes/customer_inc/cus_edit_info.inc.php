<?php
session_start();
include "../dbconnect.php";

if (!isset($_SESSION['c_id'])) {
    header("Location: ../../../index.php");
    exit();
}

$c_id = $_SESSION['c_id'];

// ✅ LOGOUT
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../../index.php");
    exit();
}

// ✅ UPLOAD PROFILE IMAGE
if (isset($_POST['upload'])) {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if (!empty($image_name)) {
        $target_dir = "../../../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $new_name = uniqid() . "_" . basename($image_name);
        $target_file = $target_dir . $new_name;

        if (move_uploaded_file($image_tmp, $target_file)) {
            $sql = "UPDATE customer SET image = '$new_name' WHERE c_id = '$c_id'";
            mysqli_query($conn, $sql);
        }
    }

    header("Location: ../../pages/edit_account.php");
    exit();
}

// ✅ UPDATE ACCOUNT INFO
if (isset($_POST['save'])) {
    $email = $_POST['c_email'];
    $bday = $_POST['c_bday'];
    $addr = $_POST['c_addr'];
    $sex = $_POST['c_sex'];
    $occup = $_POST['c_occup'];
    $password = $_POST['c_pass'];

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE customer 
                SET c_email='$email', c_bday='$bday', c_addr='$addr', 
                    c_sex='$sex', c_occup='$occup', c_pass='$hashed' 
                WHERE c_id='$c_id'";
    } else {
        $sql = "UPDATE customer 
                SET c_email='$email', c_bday='$bday', c_addr='$addr', 
                    c_sex='$sex', c_occup='$occup'
                WHERE c_id='$c_id'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../modules/users/customer/cus_info/cus_edt_info.php?updated=1");
        exit();
    } else {
        echo "Error updating account: " . mysqli_error($conn);
    }
}
