<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../includes/web_inc/cus_rewardpage.inc.php';

try {
    $rewards = getActiveRewards($pdo);
    echo json_encode($rewards);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
