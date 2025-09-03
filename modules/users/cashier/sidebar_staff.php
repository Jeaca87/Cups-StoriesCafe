<?php
// yung $page ay current page
$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<link rel="stylesheet" href="/Cups&StoriesCafe/assets/css/sidebar.css">
<div class="container">
    <div class="sidebar">
        <div class="header">
            <h1>Cashier</h1>
            <p>Cups & Stories Cafe</p>
        </div>
        <ul>
            <!-- yung laman ng $page ay kung saang link mapupunta -->
            <li class="nav-link <?php echo ($page == 'menu.php') ? 'active' : ''; ?>">
                <a href="../admin/menu.php">
                    <span class="material-symbols-rounded" img alt="Menu">menu_book_2</span>
                    Menu
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'transaction.php') ? 'active' : ''; ?>">
                <a href="/assets/modules/pos/menu/transaction.php">
                    <span class="material-symbols-rounded" img alt="Transaction">receipt</span>
                    Transactions
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'ingredients.php') ? 'active' : ''; ?>">
                <a href="/assets/modules/pos/ingredients/ingredients.php">
                    <span class="material-symbols-rounded" img alt="Ingredients">grocery</span>
                    Ingredients
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'account.php') ? 'active' : ''; ?>">
                <a href="./account.php">
                    <span class="material-symbols-rounded" img alt="Account">account_circle</span>
                    Account
                </a>
            </li>
            <li class="nav-link <?php echo ($page == 'admin.php') ? 'active' : ''; ?>">
                <a href="#">
                    <span class="material-symbols-rounded" img alt="Logout">logout</span>
                    Logout
                </a>
            </li>
        </ul>
        <button aria-label="Toggle menu" class="toggle-menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</div>