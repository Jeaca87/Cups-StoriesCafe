<?php
session_start();

// Proteksyon: dapat naka-login
if (!isset($_SESSION['pos_id']) || $_SESSION['pos_role'] !== 'cashier') {
    header("Location: /../../index.php");
    exit;
}

// Kunin ang full name
$fullname = $_SESSION['pos_fname'] . ' ' . $_SESSION['pos_lname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Staff</title>
</head>

<body>
    <div>
        <nav>
            <h3>Account</h3>
            <h3><?php echo htmlspecialchars($fullname); ?></h3>
        </nav>
    </div>
    <div>
        <form action="../../../includes//upload0.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileupload" required>
            <input type="hidden" name="source_table" value="cus_image">
            <input type="hidden" name="source_id" value="5">
            <button type="submit">Upload Image</button>
        </form>

        <form action="update_password.inc.php" method="POST">
            <!-- Hidden user ID (pwede rin galing sa session sa backend) -->
            <input type="hidden" name="pos_id" value="1">

            <div>
                <label>Password:</label>
                <input type="password" name="password" required />
                <button type="submit" name="submit">Save</button>
            </div>
        </form>

    </div>
</body>

</html>