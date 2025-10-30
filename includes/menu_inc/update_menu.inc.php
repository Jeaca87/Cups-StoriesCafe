<?php
include __DIR__ . '../../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id       = (int) $_POST['m_id'];
    $category = trim($_POST['m_category']);
    $name     = trim($_POST['m_name']);
    $price    = (float) $_POST['m_price'];
    $tempe    = !empty($_POST['m_tempe']) ? $_POST['m_tempe'] : null;
    $size     = !empty($_POST['m_size']) ? $_POST['m_size'] : null;

    // Kunin muna current image para fallback kung walang bagong upload
    $stmt = $pdo->prepare("SELECT image FROM menu WHERE m_id = :id");
    $stmt->execute([':id' => $id]);
    $current = $stmt->fetch(PDO::FETCH_ASSOC);
    $imageName = $current['image'];

    // Handle image upload (optional)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir  = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $tmpName = $_FILES['image']['tmp_name'];
        $origName = basename($_FILES['image']['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $imageName = uniqid("menu_", true) . "." . strtolower($ext);
        $uploadPath = $uploadDir . $imageName;

        if (!move_uploaded_file($tmpName, $uploadPath)) {
            $imageName = $current['image']; // fallback to old image
        }
    }

    try {
        $sql = "UPDATE menu 
                   SET m_category = :category, 
                       m_name = :name, 
                       m_price = :price, 
                       m_tempe = :tempe, 
                       m_size = :size, 
                       image = :image
                 WHERE m_id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tempe', $tempe);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':image', $imageName);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the statement
        $result = $stmt->execute();
        // Use a switch statement based on the result
        switch ($result) {
            case true:
                // If execution is successful
                header("Location: ../../modules/pos/menu/menu.php?success=1");
                exit();
            case false:
                // If execution fails
                header("Location: ../../modules/pos/menu/add_menu.php?error=1");
                exit();
        }


        if ($stmt->execute()) {
            header("Location: ../../modules/pos/menu/menu.php?updated=1");
            header("Location: ../../modules/users/customer/cus_menu.php?updated=1");
            exit();
        } else {
            header("Location: ../../modules/pos/menu/edit_menu.php?id=$id&error=1");
            header("Location: ../..//modules/users/customer/cus_menu.php?id=$id&error=1");
            exit();
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
