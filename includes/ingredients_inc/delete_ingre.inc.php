<?php
require '../includes/dbconnect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM ingredients WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit;
