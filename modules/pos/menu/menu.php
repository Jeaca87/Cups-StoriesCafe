<?php
include '../../../includes/dbconnect.php';

$sql = "SELECT * FROM menu";
$stmt = $pdo->query($sql);
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu List</title>
</head>

<body>
    <div>
        <div>
            <nav>
                <h3>Menu</h3>
                <h3>Admin</h3>
            </nav>
        </div>

        <div class="add-menu">
            <h2>Menu</h2>
            <a href="add_menu.php">Add Menu</a>
        </div>

        <table border="1">
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Temperature</th>
                <th>Price</th>
                <th>Others</th>
            </tr>
            <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><img src="uploads/<?= htmlspecialchars($menu['image']) ?>" width="80"></td>
                    <td><?= htmlspecialchars($menu['m_id']) ?></td>
                    <td><?= htmlspecialchars($menu['m_name']) ?></td>
                    <td><?= htmlspecialchars($menu['m_category']) ?></td>
                    <td><?= htmlspecialchars($menu['m_tempe']) ?></td>
                    <td>₱<?= htmlspecialchars($menu['m_price']) ?></td>
                    <td>
                        <a href="../menu/update_menu.php?id=<?= $menu['m_id'] ?>">Edit</a> |
                        <a href="../../../includes/menu_inc/delete_menu.inc.php?id=<?= $menu['m_id'] ?>" onclick="return confirm('Delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>