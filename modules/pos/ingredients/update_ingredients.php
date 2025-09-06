<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ingredients</title>
</head>

<body>
    <h3>Update Ingredients</h3>
    <form>
        <h4>Item Id:</h4>

        <div>
            <label>Item Name:</label>
            <input type="text" id="iname" name="iname" value="<?= $ingredient['name'] ?>" required>
        </div>

        <div>
            <label>QTY:</label>
            <input type="number" id="inum" name="inum" value="<?= $ingredient['category'] ?>" required>
        </div>

        <div>
            <label>Add Date:</label>
            <input type="date" id="idate" name="idate" value="<?= $ingredient['quantity'] ?>" required>
        </div>
        <button type="submit" id="isave" name="isave">Save</button>
    </form>
</body>

</html>