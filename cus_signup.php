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

        <form method="POST" action="../../../includes/cus_signup.inc.php">
            <div>
                <label>First name:</label>
                <input type="text" name="c_fname" placeholder="Enter your first name" required>
            </div>
            <div>
                <label>Last name:</label>
                <input type="text" name="c_lname" placeholder="Enter your last name" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="c_email" placeholder="Enter your email" required>
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="c_pass" placeholder="Enter your password" required>
            </div>
            <div>
                <label>Confirm Password:</label>
                <input type="password" name="c_pass2" placeholder="Confirm your password" required>
            </div>

            <div class="button-group">
                <button type="submit">Sign Up</button>
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </div>

            <!-- Add CSRF token to your form -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        </form>
    </div>
</body>

</html>