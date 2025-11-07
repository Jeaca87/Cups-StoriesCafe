<?php
require '../../../../includes/dbconnect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/cus_account.css">
    <title>Cups & Stories Cafe-Account</title>
</head>

<body>
    <div class="navbar">
        <img src="/assets/img/c&sLogo.png" alt="Cups & Stories Logo" class="logo">
        <div class="nav-right">
            <a href="../customer/cus_homepage.php">Home</a>
            <a href="../customer/cus_menu.php">Menu</a>
            <a href="../customer/cus_reward.php">Rewards</a>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <a href="../customer/cus_account.php"><img src="/assets/img/profile.png" alt="Profile" class="profile-img"></a>
            </div>
        </div>
    </div>


    <div class="section">
        <div class="profile">
            <form action="../../../../includes//upload0.inc.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="fileupload" required>
                <input type="hidden" name="source_table" value="menu">
                <input type="hidden" name="source_id" value="5">
                <button type="submit">Upload Image</button>
            </form>

            <a href="../customer/cus_settings.php" class="settings-icon"><img src="settings.png" alt="Settings"></a>
        </div>
    </div>


    <div class="content">
        <h3>Current Coffee Cups: 80</h3>
        <p>Expires: December 31, 2025</p>


        <div class="reward-item">
            <p>Get 5% discount for any item</p>
            <p>Valid until January 31, 2025</p>
            <button>Activate</button>
        </div>


        <div class="points-history">
            <h3>Points History</h3>
            <div>
                <p>January 6, 2025 - 5 Coffee Cups - 8:00 PM</p>
            </div>
            <div>
                <p>January 5, 2025 - 3 Coffee Cups - 2:30 PM</p>
            </div>
        </div>
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