<?php
include "../../includes/dbconnect.php";

// Fetch featured menu item (example: latest or random)
$menuStmt = $pdo->prepare("SELECT * FROM menu ORDER BY date_created DESC LIMIT 1");
$menuStmt->execute();
$menu = $menuStmt->fetch(PDO::FETCH_ASSOC);

// Fetch rewards (example: top 3 active rewards)
$rewardStmt = $pdo->prepare("SELECT * FROM rewards WHERE r_expired_date >= CURDATE() ORDER BY r_start_date DESC LIMIT 3");
$rewardStmt->execute();
$rewards = $rewardStmt->fetchAll(PDO::FETCH_ASSOC);
