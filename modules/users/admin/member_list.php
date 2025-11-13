<?php
include "../../../includes/dbconnect.php";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $stmt = $pdo->query("SELECT c_id, c_fname, c_lname, c_tier, c_email FROM customer ORDER BY c_id DESC");
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Member List</title>
</head>

<body>
    <div>
        <?php include("../sidebar_admin.php"); ?>
        <h5>Member List</h5>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Tier Level</th>
                <th>Email</th>
                <th>Others</th>
            </tr>

            <?php if ($members): ?>
                <?php foreach ($members as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['c_id']) ?></td>
                        <td><?= htmlspecialchars($m['c_fname'] . ' ' . $m['c_lname']) ?></td>
                        <td><?= htmlspecialchars($m['c_tier']) ?></td>
                        <td><?= htmlspecialchars($m['c_email']) ?></td>
                        <td>
                            <a href="view_member.php?id=<?= $m['c_id'] ?>">View Info</a> |
                            <a href="../../../includes/delete_member.inc.php?id=<?= $m['c_id'] ?>" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No members found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>