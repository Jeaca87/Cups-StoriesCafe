<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ingredients</title>
</head>

<body>
    <div class="navbar">
        <h2>Dashboard</h2>
        <h2>Admin</h2>
        <div class="image">
        </div>
    </div>
    <h3>Add Ingredients</h3>
    <form method="POST" action="../../../includes/add_ingre.inc.php">
        <h4>Item Id:</h4>
        <input type="number" id="itmid" name="itmid" disabled>

        <label>Item Name:</label>
        <input type="text" id="iname" name="iname" required>

        <label>QTY:</label>
        <input type="number" id="inum" name="inum" required>

        <label>Category:</label>
        <input type="text" id="icate" name="icate" required>

        <button type="submit" id="isave" name="isave">Save</button>
    </form>
</body>

</html>