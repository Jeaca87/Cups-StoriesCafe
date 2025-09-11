<?php
require '../dbconnect.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["error" => $e->getMessage()]));
}

$sql = "SELECT m.category, SUM(s.quantity) as total_sold
        FROM sales s
        JOIN menu_items m ON s.item_id = m.id
        GROUP BY m.category
        ORDER BY total_sold DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
