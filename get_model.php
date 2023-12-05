<?php
// get_model.php
try {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=abc123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    $sql = "SELECT model_data FROM models WHERE filename = :filename";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':filename', $filename);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $result['model_data'];
        exit;
    }
}
