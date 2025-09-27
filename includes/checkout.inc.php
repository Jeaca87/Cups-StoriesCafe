<?php
include '../../../includes/dbconnect.php';

// Simulan session array para sa checkout
if (!isset($_SESSION['checkout'])) {
    $_SESSION['checkout'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_checkout'])) {
    $variant = explode('|', $_POST['variant']);
    $menu_id     = isset($variant[0]) ? (int)$variant[0] : 0;
    $price       = isset($variant[1]) ? (float)$variant[1] : 0;
    $temperature = isset($variant[2]) ? $variant[2] : null;
    $size        = isset($variant[3]) ? $variant[3] : null;
    $qty         = (int) $_POST['qty'];


    // Kunin yung item mula DB
    $stmt = $pdo->prepare("SELECT * FROM menu WHERE m_id = ?");
    $stmt->execute([$menu_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $found = false;
        foreach ($_SESSION['checkout'] as &$cartItem) {
            // check pati size at temperature
            if (
                $cartItem['m_id'] == $menu_id &&
                $cartItem['temperature'] == $temperature &&
                $cartItem['size'] == $size
            ) {
                $cartItem['qty'] += $qty;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $item['qty'] = $qty;
            $item['m_price'] = $price;
            $item['temperature'] = $temperature;
            $item['size'] = $size;
            $_SESSION['checkout'][] = $item;
        }
    }
}



// Handle quantity update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_qty'])) {
    $menu_id = (int) $_POST['menu_id'];
    $action  = $_POST['update_qty']; // plus or minus

    foreach ($_SESSION['checkout'] as &$cartItem) {
        if ($cartItem['m_id'] == $menu_id) {
            if ($action === "plus") {
                $cartItem['qty']++;
            } elseif ($action === "minus") {
                $cartItem['qty']--;
                if ($cartItem['qty'] <= 0) {
                    // alisin sa checkout kapag 0
                    $_SESSION['checkout'] = array_filter($_SESSION['checkout'], function ($ci) use ($menu_id) {
                        return $ci['m_id'] != $menu_id;
                    });
                }
            }

            break;
        }
    }
    unset($cartItem); // good practice after foreach reference
}

// Handle clear button
if (isset($_POST['clear_all'])) {
    $_SESSION['checkout'] = [];
    $message = "";
}


// Handle checkout button
if (isset($_POST['checkout'])) {
    // Example: insert sa sales table
    // pagkatapos clear ang cart
    $_SESSION['checkout'] = [];
    $message = "Checkout successful!";
}

// Kunin lahat ng category
$categories = $pdo->query("SELECT DISTINCT m_category FROM menu")->fetchAll(PDO::FETCH_COLUMN);

// Kunin lahat ng menu items
$menus = $pdo->query("SELECT * FROM menu")->fetchAll(PDO::FETCH_ASSOC);
