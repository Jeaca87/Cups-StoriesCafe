<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ingredients</title>
</head>

<body>
    <?php include("../../../includes/ingredients_inc/add_ingre.inc.php") ?>
    <div class="navbar">
        <h2>Ingredients</h2>
        <h2>Admin</h2>
        <div class="image"></div>
    </div>
    <h3>Add Ingredients</h3>
    <form method="POST" action="../../../includes/ingredients_inc/add_ingre.inc.php">
        <!-- Wala na dapat i_id input kasi AUTO_INCREMENT na -->

        <label>Item Name:</label>
        <input type="text" id="i_name" name="i_name" required>

        <label>QTY:</label>
        <input type="number" id="i_qty" name="i_qty" required>

        <label>Category:</label>
        <input type="text" id="i_unit" name="i_unit" required>

        <button type="submit" id="isave" name="isave">Save</button>
    </form>
</body>

</html>