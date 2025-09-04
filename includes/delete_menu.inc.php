<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid ID");

$stmt = $pdo->prepare("DELETE FROM menu WHERE id=:id");
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit;
