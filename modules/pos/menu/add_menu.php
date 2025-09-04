<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
</head>

<body>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="menuid" disabled>

            <label>Category:</label>
            <input type="text" name="category">

            <label>Product Name:</label>
            <input type="text" name="product">

            <label>Price:</label>
            <input type="text" name="price">

            <label>Temperature:</label>
            <select>
                <option value="">None</option>
                <option value="hot">Hot</option>
                <option value="cold">Cold</option>
            </select>
            <button type="submit" name="submit">Save</button>
        </form>
    </div>
</body>

</html>