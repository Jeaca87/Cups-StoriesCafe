<?php
include "../../../includes/web_inc/cus_menupage.inc.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cups & Stories Cafe-Menu Page</title>
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

    <!-- Page Heading -->
    <section class="section">
        <h1>Menu</h1>
    </section>

    <!-- Container -->
    <div class="container">
        <!-- Sidebar Categories -->
        <aside class="categories">
            <h2>Categories</h2>
            <ul id="category-list">
                <li><a href="cus_menu.php">All</a></li>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <a href="cus_menu.php?category=<?= urlencode($cat['m_category']) ?>"
                            <?= ($category == $cat['m_category']) ? 'class="active"' : '' ?>>
                            <?= htmlspecialchars($cat['m_category']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <!-- HTML Display -->
        <div class="menu-items">
            <?php foreach ($groupedMenu as $menu): ?>
                <div class="menu-item">
                    <img src="assets/img/<?= htmlspecialchars($menu['image']) ?>"
                        alt="<?= htmlspecialchars($menu['m_name']) ?>"
                        width="100">
                    <h3><?= htmlspecialchars($menu['m_name']) ?></h3>
                    <?php foreach ($menu['variants'] as $variant): ?>
                        <div class="variant">
                            <p><?= htmlspecialchars($variant['points']) ?>point/s</p>
                            <p><strong><?= htmlspecialchars($variant['label']) ?></strong></p>
                            <p>₱<?= htmlspecialchars($variant['price']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
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
    </div>
</body>

</html>