<?php
include "../../../includes/dbconnect.php"; // Ensure this file sets up a PDO connection

// Initialize an empty array to hold menu items and rewards
$menuItems = [];
$rewards = [];

// Fetch menu items from the database
try {
    $stmt = $pdo->prepare("SELECT name, image FROM menu_items"); // Assuming a table named 'menu_items'
    $stmt->execute();
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching menu items: " . $e->getMessage();
}

// Fetch rewards from the database
try {
    $stmt = $pdo->prepare("SELECT title, description FROM rewards"); // Assuming a table named 'rewards'
    $stmt->execute();
    $rewards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching rewards: " . $e->getMessage();
}
