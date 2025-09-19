<?php
include __DIR__ . '../../../../includes/dbconnect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid ID");
}

// Kunin yung menu data
$stmt = $pdo->prepare("SELECT * FROM menu WHERE m_id = :id");
$stmt->execute([':id' => $id]);
$menu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$menu) {
    die("Menu not found!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
</head>

<body>
    <form action="../../../includes/menu_inc/update_menu.inc.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="m_id" value="<?= htmlspecialchars($menu['m_id']); ?>">

        <label>Category:</label>
        <input type="text" name="m_category" value="<?= htmlspecialchars($menu['m_category']); ?>" required><br><br>

        <label>Menu Name:</label>
        <input type="text" name="m_name" value="<?= htmlspecialchars($menu['m_name']); ?>" required><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="m_price" value="<?= htmlspecialchars($menu['m_price']); ?>" required><br><br>

        <label>Temperature:</label>
        <select name="m_tempe">
            <option value="">None</option>
            <option value="hot" <?= $menu['m_tempe'] === 'hot' ? 'selected' : ''; ?>>Hot</option>
            <option value="cold" <?= $menu['m_tempe'] === 'cold' ? 'selected' : ''; ?>>Cold</option>
        </select><br><br>

        <label>Size:</label>
        <select name="m_size">
            <option value="">None</option>
            <option value="16oz" <?= $menu['m_size'] === '16oz' ? 'selected' : ''; ?>>16oz</option>
            <option value="24oz" <?= $menu['m_size'] === '24oz' ? 'selected' : ''; ?>>24oz</option>
        </select><br><br>

        <label>Current Image:</label><br>
        <?php if (!empty($menu['m_image'])): ?>
            <img src="../../../uploads/<?= htmlspecialchars($menu['image']); ?>" width="120"><br>
        <?php else: ?>
            <p>No image</p>
        <?php endif; ?>

        <label>Image</label>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>

</html>