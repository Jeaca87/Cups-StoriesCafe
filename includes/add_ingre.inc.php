<?php
require '../includes/dbconnect.php';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['name']);
        $category = trim($_POST['category']);
        $quantity = (int) $_POST['quantity'];

        $sql = "INSERT INTO ingredients (name, category, quantity) VALUES (:name, :category, :quantity)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':quantity', $quantity);

        if ($stmt->execute()) {
            echo "Ingredient added successfully!";
        } else {
            echo "Failed to add ingredient.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
