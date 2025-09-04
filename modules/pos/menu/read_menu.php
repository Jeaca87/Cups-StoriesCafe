<?php
include '../../../includes/dbconnect.php';

$sql = "SELECT * FROM menu";
$stmt = $pdo->query($sql);
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Menu List</h2>
<table border="1">
    <tr>
        <th>Image</th>
        <th>Item Name</th>
        <th>Size</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php foreach ($menus as $menu): ?>
        <tr>
            <td><img src="uploads/<?= htmlspecialchars($menu['image']) ?>" width="80"></td>
            <td><?= htmlspecialchars($menu['item_name']) ?></td>
            <td><?= htmlspecialchars($menu['size']) ?></td>
            <td><?= htmlspecialchars($menu['price']) ?></td>
            <td>
                <a href="update.php?id=<?= $menu['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $menu['id'] ?>" onclick="return confirm('Delete this item?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>