<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '../../includes/reward_func.inc.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $reward = getRewardById($pdo, (int) $_GET['id']);
            echo json_encode($reward ?: ['error' => 'Not found']);
        } else {
            echo json_encode(getAllRewards($pdo));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) $data = $_POST; // fallback for form POST
        $success = addReward($pdo, $data);
        echo json_encode(['success' => $success]);
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        if (isset($_GET['id'])) {
            $success = updateReward($pdo, (int)$_GET['id'], $data);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['error' => 'Missing ID']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $success = deleteReward($pdo, (int)$_GET['id']);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['error' => 'Missing ID']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
