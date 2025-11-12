<?php
require_once __DIR__ . '/../../../includes/dbconnect.php';

// kunin lahat ng rewards
$stmt = $pdo->query("SELECT r_name, r_percent, r_description, r_point FROM rewards");
$rewards = $stmt->fetchAll(PDO::FETCH_ASSOC);

// kunin reward history (optional)
$historyStmt = $pdo->query("
    SELECT r.r_name, rh.points_used, rh.dated_redeemed
    FROM rewards_history rh
    JOIN rewards r ON r.r_id = rh.r_id
    ORDER BY rh.dated_redeemed DESC
");
$history = $historyStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../css/cus_reward.css">
  <title>Cups & Stories Cafe-Reward Page</title>
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
    <h1>Reward</h1>
  </div>

  <div class="rewards-section">
    <h2>Redeem Rewards</h2>

    <?php foreach ($rewards as $r): ?>
      <div class="reward-item">
        <p>
          <strong><?= htmlspecialchars($r['r_name']) ?></strong><br>
          <small><?= htmlspecialchars($r['r_percent']) ?>% - <?= htmlspecialchars($r['r_description']) ?></small>
        </p>
        <button type="submit" class="points"><?= htmlspecialchars($r['r_point']) ?> pts</button>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="history-section">
    <h2>Reward History</h2>

    <?php if ($history): ?>
      <?php foreach ($history as $h): ?>
        <div class="history-item">
          <p><span><?= htmlspecialchars($h['r_name']) ?> - <?= htmlspecialchars($h['points_used']) ?> pts used on <?= htmlspecialchars($h['dated_redeemed']) ?></span></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="history-item">
        <p><span>No reward history yet.</span></p>
      </div>
    <?php endif; ?>
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