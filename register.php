<?php 
    include "include/dbconnect.php";

    if(isset($_POST['register'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO `user` (`firstname`, `lastname`, `email`, `password`) VALUES ('$firstname','$lastname','$email','$password')";
        $result = $conn->query($sql);

        if ($result) {
            header('location:/login.php');
        }
        else{
            die(mysqli_error($conn));
        }
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/assets/css/reg.css">
    <title>Cups & Stories Cafe-Register</title>
</head>
<body>
    <div class="container">
        <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
        <h1>Sign Up</h1>
        <form method="POST" action="">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password"placeholder="Password" required>
            <button type="submit" class="btn-signup" name="register">Sign up</button>
            <button type="submit" class="btn-cancel" onclick="location.href='/login.php';">Cancel</button>
        </form>
    </div>
</body>
</html>
