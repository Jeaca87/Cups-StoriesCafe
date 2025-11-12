<!-- CHECKOUT SECTION -->
<h2>Checkout</h2>
<form method="post">
    <table border="1" cellpadding="5">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach ($_SESSION['checkout'] as $item):
            $sub = $item['qty'] * $item['m_price'];
            $grandTotal += $sub;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['m_name']) ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="menu_id" value="<?= $item['m_id'] ?>">
                        <button type="submit" name="update_qty" value="minus">-</button>
                    </form>
                    <?= $item['qty'] ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="menu_id" value="<?= $item['m_id'] ?>">
                        <button type="submit" name="update_qty" value="plus">+</button>
                    </form>
                </td>
                <td>₱<?= $item['m_price'] ?></td>
                <td>₱<?= $sub ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>₱<?= $grandTotal ?></strong></td>
        </tr>
    </table>
    <br>


    <!-- LOYALTY SECTION -->
    <h2>Loyalty Points</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Id</th>
            <th>Member Name</th>
            <th>Point Earn</th>
            <th>Discount</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach ($_SESSION['checkout'] as $item):
            $sub = $item['qty'] * $item['m_price'];
            $grandTotal += $sub;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['m_name']) ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="menu_id" value="<?= $item['m_id'] ?>">
                        <button type="submit" name="update_qty" value="minus">-</button>
                    </form>
                    <?= $item['qty'] ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="menu_id" value="<?= $item['m_id'] ?>">
                        <button type="submit" name="update_qty" value="plus">+</button>
                    </form>
                </td>
                <td>₱<?= $item['m_price'] ?></td>
                <td>₱<?= $sub ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>₱<?= $grandTotal ?></strong></td>
        </tr>
    </table>
    <br>


    <!-- SUBTOTAL SECTION -->
    <h2>SubTotal</h2>
    <h3>SubTotal</h3>

    <table border="1" cellpadding="5">
        <tr>
            <th>Total</th>
            <th>Cash</th>
            <th>Change</th>
            <th>Discount</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach ($_SESSION['checkout'] as $item):
            $sub = $item['qty'] * $item['m_price'];
            $grandTotal += $sub;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['m_name']) ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="menu_id" value="<?= $item['m_id'] ?>">
                        <button type="submit" name="update_qty" value="minus">-</button>
                    </form>
                    <?= $item['qty'] ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="menu_id" value="<?= $item['m_id'] ?>">
                        <button type="submit" name="update_qty" value="plus">+</button>
                    </form>
                </td>
                <td>₱<?= $item['m_price'] ?></td>
                <td>₱<?= $sub ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>₱<?= $grandTotal ?></strong></td>
        </tr>
    </table>
    <br>
    <button type="submit" name="checkout">Scan</button>
    <button type="submit" name="clear_all">Clear All</button>
    <button type="submit" name="checkout">Checkout</button>
</form>

<?php include '../../../includes/checkout.inc.php'; ?>