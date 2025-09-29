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

        <form method="POST" action="../../../includes/cashier_signup.inc.php">
            <!-- CSRF Token Field -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">

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
                <label for="pword1">Password:</label>
                <input type="password" id="pword1" name="pword1" placeholder="Enter your password" required>
            </div>
            <div>
                <label for="pword2">Confirm Password:</label>
                <input type="password" id="pword2" name="pword2" placeholder="Confirm your password" required>
            </div>
            <div>
                <label for="staff_code">Cashier Code:</label>
                <input type="text" id="cashier_code" name="cashier_code" placeholder="Enter Cashier Code" required>
            </div>

            <div class="button-group">
                <button type="submit">Sign Up</button>
                <a href="index.php"><button type="button">Cancel</button></a>
            </div>

        </form>
    </div>
</body>

</html>