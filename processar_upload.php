<?php
// processar_upload.php

try {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=abc123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["modelo3D"])) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['modelo3D']['name']);

    if (move_uploaded_file($_FILES['modelo3D']['tmp_name'], $uploadFile)) {
        $filename = basename($_FILES['modelo3D']['name']);

        $stmt = $pdo->prepare("INSERT INTO models (filename) VALUES (:filename)");
        $stmt->bindParam(':filename', $filename);
        $stmt->execute();

        header("Location: index.php"); // Redirecionar para a página principal após o upload
        exit;
    } else {
        echo "Erro ao fazer upload do arquivo.";
    }
}
?>
