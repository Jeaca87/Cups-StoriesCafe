<?php
include "../dbconnect.php"; // adjust the path if needed

// Fetch latest menu item
$menuStmt = $pdo->prepare("SELECT * FROM menu ORDER BY date_created DESC LIMIT 1");
$menuStmt->execute();
$menu = $menuStmt->fetch(PDO::FETCH_ASSOC);

// Fetch active rewards
$rewardStmt = $pdo->prepare("SELECT * FROM rewards ORDER BY r_start_date DESC LIMIT 3");
$rewardStmt->execute();
$rewards = $rewardStmt->fetchAll(PDO::FETCH_ASSOC);
