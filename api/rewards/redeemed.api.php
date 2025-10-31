<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once __DIR__ . '/../../includes/web_inc/cus_rewardpage.inc.php';
session_start();

if (!isset($_SESSION['c_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'You must be logged in.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$reward_id = isset($data['reward_id']) ? (int)$data['reward_id'] : 0;
$c_id = (int)$_SESSION['c_id'];

if ($reward_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid reward ID']);
    exit;
}

echo json_encode(redeemReward($pdo, $c_id, $reward_id));
