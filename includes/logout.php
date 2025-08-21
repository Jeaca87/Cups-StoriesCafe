<?php
include "includes/dbconnect.php";

session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit();

?>


<div class="content2">
    <a href="../index.php" class="logout-btn">Logout</a>
</div>