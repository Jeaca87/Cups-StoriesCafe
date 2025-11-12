<?php
// --- Connect to database ---
include __DIR__ . "/dbconnect.php"; // siguraduhin naka-PDO connection ito

try {
    // --- Get admin info from database ---
    $sql = "SELECT pos_id, pos_fname, pos_lname, pos_email, pos_date_created 
            FROM pos_users 
            WHERE pos_role = 'admin'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Admin Accounts:</h3>";
    if ($admins) {
        echo "<ul>";
        foreach ($admins as $admin) {
            echo "<li>";
            echo htmlspecialchars($admin['pos_fname'] . " " . $admin['pos_lname']);
            echo " — " . htmlspecialchars($admin['pos_email']);
            echo " (Created: " . htmlspecialchars($admin['pos_date_created']) . ")";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No admin accounts found.";
    }
} catch (PDOException $e) {
    echo "Database error: " . htmlspecialchars($e->getMessage());
}
