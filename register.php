<?php 
    include "includes/dbconnect.php";

    //di pa sya tapos, kasi nahihirapan ako kung paano malalaman kung customer or staff yung mag register
    //pwede sya separate file para mas better dahil yung admin at staff ay may role selection, then sa customer ay walang role selection

    //dapat walang email duplication

    //pag na isset mo yung register, hihingi sya ng name, email, pass 
    if(isset($_POST['register'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // checheck kung yung email ay nag exist na
        $stmt = $pdo->prepare("SELECT * FROM acc_pos WHERE acc_email");
        $stmt->execute([$email]);

        //sa $stmt->rowCount(), kung 0 wala pang email, kung 1 naman ay nag eexist na yung email na ininput
        if($stmt->rowCount() > 0){ 
            $_SESSION['error'] = "Email already exist";
            header("Location: register.php");
            exit;
        }

        $hashpassword = password_hash($password, PASSWORD_DEFAULT); //itong line na toh is para naka encrypted yung password pakag nakalagay na sya sa database para di makita ng iba
        $stmt = $pdo->prepare("INSERT INTO acc_pos (acc_fname, acc_lname, acc_email, acc_pass) VALUES (?, ?, ?, ?)"); //kapag nag click ng register button ang user, mapupunta ang info sa database 

        $_SESSION['success'] = "Registered successfully";
        header("Location: login.php");
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
            <button type="submit" class="btn-cancel" onclick="location.href='login.php';">Cancel</button>
        </form>
    </div>
</body>
</html>
