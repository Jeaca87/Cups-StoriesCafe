<?php
session_start();

// Database configuration (Separate file for security)
require_once 'dbconnect.php'; // Contains $db_host, $db_name, $db_user, $db_pass

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input (basic)
    if (empty($email) || empty($password)) {
        header("Location: ../index.php?error=Empty fields");
        exit();
    }

    try {
        // Check pos_users table (Admin/Cashier)
        $stmt = $pdo->prepare("SELECT pos_id AS id, pos_email AS email, pos_pword AS password, pos_role AS role FROM pos_users WHERE pos_email = ?");
        $stmt->execute([$email]);
        $pos_user = $stmt->fetch();

        if ($pos_user && password_verify($password, $pos_user['password'])) {
            // POS User login successful
            $_SESSION['user_id'] = $pos_user['id'];
            $_SESSION['user_email'] = $pos_user['email'];
            $_SESSION['user_type'] = $pos_user['role']; // 'admin' or 'cashier'

            if ($_SESSION['user_type'] == 'admin') {
                header("Location: ../modules/users/admin/dashboard.php");
            } else {
                header("Location: ../modules/users/cashier/cashier_dashboard.php");
            }
            exit();
        }

        // Check customer table
        $stmt = $pdo->prepare("SELECT c_id AS id, c_email AS email, c_pass AS password FROM customer WHERE c_email = ?");
        $stmt->execute([$email]);
        $customer = $stmt->fetch();

        if ($customer && password_verify($password, $customer['password'])) {
            // Customer login successful
            $_SESSION['user_id'] = $customer['id'];
            $_SESSION['user_email'] = $customer['email'];
            $_SESSION['user_type'] = 'customer';

            header("Location: ../modules/users/customer/cus_homepage.php");
            exit();
        }

        // Invalid credentials
        header("Location: ../index.php?error=Invalid credentials");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}
