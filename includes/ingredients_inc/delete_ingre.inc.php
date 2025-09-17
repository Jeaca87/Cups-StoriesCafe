<?php
require '../dbconnect.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM ingredients WHERE i_id = :id");
    $stmt->execute(['id' => $id]);

    if ($stmt->rowCount()) {
        // success, balik sa list page
        header("Location: ../../modules/pos/ingredients/ingredients.php?deleted=1");
        exit;
    } else {
        // walang nadelete
        header("Location: ../../modules/pos/ingredients/ingredients.php?deleted=0");
        exit;
    }
} else {
    // walang ID na binigay
    header("Location: ../../modules/pos/ingredients/ingredients.php?deleted=0");
    exit;
}
