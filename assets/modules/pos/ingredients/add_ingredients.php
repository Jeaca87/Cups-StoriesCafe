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
    <form>
        <h3>Add Ingredients</h3>
        <h4>Item Id:</h4>

        <div>
            <label>Item Name:</label>
            <input type="text" id="iname" name="iname">
        </div>

        <div>
            <label>QTY:</label>
            <input type="number" id="inum" name="inum">
        </div>

        <div>
            <label>Add Date:</label>
            <input type="date" id="idate" name="idate">
        </div>
        <button type="submit" id="isave" name="isave">Save</button>
    </form>
</body>

</html>