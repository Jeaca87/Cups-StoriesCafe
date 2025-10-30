<?php
include __DIR__ . '../../dbconnect.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        // Kunin muna image name kung meron
        $stmt = $pdo->prepare("SELECT image FROM menu WHERE m_id = :id");
        $stmt->execute([':id' => $id]);
        $menu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($menu) {
            // Delete muna sa DB
            $stmt = $pdo->prepare("DELETE FROM menu WHERE m_id = :id");
            $stmt->execute([':id' => $id]);

            // Kung may image, tanggalin din sa uploads folder
            if (!empty($menu['image'])) {
                $filePath = __DIR__ . '/../../uploads/' . $menu['image'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            header("Location: ../../modules/pos/menu/menu.php?deleted=1");
            header("Location: ../../modules/users/customer/cus_menu.php?success=1");
            exit();
        } else {
            header("Location: ../../modules/pos/menu/menu.php?error=notfound");
            header("Location: ../../modules/users/customer/cus_menu.php?error=notfound");
            exit();
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header("Location: ../../modules/pos/menu/menu.php?error=noid");
    header("Location: ../../modules/users/customer/cus_menu.php?error=noid");
    exit();
}
