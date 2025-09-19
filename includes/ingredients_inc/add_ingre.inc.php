<?php
include __DIR__ . '/../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['i_name']);
    $category = trim($_POST['i_unit']);
    $qty = (int) $_POST['i_qty'];

    // Prevent negative values
    if ($qty < 0) {
        $qty = 0;
    }

    $sql = "INSERT INTO ingredients (i_name, i_unit, i_qty, date_created) 
            VALUES (:name, :category, :qty, NOW())";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $lastId = $pdo->lastInsertId();
        header("Location: ../../modules/pos/ingredients/ingredients.php?success=1&id=$lastId");
        exit();
    } else {
        header("Location: ../../modules/pos/ingredients/ingredients.php?error=1");
        exit();
    }
}
