<?php
require "includes/dbconnect.php";

//di pa sya tapos, kasi nahihirapan ako kung paano malalaman kung customer or staff yung mag register
//pwede sya separate file para mas better dahil yung admin at staff ay may role selection, then sa customer ay walang role selection

//dapat walang email duplication

//pag na isset mo yung register, hihingi sya ng name, email, pass 
//pupunta syang database para kunin ang email at password ng admin or staff
// your PDO connection file

if (isset($_POST['submit'])) {
    $fname   = trim($_POST['fname']);
    $lname   = trim($_POST['lname']);
    $email   = trim($_POST['email']);
    $pword1  = $_POST['pword1'];
    $pword2  = $_POST['pword2'];
    $role    = $_POST['role']; // cashier or customer

    // check passwords
    if ($pword1 !== $pword2) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: signup.php");
        exit;
    }

    // hash password
    $hashedPassword = password_hash($pword1, PASSWORD_DEFAULT);

    try {
        // check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Email is already registered!";
            header("Location: signup.php");
            exit;
        }

        // insert new user
        $stmt = $pdo->prepare("INSERT INTO users (fname, lname, email, password, role) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $email, $hashedPassword, $role]);

        $_SESSION['success'] = "Registration successful! Please log in.";
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/assets/css/reg.css">
    <title>Cups & Stories Cafe Sign Up</title>
</head>

<body>
    <div class="container">
        <img src="/assets/img/logoName.png" alt="Cups & Stories Logo" class="logo">
        <h1>Sign Up</h1>

        <form method="POST" action="">
            <div>
                <label>First name:</label>
                <input type="text" name="fname" placeholder="Enter your first name" required>
            </div>
            <div>
                <label>Last name:</label>
                <input type="text" name="lname" placeholder="Enter your last name" required>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="pword1" placeholder="Enter your password" required>
            </div>
            <div>
                <label>Confirm Password:</label>
                <input type="password" name="pword2" placeholder="Confirm your password" required>
            </div>

        </form>
    </div>
</body>

</html>