<?php
session_start();
require_once 'dbconnect.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // ... existing code ...

    try {
        // 1. Try to find user in pos_users (admin or cashier)
        $stmt = $pdo->prepare("SELECT * FROM pos_users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $staff = $stmt->fetch(PDO::FETCH_ASSOC);

        // DEBUG: Add this temporarily
        error_log("Email: $email");
        error_log("Staff found: " . ($staff ? 'Yes' : 'No'));
        if ($staff) {
            error_log("Stored hash: " . $staff['password']);
            error_log("Password verify: " . (password_verify($password, $staff['password']) ? 'True' : 'False'));
        }

        if ($staff && password_verify($password, $staff['password'])) {
            // ... rest of the code ...
        }

        // ... rest of the code ...
    } catch (PDOException $e) {
        // ... existing catch ...
    }

    // ✅ Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../index.php");
        exit;
    }

    // Optional: Validate email format for better security
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address.";
        header("Location: ../index.php");
        exit;
    }

    try {
        // 1. Try to find user in pos_users (admin or cashier)
        $stmt = $pdo->prepare("SELECT * FROM pos_users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $staff = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($staff && password_verify($password, $staff['password'])) {
            $_SESSION['id'] = $staff['id'];
            $_SESSION['fname'] = $staff['firstname'];
            $_SESSION['lname'] = $staff['lastname'];
            $_SESSION['role'] = $staff['role'];

            // 🔀 Redirect based on role
            if ($staff['role'] === 'admin') {
                header("Location: ../../modules/users/admin/dashboard.php");
            } else {
                header("Location: ../../modules/users/cashier/cashier_dashboard.php");
            }
            exit;
        }

        // 2. If not found, check in customers table
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE c_email = ? LIMIT 1");
        $stmt->execute([$email]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer && password_verify($password, $customer['password'])) {
            $_SESSION['c_id'] = $customer['id'];
            $_SESSION['c_fname'] = $customer['firstname'];
            $_SESSION['c_lname'] = $customer['lastname'];

            header("Location: ../../modules/users/customer/cus_homepage.php");
            exit;
        }

        // Invalid login
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: ../index.php");
        exit;
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: ../index.php");
        exit;
    }
} else {
    header("Location: ../index.php");
    exit;
}
