<?php
include "includes/dbconnect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/assets/css/cus_homepage.css">
    <title>Cups & Stories Cafe-Home Page</title>
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
        <h1>Our Stories Bring Us Together</h1>
    </div>

    <div class="offer">
        <div class="offer-container">
            <div class="offer-details">
                <h2>We Offer</h2>
                <p>Blueberry Cheesecake</p>
            </div>
            <img src="/assets/img/blue_cheesecake.jpeg" alt="Blueberry Cheesecake">
        </div>
    </div>

    <div class="reward">
        <div class="reward-container">
            <img src="/assets/img/voucher.png" alt="Reward Image">
            <div class="reward-details">
                <h2>Rewards</h2>
                <p>Earn exciting rewards like discounts and free items by collecting points and stamps.</p>
                <div class="reward-items">
                    <div class="reward-item">
                        <h3>10% Discount</h3>
                        <p>Earn points and redeem exciting discounts on your favorite items.</p>
                    </div>
                </div>
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