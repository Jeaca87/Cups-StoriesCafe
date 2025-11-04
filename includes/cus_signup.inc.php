<?php
session_start();
require_once '../includes/dbconnect.php'; // make sure you have your DB connection file here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ✅ CSRF token verification
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errorMessage'] = "Invalid CSRF token.";
        header("Location: ../cus_signup.php");
        exit();
    }

    // ✅ Collect and sanitize inputs
    $fname = trim($_POST['c_fname']);
    $lname = trim($_POST['c_lname']);
    $email = trim($_POST['c_email']);
    $pass = $_POST['c_pass'];
    $pass2 = $_POST['c_pass2'];

    // ✅ Validate inputs
    if (empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($pass2)) {
        $_SESSION['errorMessage'] = "All fields are required.";
        header("Location: ../cus_signup.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorMessage'] = "Invalid email format.";
        header("Location: ../cus_signup.php");
        exit();
    }

    if ($pass !== $pass2) {
        $_SESSION['errorMessage'] = "Passwords do not match.";
        header("Location: ../cus_signup.php");
        exit();
    }

    if (strlen($pass) < 8) {
        $_SESSION['errorMessage'] = "Password must be at least 8 characters.";
        header("Location: ../cus_signup.php");
        exit();
    }

    // ✅ Hash password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    try {
        // ✅ Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE c_email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['errorMessage'] = "Email already exists.";
            header("Location: ../cus_signup.php");
            exit();
        }

        // ✅ Insert new customer
        $stmt = $pdo->prepare("INSERT INTO customer (c_fname, c_lname, c_email, c_pass) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $email, $hashed_pass]);

        // ✅ Success message or redirect to login
        $_SESSION['successMessage'] = "Account created successfully! You can now log in.";
        unset($_SESSION['csrf_token']); // optional: regenerate CSRF token
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "Database error: " . $e->getMessage();
        header("Location: ../cus_signup.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Invalid request method.";
    header("Location: ../cus_signup.php");
    exit();
}
