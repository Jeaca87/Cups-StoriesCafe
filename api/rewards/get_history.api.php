<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../includes/web_inc/cus_rewardpage.inc.php';
session_start();

if (!isset($_SESSION['c_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$c_id = (int)$_SESSION['c_id'];
$cust = getCustomerRewards($pdo, $c_id);
if (!$cust) {
    echo json_encode([]);
    exit;
}

$cusr_id = (int)$cust['cusr_id'];
echo json_encode(getRewardHistory($pdo, $cusr_id));
