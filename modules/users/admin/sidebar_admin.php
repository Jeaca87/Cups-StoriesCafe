<?php
// yung $page ay current page
$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<link rel="stylesheet" href="/Cups&StoriesCafe/assets/css/sidebar.css">
<div class="container">
    <div class="sidebar">
        <div class="header">
            <h1>Admin</h1>
            <p>Cups & Stories Cafe</p>
        </div>
        <ul>
            <!-- yung laman ng $page ay kung saang link mapupunta -->
            <li class="nav-link <?php echo ($page == 'dashboard.php') ? 'active' : ''; ?>">
                <a href="../admin/dashboard.php">
                    <span class="material-symbols-rounded" img alt="Dashboard">dashboard</span>
                    Dashboard
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'edit_home_page.php') ? 'active' : ''; ?>">
                <a href="../admin/manage_website/edit_home_page.php">
                    <span class="material-symbols-rounded" img alt="Edit Home">edit</span>
                    Manage Home/Menu
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'edit_reward_page.php') ? 'active' : ''; ?>">
                <a href="../admin/manage_website/edit_reward_page.php">
                    <span class="material-symbols-rounded" img alt="Edit Home">edit</span>
                    Manage Reward
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'menu.php') ? 'active' : ''; ?>">
                <a href="../admin/menu.php">
                    <span class="material-symbols-rounded" img alt="Menu">menu_book_2</span>
                    Menu
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'transaction.php') ? 'active' : ''; ?>">
                <a href="../../pos/transaction.php">
                    <span class="material-symbols-rounded" img alt="Transaction">receipt</span>
                    Transactions
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'ingredients.php') ? 'active' : ''; ?>">
                <a href="../../pos/ingredients/ingredients.php">
                    <span class="material-symbols-rounded" img alt="Ingredients">grocery</span>
                    Ingredients
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'people.php') ? 'active' : ''; ?>">
                <a href="../../pos/people.php">
                    <span class="material-symbols-rounded" img alt="People">group</span>
                    People
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'sales_report.php') ? 'active' : ''; ?>">
                <a href="../../sales_and_report/sales_report.php">
                    <span class="material-symbols-rounded" img alt="Reports">monitoring</span>
                    Reports
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'account.php') ? 'active' : ''; ?>">
                <a href="../admin/account.php">
                    <span class="material-symbols-rounded" img alt="Account">account_circle</span>
                    Account
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'admin.php') ? 'active' : ''; ?>">
                <a href="../../../includes/logout.php">
                    <span class="material-symbols-rounded" img alt="Logout">logout</span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>