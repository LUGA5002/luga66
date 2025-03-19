<?php
$servername = "localhost";
$username = "root";
$password = "mysql123";
$dbname = "centroimpecsa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si se envió el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';

    if (!empty($id)) {
        $sql = "SELECT * FROM inscripciones WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $inscripcion = $result->fetch_assoc();
        } else {
            $mensaje = "No se encontraron resultados para el ID $id.";
        }
    } else {
        $mensaje = "Por favor, ingrese un ID.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar y Eliminar Inscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Buscar y Eliminar Inscripción</h1>

        <!-- Formulario para Buscar Inscripción -->
        <form action="buscarInscripcion.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo isset($inscripcion['id']) ? $inscripcion['id'] : ''; ?>" placeholder="Ingrese ID de la inscripción">
            </div>
            <button type="submit" class="btn btn-warning">Buscar Inscripción</button>
            <a href="formInscripcion.html" class="btn btn-secondary">Regresar</a>
        </form>

        <?php if ($mensaje): ?>
        <div class="alert alert-info mt-4">
            <?php echo $mensaje; ?>
        </div>
        <?php endif; ?>

        <?php if ($inscripcion): ?>
        <div class="mt-4">
            <h2>Detalles de Inscripción</h2>
            <form action="borrarInscripcion.php" method="post">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $inscripcion['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración:</label>
                    <input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo $inscripcion['duracion']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="deporte">Deporte:</label>
                    <input type="text" class="form-control" id="deporte" name="deporte" value="<?php echo $inscripcion['deporte']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $inscripcion['precio']; ?>" readonly>
                </div>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
