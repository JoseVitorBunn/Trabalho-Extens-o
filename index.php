<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressão 3D</title>
    <!-- Link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Link para o seu arquivo CSS personalizado -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="bg-dark text-white text-center py-3">
        <h1>Impressão 3D</h1>
    </header>

    <main class="container mt-4">
        <section id="upload-section">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Envie seu Modelo 3D</h2>
                </div>
                <div class="card-body">
                    <!-- Formulário de upload de modelos 3D -->
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

        <section id="modelos-usuario" class="mt-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2>Seus Modelos 3D</h2>
                </div>
                <div class="card-body">
                    <!-- Lista de modelos 3D enviados pelo usuário -->
                    <ul class="list-group" id="modeloList">
                        <!-- Os modelos 3D carregados pelo usuário serão exibidos aqui -->
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date("Y"); ?> Impressão 3D</p>
    </footer>

    <!-- Link para o Bootstrap JS e Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Link para o seu arquivo JavaScript -->
    <script src="js/main.js"></script>

</body>
</html>
