<?php
include "../dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['content'])) {
    $page = $_POST['page'];
    $section = $_POST['section'];
    $content = $_POST['content'];

    // Check if text already exists
    $check = $pdo->prepare("SELECT id FROM web_texts WHERE page = :page AND section = :section");
    $check->execute(['page' => $page, 'section' => $section]);

    if ($check->rowCount() > 0) {
        // Update existing content
        $update = $pdo->prepare("UPDATE web_texts SET content = :content WHERE page = :page AND section = :section");
        $update->execute(['content' => $content, 'page' => $page, 'section' => $section]);
    } else {
        // Insert new text
        $insert = $pdo->prepare("INSERT INTO web_texts (page, section, content) VALUES (:page, :section, :content)");
        $insert->execute(['page' => $page, 'section' => $section, 'content' => $content]);
    }

    echo "✅ Text saved successfully!";
}
