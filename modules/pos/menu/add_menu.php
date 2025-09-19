<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
</head>

<body>
    <div>
        <div>
            <nav>
                <h3>Menu</h3>
                <h3>Admin</h3>
            </nav>
        </div>
        <h2>Add Menu</h2>
        <div>
            <form action="../../../includes/menu_inc/add_menu.inc.php" method="POST" enctype="multipart/form-data">
                <label>Category:</label>
                <input type="text" id="m_category" name="m_category" required><br><br>

                <label>Menu Name:</label>
                <input type="text" id="m_name" name="m_name" required><br><br>

                <label>Price:</label>
                <input type="number" id="m_price" step="0.01" name="m_price" required><br><br>

                <label>Temperature:</label>
                <select id="m_tempe" name="m_tempe">
                    <option value="">None</option>
                    <option value="hot">Hot</option>
                    <option value="cold">Cold</option>
                </select><br><br>

                <label>Size:</label>
                <select id="m_size" name="m_size">
                    <option value="">None</option>
                    <option value="16oz">16oz</option>
                    <option value="24oz">24oz</option>
                </select><br><br>

                <label for="image">Image:</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)"><br><br>

                <!-- Image preview -->
                <img id="preview" src="" alt="Preview" width="150" style="display:none;"><br><br>

                <button type="submit" name="submit">Save</button>
            </form>
        </div>
    </div>
</body>

</html>