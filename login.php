<?php
include "includes/dbconnect.php";   //connect sa dbconnect
session_start();   //dito mag start yung web

if(isset($_POST['submit'])){   //pag pinindot yung submit,
    $username = $_POST['email'];   //kukunin nya yung email at password
    $password = $_POST['password'];

    //pupunta syang database para kunin ang email at password ng admin or staff 
    $stmt = $pdo->prepare("SELECT * FROM acc_pos WHERE acc_email = ?");
    $stmt->execute([$username]);   //stmt means statement
    $employee = $stmt->fetch();

    if($employee && password_verify($password, $employee['password'])){
        $_SESSION['acc_id'] = $employee['id'];
        $_SESSION['acc_email'] = $employee['email'];
        $_SESSION['acc_role'] = $employee['role'];

        if($employee['role'] === 'admin'){
            header("Location: admin/account.php");
        }else{
            header("Location: staff/account.php");
        }
        exit;
    }

    //kung user naman, pupunta syang database ng customer para kunin ang email at password
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE acc_email = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['cus_id'] = $user['id'];
        $_SESSION['cus_email'] = $user['email'];

        header("Location: staff/account.php");
    
        exit;
    }else{
        echo"Wrong email or password";
    }
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
