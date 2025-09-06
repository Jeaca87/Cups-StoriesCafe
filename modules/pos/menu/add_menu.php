<?php
require '../../../includes/dbconnect.php';
include '../../../includes/add_menu.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
</head>

<body>
    <div>
        <form action="" method="POST">
            <input type="text" name="menuid" disabled>

            <label>Category:</label>
            <input type="text" name="category" required><br><br>

            <label>Product Name:</label>
            <input type="text" name="product" required><br><br>

            <label>Price:</label>
            <input type="number" step="0.01" name="price" required><br><br>

            <label>Temperature:</label>
            <select name="temperature">
                <option value="">None</option>
                <option value="hot">Hot</option>
                <option value="cold">Cold</option>
            </select><br><br>

            <button type="submit" name="submit">Save</button>
        </form>
    </div>
</body>

</html>