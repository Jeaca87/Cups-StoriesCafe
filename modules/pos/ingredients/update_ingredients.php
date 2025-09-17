<?php
require '../../../includes/dbconnect.php';

// kunin yung id galing sa URL (halimbawa: update_ingredients.php?id=5)
if (!isset($_GET['id'])) {
    die("No ingredient ID provided.");
}
$id = (int) $_GET['id'];

// kunin yung data ng ingredient
$stmt = $pdo->prepare("SELECT * FROM ingredients WHERE i_id = :id");
$stmt->execute(['id' => $id]);
$ingredient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ingredient) {
    die("Ingredient not found!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Ingredients</title>
</head>

<body>
    <h3>Update Ingredients</h3>
    <form method="POST" action="../../../includes/ingredients_inc/update_ingre.inc.php">
        <input type="hidden" name="i_id" value="<?php echo $ingredient['i_id']; ?>">

        <div>
            <label>Item Name:</label>
            <input type="text" id="i_name" name="i_name" value="<?php echo $ingredient['i_name']; ?>" required>
        </div>

        <div>
            <label>QTY:</label>
            <input type="number" id="i_qty" name="i_qty" value="<?php echo $ingredient['i_qty']; ?>" required>
        </div>

        <div>
            <label>Category:</label>
            <input type="text" name="i_unit" value="<?php echo htmlspecialchars($ingredient['i_unit']); ?>" required>
        </div>
        <button type="submit" name="update">Update</button>
    </form>
</body>

</html>