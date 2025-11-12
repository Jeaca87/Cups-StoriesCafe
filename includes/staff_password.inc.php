<?php
include __DIR__ . "/dbconnect.php"; // siguraduhing naka-PDO connection

if (isset($_POST['submit'])) {
    // Kunin ang pos_id (galing sa session o hidden input)
    $pos_id = $_POST['pos_id'] ?? null;
    $new_password = $_POST['password'] ?? '';

    if (empty($pos_id) || empty($new_password)) {
        echo "Missing user ID or password.";
        exit;
    }

    // Hash the new password (secure)
    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("UPDATE pos_users SET pos_pword = :password WHERE pos_id = :id");
        $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $pos_id
        ]);

        if ($stmt->rowCount()) {
            echo "Password successfully updated!";
        } else {
            echo "No changes made (check user ID).";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
