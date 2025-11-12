<?php
session_start();
include "../../../../includes/dbconnect.php";

if (!isset($_SESSION['c_id'])) {
    header("Location: ../../../index.php");
    exit();
}

$c_id = $_SESSION['c_id'];

// Kunin ang customer info
$sql = "SELECT * FROM customer WHERE c_id = '$c_id'";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>

<body>
    <div>
        <div>
            <!-- Profile Picture Upload -->
            <form method="POST" action="../cus_info/info.php" enctype="multipart/form-data">
                <?php if (!empty($customer['image'])): ?>
                    <img src="../../../uploads/<?= htmlspecialchars($customer['image']); ?>"
                        alt="Profile Image" width="120" height="120" style="border-radius:50%;">
                <?php else: ?>
                    <img src="../../../uploads/default.png" alt="Default Profile" width="120" height="120" style="border-radius:50%;">
                <?php endif; ?>
                <br><br>
                <input type="file" name="image" accept="image/*" required>
                <br><br>
                <button type="submit" name="upload">Update Photo</button>
            </form>

            <h5><?= htmlspecialchars($customer['c_fname'] . ' ' . $customer['c_lname']); ?></h5>
            <p><?= htmlspecialchars($customer['c_tier']); ?></p>
        </div>

        <!-- Account Edit Form -->
        <form method="POST" action="../../../../includes/cashier_acc.inc.php">
            <h3>Edit Account</h3>

            <label>Email:</label><br>
            <input type="email" name="c_email" value="<?= htmlspecialchars($customer['c_email']); ?>"><br><br>

            <label>Birthday:</label><br>
            <input type="date" name="c_bday" value="<?= htmlspecialchars($customer['c_bday']); ?>"><br><br>

            <label>Address:</label><br>
            <input type="text" name="c_addr" value="<?= htmlspecialchars($customer['c_addr']); ?>"><br><br>

            <label>Sex:</label><br>
            <select name="c_sex">
                <option value="">Choose</option>
                <option value="Male" <?= $customer['c_sex'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?= $customer['c_sex'] == 'Female' ? 'selected' : ''; ?>>Female</option>
            </select><br><br>

            <label>Occupation:</label><br>
            <input type="text" name="c_occup" value="<?= htmlspecialchars($customer['c_occup']); ?>"><br><br>

            <label>Password (leave blank to keep current):</label><br>
            <input type="password" name="c_pass"><br><br>

            <button type="submit" name="save">Save Changes</button>
        </form>

        <form method="POST" action="../cus_info/info.php">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>

</html>