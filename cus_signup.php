<?php
session_start();

// ✅ Generate CSRF token once per session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
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

        <?php if (isset($_SESSION['errorMessage'])): ?>
            <p style="color:red;"><?php echo $_SESSION['errorMessage'];
                                    unset($_SESSION['errorMessage']); ?></p>
        <?php endif; ?>

        <form method="POST" action="includes/cus_signup.inc.php" novalidate>
            <!-- ✅ CSRF TOKEN -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

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

            <div class="button-group">
                <button type="submit">Sign Up</button>
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>