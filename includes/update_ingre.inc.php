<?php
require '../includes/dbconnect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM ingredients WHERE id = :id");
$stmt->execute([':id' => $id]);
$ingredient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ingredient) {
    die("Ingredient not found!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $quantity = (int) $_POST['quantity'];

    $sql = "UPDATE ingredients SET name = :name, category = :category, quantity = :quantity WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $name, ':category' => $category, ':quantity' => $quantity, ':id' => $id]);

    echo "✅ Updated successfully!";
    echo "<br><a href='index.php'>Back to list</a>";
}
