<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>

<body>
    <div>
        <div>
            <div method="POST" action="../customer/cus_info/info.php" enctype="multipart/form-data">
                <input type="file" name="image">
                <br>
                <button type="submit" name="submit">Edit</button>
            </div>
            <h5>Jean Villanueva</h5>
            <p>Latte Level</p>
        </div>
        <form>
            <h3>Edit Account</h3>
            <label>Email:</label>
            <label>Birthday:</label>
            <label>Address:</label>
            <label>Sex:</label>
            <select>
                <option value="">Choose</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label>Occupation:</label>
            <label>Password:</label>
            <button type="submit" name="submit">save</button>
        </form>

        <button type="submit" name="logout">Logout</button>
    </div>
</body>

</html>