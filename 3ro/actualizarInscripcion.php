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

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
    $duracion = isset($_POST['duracion']) ? $conn->real_escape_string($_POST['duracion']) : '';
    $deporte = isset($_POST['deporte']) ? $conn->real_escape_string($_POST['deporte']) : '';
    $precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : '';

    if (!empty($id)) {
        $sql = "UPDATE inscripcion SET duracion='$duracion', deporte='$deporte', precio='$precio' 
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Datos de la inscripción actualizados con éxito.";
        } else {
            $mensaje = "Error al actualizar los datos: " . $conn->error;
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
    <title>Actualizar Inscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Actualizar Inscripción</h1>

        <?php if ($mensaje): ?>
        <div class="alert alert-info">
            <?php echo $mensaje; ?>
        </div>
        <?php endif; ?>

        <a href="formInscripcion.html" class="btn btn-secondary">Regresar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
