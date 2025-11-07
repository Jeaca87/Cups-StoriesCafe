<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Staff</title>
</head>

<body>
    <div>
        <nav>
            <h3>Account</h3>
            <h3>Cashier</h3>
        </nav>
    </div>
    <div>
        <form action="../../../includes//upload0.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileupload" required>
            <input type="hidden" name="source_table" value="cus_image">
            <input type="hidden" name="source_id" value="5">
            <button type="submit">Upload Image</button>
        </form>

    </div>
</body>

</html>