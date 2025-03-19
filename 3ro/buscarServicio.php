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

$servicio = null;
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';

    if (isset($_POST['buscar']) && !empty($id)) {
        $sql = "SELECT * FROM servicio WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $servicio = $result->fetch_assoc();
        } else {
            $mensaje = "No se encontraron resultados para el ID $id.";
        }
    } elseif (empty($id)) {
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
    <title>Buscar Servicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Buscar Servicio</h1>
        <form action="buscarServicio.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="Ingrese ID del servicio">
            </div>
            <button type="submit" class="btn btn-warning" name="buscar">Buscar Servicio</button>
            <a href="formServicio.html" class="btn btn-secondary">Regresar</a>
        </form>

        <?php if ($servicio): ?>
            <div class="mt-4">
                <h2>Servicio Encontrado</h2>
                <p><strong>ID:</strong> <?php echo $servicio['id']; ?></p>
                <p><strong>ID Empleado:</strong> <?php echo $servicio['id_empleado']; ?></p>
                <p><strong>Deporte:</strong> <?php echo $servicio['deporte']; ?></p>
                <p><strong>Duración:</strong> <?php echo $servicio['duracion']; ?></p>
                <p><strong>Costo:</strong> <?php echo $servicio['costo']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $servicio['descripcion']; ?></p>
                <a href="actualizarServicio.php?id=<?php echo $servicio['id']; ?>" class="btn btn-primary">Actualizar Servicio</a>
            </div>
        <?php elseif ($mensaje): ?>
            <div class="mt-4">
                <p><?php echo $mensaje; ?></p>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
