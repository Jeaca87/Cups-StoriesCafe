<?php
session_start();
require_once 'dbconnect.php';

$errors = [];

// ✅ CSRF check
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $errors[] = "Invalid CSRF token.";
}

// ✅ Basic validation
$fname = trim($_POST['fname'] ?? '');
$lname = trim($_POST['lname'] ?? '');
$email = trim($_POST['email'] ?? '');
$pword = $_POST['pword'] ?? '';
$pword2 = $_POST['pword2'] ?? '';
$cashier_code = trim($_POST['cashier_code'] ?? '');

if ($pword !== $pword2) {
    $errors[] = "Passwords do not match.";
}

if (empty($cashier_code)) {
    $errors[] = "Cashier code is required.";
}

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    header("Location: ../cashier_signup.php");
    exit();
}

// ✅ Check code validity
$stmt = $conn->prepare("SELECT * FROM cashier_codes WHERE code = ? AND used_at IS NULL AND (expires_at IS NULL OR expires_at >= NOW()) LIMIT 1");
$stmt->bind_param("s", $cashier_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['form_errors'] = ["Invalid or expired cashier code."];
    header("Location: ../cashier_signup.php");
    exit();
}

$invite = $result->fetch_assoc();

// ✅ Insert cashier user
$hashedPassword = password_hash($pword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO pos_users (fname, lname, email, pass, role) VALUES (?, ?, ?, ?, 'cashier')");
$stmt->bind_param("ssss", $fname, $lname, $email, $hashedPassword);
if (!$stmt->execute()) {
    $_SESSION['form_errors'] = ["Failed to register user."];
    header("Location: ../cashier_signup.php");
    exit();
}
$newUserId = $stmt->insert_id;

// ✅ Mark invite as used
$stmt = $conn->prepare("UPDATE cashier_codes SET used_by = ?, used_at = NOW() WHERE id = ?");
$stmt->bind_param("ii", $newUserId, $invite['id']);
$stmt->execute();

$_SESSION['form_success'] = true;
header("Location: ../cashier_signup.php");
exit();
