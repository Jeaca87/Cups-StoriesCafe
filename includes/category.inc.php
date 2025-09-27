<?php
session_start();
include '../../../includes/dbconnect.php';

// Kunin lahat ng unique items (base lang, grouped by m_name)
$stmt = $pdo->query("
    SELECT m_name, m_category, MIN(image) as image
    FROM menu
    GROUP BY m_name, m_category
    ORDER BY m_name
");
$uniqueMenus = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get category filter from URL
$selectedCat = $_GET['category'] ?? null;
