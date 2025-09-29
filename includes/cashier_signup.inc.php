<?php
session_start(); // Start the session at the beginning

include '../includes/dbconnect.php';

// Function to generate a CSRF token
function generateCSRFToken()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Function to validate a CSRF token
function validateCSRFToken($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. CSRF Token Validation
    if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
        echo "<p>Invalid request. Please try again.</p>";
        // Optionally, log the attempt or redirect to an error page
        error_log("CSRF attack detected from IP: " . $_SERVER['REMOTE_ADDR']);
        exit; // Stop further processing if the token is invalid
    }

    $fname = trim($_POST['fname']);
    $lname  = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $pword = $_POST['pword1'];
    $confirm_pword = $_POST['pword2'];
    $cashier_code = trim($_POST['staff_code']);

    // Example secret code (pwede mo rin ilagay sa config file or database)
    $valid_code = "CAFE123";

    if ($pword !== $confirm_pword) {
        echo "<p>Passwords do not match!</p>";
    } elseif ($cashier_code !== $valid_code) {
        echo "<p>Invalid Staff Code!</p>";
    } else {
        $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO staff_users (fname, lname, email, pword, role) VALUES (?, ?, ?, ?, 'cashier')");
            $stmt->execute([$fname, $lname, $email, $hashed_pword]);
            echo "<p>Staff (Cashier) account created successfully!</p>";
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "<p>Email already registered!</p>";
            } else {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
}

// Generate CSRF token if it doesn't exist
generateCSRFToken();
