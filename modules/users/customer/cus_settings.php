<?php
include "includes/dbconnect.php";
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/cus_settings.css">
    <title>Cups & Stories Cafe-Settings</title>
</head>

<body>
    <div class="navbar">
        <img src="/assets/img/c&sLogo.png" alt="Cups & Stories Logo" class="logo">
        <div class="nav-right">
            <a href="/customer/cus_homepage.php">Home</a>
            <a href="/customer/cus_menu.php">Menu</a>
            <a href="/customer/cus_reward.php">Rewards</a>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <a href="/customer/cus_account.php"><img src="/assets/img/profile.png" alt="Profile" class="profile-img"></a>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="profile">
            <img src="/assets/img/profile.png" alt="Profile Picture" class="profile-img">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="profile-info">
                        <h2><?php echo $row['firstname'], ' ', $row['lastname'] ?></h2>
                        <p>Latte Level</p>
                    </div>

        </div>
    </div>

    <div class="content">
        <div class="content2">
            <label>Email: </label>
            <p><?php echo $row['email'] ?></p>
            <label>Password: </label>
            <p><?php echo $row['password'] ?></p>
        </div>
        <div class="content2">
            <a href="/login.php" class="logout-btn">Logout</a>
        </div>
<?php }
            } ?>
    </div>


    <div class="footer">
        <p>Contact Us:</p>
        <div class="footer-line">
            <div class="footer-item">
                <img src="/assets/img/call.png" alt="Phone Icon" class="footer-icon">
                <p><i class="fas fa-phone"></i> 0906 377 9569</p>
            </div>
            <div class="footer-item">
                <img src="/assets/img/location.png" alt="Location Icon" class="footer-icon">
                <p><i class="fas fa-map-marker-alt"></i> Barangay Pinagtipunan, General Trias, Cavite</p>
            </div>
            <div class="footer-item">
                <img src="/assets/img/facebook.png" alt="Facebook Icon" class="footer-icon">
                <p><i class="fab fa-facebook"></i> Facebook</p>
            </div>
        </div>
    </div>
</body>

</html>