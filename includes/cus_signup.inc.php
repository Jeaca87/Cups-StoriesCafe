<?php
session_start();
require_once __DIR__ . '/dbconnect.php';


$errors = [];
$success = false;

// ✅ Function to validate CSRF
function validateCSRFToken(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

//sa customer signup
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1️⃣ CSRF Validation
    if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $errors[] = "Invalid request. Please refresh the page and try again.";
    } else {
        // 2️⃣ Collect & sanitize
        $fname  = htmlspecialchars(trim($_POST['c_fname'] ?? ''), ENT_QUOTES, 'UTF-8');
        $lname  = htmlspecialchars(trim($_POST['c_lname'] ?? ''), ENT_QUOTES, 'UTF-8');
        $email  = filter_var(trim($_POST['c_email'] ?? ''), FILTER_VALIDATE_EMAIL);
        $pass   = $_POST['c_pass'] ?? '';
        $pass2  = $_POST['c_pass2'] ?? '';

        // 3️⃣ Validation
        if (!$fname || !$lname) {
            $errors[] = "First name and Last name are required.";
        }
        if (!$email) {
            $errors[] = "Please enter a valid email address.";
        }
        if (strlen($pass) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        }
        if ($pass !== $pass2) {
            $errors[] = "Passwords do not match.";
        }

        // 4️⃣ Save to DB if valid
        if (empty($errors)) {
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO customer (c_fname, c_lname, c_email, c_pass) 
                                       VALUES (:fname, :lname, :email, :pass)");
                $stmt->execute([
                    ':fname' => $fname,
                    ':lname' => $lname,
                    ':email' => $email,
                    ':pass' => $hashed_pass
                ]);

                $success = true;
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) { // Duplicate email
                    $errors[] = "This email is already registered.";
                } else {
                    error_log("DB Error: " . $e->getMessage());
                    $errors[] = "Something went wrong. Please try again later.";
                }
            }
        }
    }
}

// ✅ Store messages in session for HTML display
$_SESSION['form_errors'] = $errors;
$_SESSION['form_success'] = $success;

// ✅ Redirect back to signup page
header("Location: ../cus_signup.php");
exit;
