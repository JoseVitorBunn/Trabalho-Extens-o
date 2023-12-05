<?php
// Database configuration
try {
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=abc123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressão 3D</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="bg-dark text-white text-center py-3">
        <h1>Impressão 3D</h1>
    </header>

    <main class="container mt-4">

        <!-- Upload Section -->
        <section id="upload-section">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Envie seu Modelo 3D</h2>
                </div>
                <div class="card-body">
                    <!-- 3D Model Upload Form -->
                    <form id="uploadForm" action="processar_upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="modelo3D">Escolha seu modelo 3D:</label>
                            <input type="file" class="form-control-file" name="modelo3D" id="modelo3D" accept=".stl, .obj, .gcode" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- User Models Section -->
        <section id="modelos-usuario" class="mt-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2>Seus Modelos 3D</h2>
                </div>
                <div class="card-body">
                    <!-- List of User-uploaded 3D Models -->
                    <?php
                    // Retrieve file information from the database using PDO
                    $sql = "SELECT id FROM models";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        foreach ($result as $row) {
                            echo '<div class="modelo3D" id="modelo' . $row["id"] . '"></div>';
                        }
                    } else {
                        echo '<p class="text-muted">Nenhum modelo disponível.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://threejs.org/build/three.js"></script>
    <!-- Custom JavaScript -->

    <script>
document.addEventListener('DOMContentLoaded', function () {
    var modelos3D = document.querySelectorAll('.modelo3D');

    modelos3D.forEach(function (modelo) {
        var id = modelo.id;

        // Configurar cena Three.js
        var cena = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(75, modelo.offsetWidth / modelo.offsetHeight, 0.1, 1000);
        var renderer = new THREE.WebGLRenderer();
        renderer.setSize(modelo.offsetWidth, modelo.offsetHeight);
        modelo.appendChild(renderer.domElement);

        // Adicionar luz
        var luz = new THREE.AmbientLight(0xffffff, 1);
        cena.add(luz);

        // Configurar posição da câmera
        camera.position.z = 5;

        // Carregar modelo STL
        var loader = new THREE.STLLoader();
        loader.load('/Trabalho5/uploads/656e5de499676_Divider_Board_Connector-ChrisTech.stl', function (geometriaCarregada) {
            var material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
            var modelo3D = new THREE.Mesh(geometriaCarregada, material);
            cena.add(modelo3D);
        });

        // Função de animação
        var animate = function () {
            requestAnimationFrame(animate);

            // Rotacionar o modelo
            if (modelo.children.length > 0) {
                modelo.children[0].rotation.x += 0.005;
                modelo.children[0].rotation.y += 0.005;
            }

            renderer.render(cena, camera);
        };

        animate();
    });
});
</script>


</body>
</html>
