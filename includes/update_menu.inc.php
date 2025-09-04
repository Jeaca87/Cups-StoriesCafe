<?php
include '../includes/dbconnect.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid ID");

if (isset($_POST['update'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $size = $_POST['size'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $sql = "UPDATE menu SET item_name=:item_name, price=:price, size=:size, image=:image WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':item_name' => $item_name,
            ':price' => $price,
            ':size' => $size,
            ':image' => $image,
            ':id' => $id
        ]);
    } else {
        $sql = "UPDATE menu SET item_name=:item_name, price=:price, size=:size WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':item_name' => $item_name,
            ':price' => $price,
            ':size' => $size,
            ':id' => $id
        ]);
    }

    echo "Menu item updated!";
}

$stmt = $pdo->prepare("SELECT * FROM menu WHERE id=:id");
$stmt->execute([':id' => $id]);
$menu = $stmt->fetch(PDO::FETCH_ASSOC);
