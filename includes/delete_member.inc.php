<?php
include "../dbconnect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM customer WHERE c_id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // ✅ Redirect pabalik sa member list
        header("Location: ../modules/users/admin/member_list.php?deleted=success");
        exit;
    } else {
        header("Location: ../modules/users/admin/member_list.php?deleted=error");
        exit;
    }
} else {
    header("Location: ../modules/users/admin/member_list.php?deleted=invalid");
    exit;
}
