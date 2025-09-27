<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Member List</title>
</head>

<body>
    <div>
        <h5> View Member List Info</h5>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Birthday</th>
                <th>Occupation</th>
                <th>Tier Level</th>
                <th>Email</th>
                <th>Others</th>
                </t>

                <?php foreach ($menus as $menu): ?>
            <tr>
                <td><img src="uploads/<?= htmlspecialchars($customer['image']) ?>" width="80"></td>
                <td><?= htmlspecialchars($customer['c_id']) ?></td>
                <td><?= htmlspecialchars($menu['c_name']) ?></td>
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