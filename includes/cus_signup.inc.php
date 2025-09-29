<?php
session_start();
include '../includes/dbconnect.php';

// Check if database connection exists
if (!isset($pdo)) {
    die("Database connection failed");
}

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF Protection (add token to your form)
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        $errors[] = "Invalid request";
    }
    // Add after line 14 for debugging
    //echo "Session token: " . ($_SESSION['csrf_token'] ?? 'NOT SET') . "<br>";
    //echo "POST token: " . ($_POST['csrf_token'] ?? 'NOT SET') . "<br>";

    // Input validation
    $fname = trim($_POST['c_fname'] ?? '');
    $lname = trim($_POST['c_lname'] ?? '');
    $email = trim($_POST['c_email'] ?? '');
    $pword = $_POST['c_pass'] ?? '';
    $confirm_pword = $_POST['c_pass2'] ?? '';

    // Validate required fields
    if (empty($fname)) $errors[] = "First name is required";
    if (empty($lname)) $errors[] = "Last name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($pword)) $errors[] = "Password is required";

    // Validate email format
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password strength
    if (!empty($pword) && strlen($pword) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    // Check password confirmation
    if ($pword !== $confirm_pword) {
        $errors[] = "Passwords do not match";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO customer (c_fname, c_lname, c_email, c_pass) VALUES (?, ?, ?, ?)");
            $stmt->execute([$fname, $lname, $email, $hashed_pword]);
            $success = true;

            // Redirect to login page or dashboard
            header("Location: index.php?registered=1");
            exit();
        } catch (PDOException $e) {
            // Check for duplicate email (MySQL error code)
            if ($e->getCode() == 23000) {
                $errors[] = "Email already registered";
            } else {
                error_log("Registration error: " . $e->getMessage());
                $errors[] = "Registration failed. Please try again.";
            }
        }
    }
}

// Generate CSRF token for the form
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!-- Display errors -->
<?php if (!empty($errors)): ?>
    <div class="error-messages">
        <?php foreach ($errors as $error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>