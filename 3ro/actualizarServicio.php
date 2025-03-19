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

$id = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empleado = $_POST['id_empleado'];
    $deporte = $_POST['deporte'];
    $duracion = $_POST['duracion'];
    $costo = $_POST['costo'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE servicio SET id_empleado='$id_empleado', deporte='$deporte', duracion='$duracion', costo='$costo', descripcion='$descripcion' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos del servicio actualizados con éxito";
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
}

if ($id) {
    $sql = "SELECT * FROM servicio WHERE id='$id'";
    $result = $conn->query($sql);
    $servicio = $result->fetch_assoc();
} else {
    $servicio = null;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Servicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Actualizar Servicio</h1>
        <?php if ($servicio): ?>
            <form action="actualizarServicio.php?id=<?php echo $servicio['id']; ?>" method="post">
                <div class="form-group">
                    <label for="id_empleado">ID Empleado</label>
                    <input type="text" class="form-control" id="id_empleado" name="id_empleado" value="<?php echo $servicio['id_empleado']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="deporte">Deporte</label>
                    <input type="text" class="form-control" id="deporte" name="deporte" value="<?php echo $servicio['deporte']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración</label>
                    <input type="number" class="form-control" id="duracion" name="duracion" value="<?php echo $servicio['duracion']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="costo">Costo</label>
                    <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="<?php echo $servicio['costo']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"><?php echo $servicio['descripcion']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="formulariosServicio.html" class="btn btn-secondary">Regresar</a>
            </form>
        <?php else: ?>
            <p>No se encontró el servicio con el ID especificado.</p>
            <a href="formulariosServicio.html" class="btn btn-secondary">Regresar</a>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
