<?php
session_start();
$errorMessage = '';
if (isset($_SESSION['error'])) {
    $errorMessage = "<p style='color:red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
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

        <?php echo $errorMessage; ?>

        <form method="POST" action="./includes/login.inc.php">
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>

        <a href="cus_signup.php"><button type="button">Sign Up</button></a>

        <div class="link">
            <p>Or are you the cashier? <a href="cashier_signup.php">Sign up here</a></p>
        </div>
    </div>
</body>

</html>