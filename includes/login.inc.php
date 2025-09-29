<?php
session_start();
require_once 'db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['pword']);

    try {
        // 1️⃣ Check users table (admin + cashier)
        $sql = "SELECT id, fname, lname, email, password, role FROM pos_users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['pword'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
                $_SESSION['role'] = $row['role'];

                // Redirect based on role
                if ($row['role'] === 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($row['role'] === 'cashier') {
                    header("Location: cashier_dashboard.php");
                }
                exit;
            } else {
                die("Invalid password.");
            }
        }

        // 2️⃣ Check customers table
        $sql = "SELECT c_id, c_fname, c_lname, c_email, password FROM customer WHERE c_email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['c_pass'])) {
                $_SESSION['c_id'] = $row['c_id'];
                $_SESSION['c_name'] = $row['c_fname'] . " " . $row['c_lname'];

                header("Location: cus_homepage.php");
                exit;
            } else {
                die("Invalid password.");
            }
        }

        // 3️⃣ If not found anywhere
        die("No account found with that email.");
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
