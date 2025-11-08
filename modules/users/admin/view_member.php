<?php
include "../../../includes/dbconnect.php";

// Get ID from URL
if (!isset($_GET['id'])) {
    die("No member ID provided.");
}

$id = $_GET['id'];

// Fetch customer info
$stmt = $pdo->prepare("SELECT * FROM customer WHERE c_id = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$member) {
    die("Member not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Member Info</title>
</head>

<body>

    <div class="info-box">
        <?php if (!empty($member['image'])): ?>
            <img src="../uploads/<?= htmlspecialchars($member['image']) ?>" alt="Profile Image">
        <?php endif; ?>

        <h3><?= htmlspecialchars($member['c_fname'] . ' ' . $member['c_lname']) ?></h3>

        <div class="info-item"><strong>Email:</strong> <?= htmlspecialchars($member['c_email']) ?></div>
        <div class="info-item"><strong>Address:</strong> <?= htmlspecialchars($member['c_addr']) ?></div>
        <div class="info-item"><strong>Sex:</strong> <?= htmlspecialchars($member['c_sex']) ?></div>
        <div class="info-item"><strong>Birthday:</strong> <?= htmlspecialchars($member['c_bday']) ?></div>
        <div class="info-item"><strong>Occupation:</strong> <?= htmlspecialchars($member['c_occup']) ?></div>
        <div class="info-item"><strong>Tier Level:</strong> <?= htmlspecialchars($member['c_tier']) ?></div>
        <div class="info-item"><strong>Date Created:</strong> <?= htmlspecialchars($member['date_created']) ?></div>

        <br>
        <a href="member_list.php">Back</a>
    </div>

</body>

</html>