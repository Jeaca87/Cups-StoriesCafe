<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'cashier') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <h2>Welcome, Admin!</h2>
    <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    <a href="logout.php">Logout</a>
</body>

</html>