<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("Location: ../../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/admin_dashboard.css">
    <title>Admin Dashboard</title>
</head>

<body>

    <<<<<<< Updated upstream
        <?php include 'admin/sidebar_admin.php' ?>=======>>>>>>> Stashed changes
        <!--dapat naka card dito sa dashbord ng admin-->
        <div class="navbar">
            <nav>
                <h1>Dashboard</h1>
                <h2>Admin</h2>
            </nav>
        </div>
        <div class="searchbar">
            <input type="search" id="search" placeholder="Search">
        </div>
        <div class="information">
            <div class="menu">
                <div class="menu-details">
                    <h2>Menu</h2>
                </div>
            </div>
            <div class="ingredients">
                <div class="ingredients-details">
                    <h2>Ingredients</h2>
                </div>
            </div>
            <div class="members">
                <div class="members-details">
                    <h2>Member List</h2>
                </div>
            </div>
            <div class="rewards">
                <div class="rewards-details">
                    <h2>Rewards</h2>
                </div>
            </div>
            <div class="sales">
                <div class="sales-details">
                    <h3>Current Sales</h3>
                    <h3 id="today">Today's Sales</h3>
                </div>
            </div>
            <div class="transactions">
                <div class="transaction-details">
                    <h3>Date</h3>
                    <table>
                        <tr>
                            <th>Time</th>
                            <th>Receipt No.</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</body>

</html>