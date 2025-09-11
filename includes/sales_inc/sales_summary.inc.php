<?php
require '../dbconnect.php';

$filter = $_GET['filter'] ?? 'today'; // default today

switch ($filter) {
    case 'yesterday':
        $condition = "DATE(sale_date) = CURDATE() - INTERVAL 1 DAY";
        break;
    case 'lastweek':
        $condition = "sale_date >= CURDATE() - INTERVAL 7 DAY";
        break;
    case 'lastmonth':
        $condition = "sale_date >= CURDATE() - INTERVAL 1 MONTH";
        break;
    default:
        $condition = "DATE(sale_date) = CURDATE()";
}

$sql = "SELECT DATE(sale_date) as date, SUM(total) as sales
        FROM sales 
        WHERE $condition 
        GROUP BY DATE(sale_date)";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
