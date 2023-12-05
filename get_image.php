<?php
// Database configuration
try {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=abc123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve image data from the database
    $stmt = $pdo->prepare("SELECT image_data FROM models WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['image_data'])) {
        // Set the content type
        header('Content-Type: image/jpeg');

        // Output the image
        echo base64_decode($result['image_data']);
        exit();
    }
}

// Se algo der errado, exibir uma imagem padrão ou uma mensagem de erro
header('Content-Type: image/jpeg');
echo file_get_contents('path/to/default_image.jpg'); // Substitua pelo caminho da sua imagem padrão
