<?php
session_start();

// ✅ Generate CSRF token once per session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ✅ Get error message (if any) and clear it
$errorMessage = '';
if (!empty($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/login.css">
    <title>Cups & Stories Cafe - Login</title>
</head>

<body>
    <div class="login-container">
        <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
        <h2>Login</h2>

        <!-- ✅ Error box shown only when there’s an error -->
        <?php if (!empty($errorMessage)): ?>
            <div class="error-box">
                <?php echo htmlspecialchars($errorMessage); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="includes/login.inc.php">
            <!-- ✅ Hidden CSRF token -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>

        <a href="cus_signup.php"><button type="button">Sign Up</button></a>

        <div class="link">
            <p>Or are you the cashier? <a href="staff_signup.php">Sign up here</a></p>
        </div>
    </div>
</body>

</html>