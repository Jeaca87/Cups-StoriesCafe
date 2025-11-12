<?php
include __DIR__ . "/../../../includes/dbconnect.php";
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'customer') {
    header("Location: ../../../index.php");
    exit();
}
include __DIR__ . "/../../../includes/web_inc/cus_homepage.inc.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../../css/cus_homepage.css">
    <title>Cups & Stories Cafe-Home Page</title>
</head>

<body>
    <div class="navbar">
        <img src="/assets/img/c&sLogo.png" alt="Cups & Stories Logo" class="logo">
        <div class="nav-right">
            <a href="cus_homepage.php">Home</a>
            <a href="cus_menu.php">Menu</a>
            <a href="cus_reward.php">Rewards</a>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <a href="cus_account.php"><img src="/assets/img/profile.png" alt="Profile" class="profile-img"></a>
            </div>
        </div>
    </div>
    <div class="section">
        <h1>Our Stories Bring Us Together</h1>
    </div>

    <div class="offer">
        <div class="offer-container">
            <?php if ($menu): ?>
                <div class="offer-details">
                    <h2><?= htmlspecialchars($menu['m_name']) ?></h2>
                    <p>₱<?= htmlspecialchars($menu['m_price']) ?> — <?= htmlspecialchars($menu['m_category']) ?></p>
                </div>
                <img src="/customer/uploads/<?= htmlspecialchars($menu['image']) ?>" alt="<?= htmlspecialchars($menu['m_name']) ?>">
            <?php else: ?>
                <p>No featured menu available.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="reward">
        <div class="reward-container">
            <img src="/assets/img/voucher.png" alt="Reward Image">
            <div class="reward-details">
                <h2>Rewards</h2>
                <div class="reward-items">
                    <?php if ($rewards): ?>
                        <?php foreach ($rewards as $r): ?>
                            <div class="reward-item">
                                <h3><?= htmlspecialchars($r['r_name']) ?></h3>
                                <p><?= htmlspecialchars($r['r_description']) ?></p>
                                <small>Earn <?= htmlspecialchars($r['r_point']) ?> pts — <?= htmlspecialchars($r['r_percent']) ?>%</small>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No rewards available at the moment.</p>
                    <?php endif; ?>
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