<?php
include "includes/dbconnect.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/cus_menu.css">
    <title>Cups & Stories Cafe-Menu Page</title>
    <script src="menu.js"></script>
</head>

<body>
    <div class="navbar">
        <img src="assets/img/c&sLogo.png" alt="Cups & Stories Logo" class="logo">
        <div class="nav-right">
            <a href="customer/cus_homepage.php">Home</a>
            <a href="customer/cus_menu.php">Menu</a>
            <a href="customer/cus_reward.php">Rewards</a>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <a href="customer/cus_account.php"><img src="/assets/img/profile.png" alt="Profile" class="profile-img"></a>
            </div>
        </div>
    </div>
    <div class="section">
        <h1>Menu</h1>
    </div>


    <div class="container">
        <div class="categories">
            <h2>Categories</h2>
            <ul>
                <li onclick="showCategory('Coffee')">Coffee</li>
                <li onclick="showCategory('Non-Coffee')">Non-Coffee</li>
                <li onclick="showCategory('FRAPPE')">FRAPPE</li>
                <li onclick="showCategory('Milk Tea')">Milk Tea</li>
                <li onclick="showCategory('Pasta')">Pasta</li>
                <li onclick="showCategory('Sandwich')">Sandwich</li>
                <li onclick="showCategory('PICA PICA')">PICA PICA</li>
                <li onclick="showCategory('Rice Meals')">Rice Meals</li>
                <li onclick="showCategory('Cake')">Cake</li>
            </ul>
        </div>
        <div class="content" id="menu-content">
            <p>Please select a category to view items.</p>
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
                <img src="assets/img/location.png" alt="Location Icon" class="footer-icon">
                <p><i class="fas fa-map-marker-alt"></i> Barangay Pinagtipunan, General Trias, Cavite</p>
            </div>
            <div class="footer-item">
                <img src="assets/img/facebook.png" alt="Facebook Icon" class="footer-icon">
                <p><i class="fab fa-facebook"></i> Facebook</p>
            </div>
        </div>
    </div>
</body>

</html>