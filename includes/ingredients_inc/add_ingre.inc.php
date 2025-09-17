<?php
include __DIR__ . '/../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['i_name']);
    $category = trim($_POST['i_unit']);
    $qty = (int) $_POST['i_qty'];

    $sql = "INSERT INTO ingredients (i_name, i_unit, i_qty) VALUES (:name, :category, :qty)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':qty', $qty);

    if ($stmt->execute()) {
        // kunin yung auto increment ID na ginawa ni database
        $lastId = $pdo->lastInsertId();
        // redirect sa view page (pwede rin sa details ng bagong ingredient)
        header("Location: ../../modules/pos/ingredients/ingredients.php?success=1&id=$lastId");
        exit();
    } else {
        header("Location: ../../modules/pos/ingredients/ingredients.php?error=1");
        exit();
    }
}
