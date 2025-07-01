<?php
include "dbconnect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        die("Error: Email is required.");
    }

    if (empty($_POST["password"])) {
        die("Error: Password is required.");
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    echo "Email: $email<br>";

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        echo "User Found: " . $user["email"] . "<br>";

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["email"] = $user["email"];

        echo "Redirecting to homepage...<br>";
        header("Location: /customer/cus_homepage.php");
        exit();
    } else {
        echo "Error: User not found.<br>";
    }

    $stmt->close();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/assets/css/login.css">
    <title>Cups & Stories Cafe-Login</title>
</head>
<body>
    <div class="login-container">
        <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
        <h2>Login</h2>

        <form method="POST" action="">
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
        <div class="link">
            <p>Don't have an account? <a href="/register.php">Register</a></p>
        </div>
    </div>    
</body>
</html>
