<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
</head>
<body>
    <div>
        <form action="" method="">
            <h5>Add Menu</h5>

            <label>Category:</label>
            <input type="text" id="category" name="category">

            <label>Menu Name:</label>
            <input type="text" id="mname" name="mname">

            <label>Price:</label>
            <input type="text" id="price" name="price">

            <label>Temperature:</label>
            <select>
                <option value="">None</option>
                <option value="hot">Hot</option>
                <option value="cold">Cold</option>
            </select>

            <label>Size:</label>
            <select>
                <option value="">None</option>
                <option value="16oz">16oz</option>
                <option value="24oz">24oz</option>
            </select>

            <button type="submit" id="save" name="save">Save</button>
        </form>
    </div>
</body>
</html>