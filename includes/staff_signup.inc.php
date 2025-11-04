<?php
session_start();
require_once '../includes/dbconnect.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // (Optional) CSRF check — safe to remove if local use only
    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token'])) {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $errors[] = "Invalid CSRF token.";
        }
    }

    $role = $_POST['role'] ?? 'cashier';
    $pword = $_POST['pword'] ?? '';
    $pword2 = $_POST['pword2'] ?? '';

    if ($role === 'admin') {
        // 🔹 ADMIN SIGNUP or PASSWORD UPDATE
        $admin_email = "admin@gmail.com";

        if (empty($pword) || empty($pword2)) {
            $errors[] = "Please fill in both password fields.";
        } elseif ($pword !== $pword2) {
            $errors[] = "Passwords do not match.";
        } else {
            $hashed = password_hash($pword, PASSWORD_DEFAULT);

            // Check if admin exists
            $stmt = $pdo->prepare("SELECT pos_id FROM pos_users WHERE pos_email = ? AND pos_role = 'admin'");
            $stmt->execute([$admin_email]);

            if ($stmt->fetch()) {
                // Update password
                $stmt = $pdo->prepare("UPDATE pos_users SET pos_pword = ? WHERE pos_email = ? AND pos_role = 'admin'");
                $stmt->execute([$hashed, $admin_email]);
            } else {
                // Create new admin account
                $stmt = $pdo->prepare("INSERT INTO pos_users (pos_fname, pos_lname, pos_email, pos_pword, pos_role) VALUES ('Admin', '', ?, ?, 'admin')");
                $stmt->execute([$admin_email, $hashed]);
            }

            $success = true;
            header("Location: ../index.php?admin=updated");
            exit;
        }
    } else {
        // 🔹 CASHIER SIGNUP
        $fname = trim($_POST['fname'] ?? '');
        $lname = trim($_POST['lname'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (empty($fname) || empty($lname) || empty($email) || empty($pword) || empty($pword2)) {
            $errors[] = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        } elseif ($pword !== $pword2) {
            $errors[] = "Passwords do not match.";
        } elseif (strlen($pword) < 8) {
            $error[] = "Password must be at least 8 characters.";
            exit();
        } else {
            // Check if email exists
            $stmt = $pdo->prepare("SELECT pos_email FROM pos_users WHERE pos_email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = "Email already exists.";
            } else {
                // Insert new cashier
                $hashed = password_hash($pword, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO pos_users (pos_fname, pos_lname, pos_email, pos_pword, pos_role) VALUES (?, ?, ?, ?, 'cashier')");
                if ($stmt->execute([$fname, $lname, $email, $hashed])) {
                    $success = true;
                    header("Location: ../index.php?signup=success");
                    exit;
                } else {
                    $errors[] = "Database error. Try again later.";
                }
            }
        }
    }
}

$_SESSION['errors'] = $errors;
$_SESSION['success'] = $success;
