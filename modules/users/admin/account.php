<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Admin</title>
</head>

<body>
    <div>
        <nav>
            <h3>Account</h3>
            <h3>Admin</h3>
        </nav>
    </div>

    <form action="../../../includes/upload0.inc.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="fileupload" required>
        <input type="hidden" name="source_table" value="admin_image">
        <input type="hidden" name="source_id" value="5">
        <button type="submit">Upload Image</button>
    </form>

    <form action="staff_password.inc.php" method="POST">
        <!-- Hidden user ID (pwede rin galing sa session sa backend) -->
        <input type="hidden" name="pos_id" value="1">

        <div>
            <label>Password:</label>
            <input type="password" name="password" required />
            <button type="submit" name="submit">Save</button>
        </div>
    </form>


    <div>
        <label>Switch Branch</label>
        <Select>
            <option value="main">Main Branch</option>
            <option value="2nd">2nd Branch</option>
        </Select>
    </div>
</body>

</html>