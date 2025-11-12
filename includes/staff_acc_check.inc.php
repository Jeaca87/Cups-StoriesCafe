<?php
include __DIR__ . "/dbconnect.php";
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM pos_users WHERE pos_email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['pos_pword'])) {
        // Set session data
        $_SESSION['pos_id'] = $user['pos_id'];
        $_SESSION['pos_role'] = $user['pos_role'];
        $_SESSION['pos_fname'] = $user['pos_fname'];
        $_SESSION['pos_lname'] = $user['pos_lname'];

        // Redirect depende sa role
        if ($user['pos_role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: cashier_dashboard.php");
        }
        exit;
    } else {
        echo "Invalid email or password.";
    }
}
