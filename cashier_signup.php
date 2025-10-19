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
    <link rel="stylesheet" href="/assets/css/reg.css">
    <title>Cups & Stories Cafe Sign Up</title>
</head>

<body>
    <div class="container">
        <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
        <h1>Sign Up</h1>
        <h3>Cashier</h3>
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

        <form method="POST" action="includes/cashier_signup.inc.php">
            <!-- CSRF Token Field -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

            <div>
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
            </div>

            <div>
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname" placeholder="Enter your last name" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div>
                <label for="pword">Password:</label>
                <input type="password" id="pword" name="pword" placeholder="Enter your password" required>
            </div>

            <div>
                <label for="pword2">Confirm Password:</label>
                <input type="password" id="pword2" name="pword2" placeholder="Confirm your password" required>
            </div>

            <div>
                <label for="cashier_code">Cashier Code:</label>
                <input type="text" id="cashier_code" name="cashier_code" placeholder="Enter Cashier Code" required>
            </div>

            <div class="button-group">
                <button type="submit">Sign Up</button>
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>