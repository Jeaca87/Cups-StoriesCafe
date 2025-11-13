<?php
session_start();
require_once __DIR__ . "/dbconnect.php";

function redirect_with_message($url, $message)
{
    $_SESSION['flash_message'] = $message;
    header("Location: $url");
    exit;
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    redirect_with_message('../index.php', 'You must be logged in to change your password.');
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
$user_role = $_SESSION['user_role'] ?? '';

if (isset($_POST['submit'])) {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        redirect_with_message($_SERVER['HTTP_REFERER'], 'Please fill out all fields.');
    }

    if ($new_password !== $confirm_password) {
        redirect_with_message($_SERVER['HTTP_REFERER'], 'New passwords do not match.');
    }

    if ($user_type === 'pos_users') {
        $table = 'pos_users';
        $id_col = 'pos_id';
        $pass_col = 'pos_pword';
    } elseif ($user_type === 'customer') {
        $table = 'customer';
        $id_col = 'c_id';
        $pass_col = 'c_pass';
    } else {
        redirect_with_message($_SERVER['HTTP_REFERER'], 'Invalid user type.');
    }

    $stmt = $pdo->prepare("SELECT $pass_col FROM $table WHERE $id_col = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        redirect_with_message($_SERVER['HTTP_REFERER'], 'User not found.');
    }

    if (!password_verify($current_password, $user[$pass_col])) {
        redirect_with_message($_SERVER['HTTP_REFERER'], 'Current password is incorrect.');
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update = $pdo->prepare("UPDATE $table SET $pass_col = ? WHERE $id_col = ?");
    $update->execute([$hashed_password, $user_id]);

    // Redirect to correct account page
    if ($user_type === 'pos_users') {
        $redirect_url = ($user_role === 'admin')
            ? '../modules/users/admin/account.php'
            : '../modules/users/cashier/account.php';
    } else {
        $redirect_url = '../modules/users/customer/cus_edit_info.php';
    }

    redirect_with_message($redirect_url, 'Password updated successfully.');
} else {
    redirect_with_message($_SERVER['HTTP_REFERER'], 'Invalid request.');
}
