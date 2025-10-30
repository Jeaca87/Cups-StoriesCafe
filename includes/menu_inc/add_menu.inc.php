<?php
include __DIR__ . '../../dbconnect.php'; // ayusin path depende sa project mo

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get values
    $category = trim($_POST['m_category']);
    $name     = trim($_POST['m_name']);
    $price    = (float) $_POST['m_price'];
    $tempe    = !empty($_POST['m_tempe']) ? $_POST['m_tempe'] : null;
    $size     = !empty($_POST['m_size']) ? $_POST['m_size'] : null;

    // Handle image upload
    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir  = __DIR__ . '/../../uploads/'; // Upload folder
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // create folder if not exists
        }

        $tmpName = $_FILES['image']['tmp_name'];
        $origName = basename($_FILES['image']['name']);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $imageName = uniqid("menu_", true) . "." . strtolower($ext); // unique filename
        $uploadPath = $uploadDir . $imageName;

        if (!move_uploaded_file($tmpName, $uploadPath)) {
            $imageName = null; // fallback if upload failed
        }
    }

    try {
        // Insert into DB (make sure column name matches your DB, e.g., m_image)
        $sql = "INSERT INTO menu (m_category, m_name, m_price, m_tempe, m_size, image) 
                VALUES (:category, :name, :price, :tempe, :size, :image)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':tempe', $tempe);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':image', $imageName);


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
            header("Location: ../../modules/pos/menu/menu.php?success=1");
            header("Location: ../../modules/users/customer/cus_menu.php?success=1");
            exit();
        } else {
            header("Location: ../../modules/pos/menu/add_menu.php?error=1");
            header("Location: ../../modules/users/customer/cus_menu.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // safer to log errors, but for dev we can show it
        die("Database error: " . $e->getMessage());
    }
}
