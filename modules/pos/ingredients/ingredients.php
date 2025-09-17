<?php
require '../../../includes/dbconnect.php';

$sql = "SELECT * FROM ingredients ORDER BY i_id DESC";
$stmt = $pdo->query($sql);
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
        <div>
            <nav>
                <h3>Ingredients</h3>
                <h3>Admin</h3>
            </nav>
        </div>

        <div class="add-ingre">
            <h2>Ingredients</h2>
            <a href="add_ingredients.php">Add Ingredient</a>
        </div>


        <div>
            <input type="search" id="search" placeholder="Search">
        </div>

        <div>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>QTY</th>
                        <th>Date Added</th>
                        <th>Last Updated</th>
                        <th>Others</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= $row['i_id']; ?></td>
                            <td><?= htmlspecialchars($row['i_name']); ?></td>
                            <td><?= htmlspecialchars($row['i_unit']); ?></td>
                            <td><?= $row['i_qty']; ?></td>
                            <td><?= $row['date_created']; ?></td>
                            <td><?= $row['date_updated'] ?? '—'; ?></td>
                            <td>
                                <a href="../ingredients/update_ingredients.php?id=<?= $row['i_id']; ?>">Edit</a> |
                                <a href="../../../includes/ingredients_inc/delete_ingre.inc.php?id=<?= $row['i_id']; ?>"
                                    onclick="return confirm('Are you sure?')">Delete</a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>