<?php
    include "dbconnect.php";

    session_start();
    session_unset();
    session_destroy(); 
    header("Location: /login.php"); 
    exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cups & Stories Cafe-Settings</title>
</head>
<body>
    <div class="content2">
            <a href="/login.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>