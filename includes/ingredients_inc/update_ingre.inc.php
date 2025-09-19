<?php
require __DIR__ . '/../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = (int) $_POST['i_id'];
    $name = trim($_POST['i_name']);
    $category = trim($_POST['i_unit']);
    $qty = (int) $_POST['i_qty'];

    // Bawal negative
    if ($qty < 0) {
        $qty = 0;
    }

    $sql = "UPDATE ingredients 
            SET i_name = :name, 
                i_unit = :category, 
                i_qty = :qty, 
                date_updated = NOW()
            WHERE i_id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../../modules/pos/ingredients/ingredients.php?updated=1");
        exit();
    } else {
        header("Location: ../../modules/pos/ingredients/ingredients.php?error=1");
        exit();
    }
}
