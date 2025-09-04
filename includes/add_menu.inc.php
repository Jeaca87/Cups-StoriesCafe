<?php
require '../includes/dbconnect.php';

if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $image = $_FILES['image']['name'];

    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO menu (item_name, price, size, image) VALUES (:item_name, :price, :size, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item_name' => $item_name,
        ':price' => $price,
        ':size' => $size,
        ':image' => $image
    ]);

    echo "New menu item added!";
}
