<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/login.css">
    <title>Cups & Stories Cafe - Login</title>

</head>

<body>
    <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
    <h2>Login</h2>

    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    ?>
    <form method="POST" action="/includes/login.inc.php">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <a href="cus_signup.php"><button type="button">Sign Up</button></a>
    <p>Or are you the cashier? <a href="staff_signup.php">Sign up here</a>
</body>

</html>