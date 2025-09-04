<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
</head>

<body>
    <?php include '../../../includes/update_menu.inc.php' ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="item_name" value="<?= htmlspecialchars($menu['item_name']) ?>" required>
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($menu['price']) ?>" required>
        <input type="text" name="size" value="<?= htmlspecialchars($menu['size']) ?>">
        <input type="file" name="image">
        <button type="submit" name="update">Save</button>
    </form>

</body>

</html>