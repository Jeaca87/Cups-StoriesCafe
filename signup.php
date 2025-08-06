<?php
require "includes/dbconnect.php";

//di pa sya tapos, kasi nahihirapan ako kung paano malalaman kung customer or staff yung mag register
//pwede sya separate file para mas better dahil yung admin at staff ay may role selection, then sa customer ay walang role selection

//dapat walang email duplication

//pag na isset mo yung register, hihingi sya ng name, email, pass 

$role = 'customer';

if (isset($_GET['type']) && ($_GET['type'] === 'staff')) {
    $role = 'staff';
}

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pword1 = $_POST['pword1'];
    $pword2 = $_POST['pword2'];

    if (isset($_GET['type']) && ($_GET['type'] === 'staff')) {
        $role = 'staff';
    } else {
        $role = 'customer';
    }

    if ($role === 'admin') {
        $_SESSION['error'] = "You can not register as admin";
        header("Location: register.php");
        exit;
    }

    // checheck kung yung email ay nag exist na
    $stmt = $pdo->prepare("SELECT * FROM acc_pos WHERE acc_email");
    $stmt->execute([$email]);

    //sa $stmt->rowCount(), kung 0 wala pang email, kung 1 naman ay nag eexist na yung email na ininput
    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Email already exist";
        header("Location: register.php" . (isset($_GET['type']) ? '?type=' . $_GET['type'] : ''));
        exit;
    }

    $hashpassword = password_hash($password, PASSWORD_DEFAULT); //itong line na toh is para naka encrypted yung password pakag nakalagay na sya sa database para di makita ng iba

    $stmt = $pdo->prepare("INSERT INTO $table (acc_fname, acc_lname, acc_email, acc_pass) VALUES (?, ?, ?, ?)"); //kapag nag click ng register button ang user, mapupunta ang info sa database 
    $stmt->execute([$firstname, $lastname, $email, $hashedPSassword]);

    //like ivisualize na sabi ay "registered as staff or customer" sa strtoupper()
    $_SESSION['success'] = "Registered successfully" . strtoupper($role) . "!"; //what role the users was register as and uses strtoupper() to make the role uppercase for emphasis
    header("Location: login.php");
    exit;
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
            <?php
            if ($pword1 == $pword2) {
            }
            ?>
        </form>
    </div>
</body>

</html>