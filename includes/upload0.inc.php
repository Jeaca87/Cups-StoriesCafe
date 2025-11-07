<?php
include __DIR__ . "/dbconnect.php"; // siguraduhing naka-PDO na rin ang dbconnect.php

if (isset($_FILES['fileupload'])) {
    $file = $_FILES['fileupload'];
    $filename = basename($file['name']);
    $tmp_name = $file['tmp_name'];

    // Upload folder path (outside /includes)
    $folder = __DIR__ . "/../uploads/";
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true); // auto-create folder if not exists
    }

    $target = $folder . $filename;

    $source_table = $_POST['source_table'] ?? null;
    $source_id = $_POST['source_id'] ?? null;
    $edit_mode = isset($_POST['edit_mode']);

    if (move_uploaded_file($tmp_name, $target)) {
        try {
            // Edit mode: replace old image if exists
            if ($edit_mode) {
                $check = $pdo->prepare("SELECT image_path FROM images WHERE source_table = ? AND source_id = ?");
                $check->execute([$source_table, $source_id]);
                $result = $check->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $old = $result['image_path'];
                    if (file_exists($old)) unlink($old); // delete old image

                    $update = $pdo->prepare("UPDATE images SET image_path = ?, uploaded_at = NOW() WHERE source_table = ? AND source_id = ?");
                    $update->execute([$target, $source_table, $source_id]);
                    echo "✅ Image updated successfully!";
                } else {
                    $insert = $pdo->prepare("INSERT INTO images (image_path, source_table, source_id) VALUES (?, ?, ?)");
                    $insert->execute([$target, $source_table, $source_id]);
                    echo "🆕 New image added.";
                }
            } else {
                // Normal upload (insert only)
                $insert = $pdo->prepare("INSERT INTO images (image_path, source_table, source_id) VALUES (?, ?, ?)");
                $insert->execute([$target, $source_table, $source_id]);
                echo "Image uploaded successfully!";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Error uploading file. Please check folder permissions.";
    }
}
