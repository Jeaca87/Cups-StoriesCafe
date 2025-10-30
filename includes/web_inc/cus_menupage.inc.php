<?php
include __DIR__ . '/../dbconnect.php';

// Get selected category from the URL (if any)
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch all categories
try {
    $stmt = $pdo->query("SELECT DISTINCT m_category FROM menu ORDER BY m_category ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching categories: " . $e->getMessage());
}

// Fetch menu items (filtered by category if selected)
try {
    if (!empty($category)) {
        $stmt = $pdo->prepare("SELECT * FROM menu WHERE m_category = :category ORDER BY m_name ASC");
        $stmt->execute(['category' => $category]);
    } else {
        $stmt = $pdo->query("SELECT * FROM menu ORDER BY m_category, m_name ASC");
    }
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching menu items: " . $e->getMessage());
}

// Group same m_name together (even if same name but different price/temp/size)
$groupedMenu = [];
foreach ($menuItems as $item) {
    $name = $item['m_name'];

    if (!isset($groupedMenu[$name])) {
        $groupedMenu[$name] = [
            'm_name' => $name,
            'm_category' => $item['m_category'],
            'image' => $item['image'],
            'variants' => []
        ];
    }

    // Add each temperature/size/price combination as a variant
    $labelParts = [];
    if (!empty($item['m_tempe'])) $labelParts[] = ucfirst($item['m_tempe']);
    if (!empty($item['m_size'])) $labelParts[] = $item['m_size'] . ' oz';
    $label = implode(' - ', $labelParts);
    if (empty($label)) $label = 'Regular';

    $groupedMenu[$name]['variants'][] = [
        'label' => $label,
        'price' => $item['m_price'],
        'points' => $item['m_point']
    ];
}

// Re-index array
$groupedMenu = array_values($groupedMenu);
