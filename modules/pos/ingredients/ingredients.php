<?php
require '../../../includes/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredients</title>
</head>

<body>
    <div>
        <nav>
            <h3>Ingredients</h3>
            <h3>Admin</h3>
        </nav>
    </div>

    <div>
        <input type="search" id="search" placeholder="Search">
    </div>

    <div>
        <thead border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>QTY</th>
                <th>Date Added</th>
                <th>Others</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $stmt = $pdo->query("SELECT * FROM ingredients ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['date_added']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                    </tr>";
            }
            ?>
        </tbody>
    </div>
</body>

</html>