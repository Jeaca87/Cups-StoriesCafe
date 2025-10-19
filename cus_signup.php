<?php
session_start();
require_once 'includes/dbconnect.php';

// ✅ Generate CSRF token before rendering the form
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// ✅ Optional: handle error/success messages passed via session
$errors = $_SESSION['form_errors'] ?? [];
$success = $_SESSION['form_success'] ?? false;

// Clear session messages para hindi mag-persist
unset($_SESSION['form_errors'], $_SESSION['form_success']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/reg.css">
    <title>Cups & Stories Cafe - Sign Up</title>
</head>

<body>
    <div class="container">
        <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
        <h1>Sign Up</h1>

        <!-- ✅ Show success/error feedback -->
        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif ($success):
            header("Location: index.php");
        ?>
        <?php endif; ?>

        <form method="POST" action="includes/cus_signup.inc.php" novalidate>
            <div>
                <label for="c_fname">First name:</label>
                <input type="text" id="c_fname" name="c_fname" placeholder="Enter your first name" required>
            </div>
            <div>
                <label for="c_lname">Last name:</label>
                <input type="text" id="c_lname" name="c_lname" placeholder="Enter your last name" required>
            </div>
            <div>
                <label for="c_email">Email:</label>
                <input type="email" id="c_email" name="c_email" placeholder="Enter your email" required>
            </div>
            <div>
                <label for="c_pass">Password:</label>
                <input type="password" id="c_pass" name="c_pass" placeholder="Enter your password" required minlength="8">
            </div>
            <div>
                <label for="c_pass2">Confirm Password:</label>
                <input type="password" id="c_pass2" name="c_pass2" placeholder="Confirm your password" required minlength="8">
            </div>

            <!-- ✅ CSRF token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') ?>">

            <div class="button-group">
                <button type="submit">Sign Up</button>
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>