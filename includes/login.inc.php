<?php
session_start();
require_once 'dbconnect.php'; // make sure $pdo is defined here

// ✅ Ensure POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

// ✅ CSRF validation
if (
    !isset($_POST['csrf_token']) ||
    !isset($_SESSION['csrf_token']) ||
    $_POST['csrf_token'] !== $_SESSION['csrf_token']
) {
    $_SESSION['errorMessage'] = "Invalid CSRF token.";
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header("Location: ../index.php");
    exit;
}

// ✅ Clean inputs
$email = trim(strtolower($_POST['email']));
$password = trim($_POST['password']);
unset($_SESSION['csrf_token']); // one-time use

try {
    // ✅ Check unified users table
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['errorMessage'] = "Invalid email or password.";
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header("Location: ../index.php");
        exit;
    }

    // ✅ Verify password
    if (!password_verify($password, $user['password'])) {
        $_SESSION['errorMessage'] = "Invalid email or password.";
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header("Location: ../index.php");
        exit;
    }

    // ✅ Fetch full details from corresponding table
    $details = null;
    if ($user['user_type'] === 'pos') {
        $stmt = $pdo->prepare("SELECT * FROM pos_users WHERE pos_id = ?");
        $stmt->execute([$user['u_id']]);
        $details = $stmt->fetch(PDO::FETCH_ASSOC);
    } elseif ($user['user_type'] === 'customer') {
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE c_id = ?");
        $stmt->execute([$user['u_id']]);
        $details = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$details) {
        $_SESSION['errorMessage'] = "User record missing.";
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header("Location: ../index.php");
        exit;
    }

    // ✅ Success — setup session
    session_regenerate_id(true);
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['u_id'] = $user['u_id'];
    $_SESSION['user_type'] = $user['user_type'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $details['pos_fname'] ?? $details['c_fname'] ?? 'User';

    // ✅ Redirect by role
    switch ($user['role']) {
        case 'admin':
            header("Location: ../modules/admin_module/dashboard.php");
            break;
        case 'cashier':
            header("Location: ../modules/cashier_module/cashier_dashboard.php");
            break;
        case 'customer':
            header("Location: ../modules/customer_module/cus_homepage.php");
            break;
        default:
            $_SESSION['errorMessage'] = "Unknown user role.";
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            header("Location: ../index.php");
            break;
    }
    exit;
} catch (PDOException $e) {
    $_SESSION['errorMessage'] = "Database error: " . $e->getMessage();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header("Location: ../index.php");
    exit;
}
