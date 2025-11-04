<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("Location: ../../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cashier Dashboard</title>
</head>

<body>
    <?php
    include '../../../includes/checkout.inc.php'; // checkout logic
    include '../../../includes/category.inc.php'; // category filter logic
    ?>
    <h2>Cashier Dashboard - Menu</h2>

    <?php if (!empty($message)): ?>
        <p style="color:green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- CATEGORY FILTER -->
    <div>
        <h3>Categories</h3>
        <?php foreach ($categories as $cat): ?>
            <a href="?category=<?= urlencode($cat) ?>">
                <?= htmlspecialchars($cat) ?>
            </a> |
        <?php endforeach; ?>
        <a href="cashier_dashboard.php">All</a>
    </div>

    <!-- MENU LIST -->
    <div class="dashboard">
        <?php foreach ($uniqueMenus as $menu): ?>
            <?php
            // filter by category
            if ($selectedCat && $menu['m_category'] !== $selectedCat) continue;

            // Kunin lahat ng variants ng item (temp + size + price)
            $stmtVar = $pdo->prepare("
                SELECT m_id, m_price, m_tempe, m_size
                FROM menu
                WHERE m_name = ?
            ");
            $stmtVar->execute([$menu['m_name']]);
            $variants = $stmtVar->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="item-box">
                <form method="post">
                    <img src="../../../uploads/<?= htmlspecialchars($menu['image']) ?>"
                        alt="<?= htmlspecialchars($menu['m_name']) ?>" width="100"><br>
                    <strong><?= htmlspecialchars($menu['m_name']) ?></strong><br>

                    <!-- select option for temp + size + price -->
                    <select name="variant">
                        <?php foreach ($variants as $v): ?>
                            <option value="<?= $v['m_id'] ?>|<?= $v['m_price'] ?>|<?= $v['m_tempe'] ?>|<?= $v['m_size'] ?>">
                                <?= htmlspecialchars($v['m_tempe']) ?> - <?= htmlspecialchars($v['m_size']) ?> - ₱<?= $v['m_price'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                    <input type="number" name="qty" value="1" min="1">
                    <button type="submit" name="add_to_checkout">Add</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    </form>
    <br>
    <?php include '../cashier/checkout.php'; ?>
</body>

</html>