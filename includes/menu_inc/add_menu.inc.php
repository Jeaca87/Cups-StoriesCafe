<?php
require '../dbconnect.php';
// kapag nag-submit yung form
if (isset($_POST['submit'])) {
    $category   = trim($_POST['category']);
    $product    = trim($_POST['product']);
    $price      = trim($_POST['price']);
    $temperature = trim($_POST['temperature']);

    // validation (basic)
    if (!empty($category) && !empty($product) && !empty($price)) {
        try {
            $sql = "INSERT INTO menu (category, product_name, price, temperature, created_at) 
                    VALUES (:category, :product, :price, :temperature, NOW())";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':product', $product);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':temperature', $temperature);

            $stmt->execute();

            echo "<p style='color:green;'>Menu item saved successfully!</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Please fill in all required fields.</p>";
    }
}
