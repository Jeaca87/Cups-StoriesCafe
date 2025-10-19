<?php
session_start();
require_once 'dbconnect.php';

// ✅ Check if logged in as admin
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit('Forbidden: Admin access required.');
}

// ✅ Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// ✅ Validate CSRF token
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(400);
    exit('Invalid CSRF token.');
}

// ✅ Validate role input (prevent arbitrary injection)
$allowedRoles = ['cashier']; // extend later if needed
$role = $_POST['role'] ?? 'cashier';
if (!in_array($role, $allowedRoles, true)) {
    http_response_code(400);
    exit('Invalid role specified.');
}

try {
    // ✅ Generate secure 16-char alphanumeric code
    $plainCode = bin2hex(random_bytes(8));

    // ✅ Hash the code before saving
    $codeHash = password_hash($plainCode, PASSWORD_DEFAULT);

    // ✅ Expire after 7 days
    $expiresAt = date('Y-m-d H:i:s', strtotime('+7 days'));

    // ✅ Insert using prepared statement
    $stmt = $pdo->prepare("
        INSERT INTO cashier_codes (code_hash, role, expires_at)
        VALUES (:code_hash, :role, :expires_at)
    ");
    $stmt->execute([
        ':code_hash' => $codeHash,
        ':role'      => $role,
        ':expires_at' => $expiresAt
    ]);

    // ✅ Save generated code to session for display
    $_SESSION['gen_success'] = $plainCode;

    // ✅ Optional: regenerate CSRF token after successful use
    unset($_SESSION['csrf_token']);

    // ✅ Redirect safely back to the page
    header('Location: cashier_codes.php');
    exit;
} catch (Exception $e) {
    // ✅ Catch all errors to avoid revealing sensitive info
    error_log('Code generation error: ' . $e->getMessage());
    http_response_code(500);
    exit('An error occurred while generating the staff code.');
}
