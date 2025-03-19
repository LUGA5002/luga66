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

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $duracion = $_POST['duracion'];
    $deporte = $_POST['deporte'];
    $precio = $_POST['precio'];

    // Preparar la consulta
    $sql = $conn->prepare("INSERT INTO inscripciones (duracion, deporte, precio) VALUES (?, ?, ?)");
    $sql->bind_param("ssd", $duracion, $deporte, $precio);

    if ($sql->execute()) {
        $mensaje = "Inscripción registrada con éxito";
        $mensajeClass = "alert-success";
    } else {
        $mensaje = "Error: " . $conn->error;
        $mensajeClass = "alert-danger";
    }

    $sql->close(); // Cerrar la consulta
}

$conn->close(); // Cerrar la conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Inscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #2c3e50; color: #ecf0f1;">
    <div class="container mt-4" style="background-color: #34495e; padding: 20px; border-radius: 10px;">
        <h1>Registro de Inscripción</h1>
        
        <?php if ($mensaje): ?>
            <div class="alert <?php echo $mensajeClass; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <a href="formInscripcion.html" class="btn btn-primary mt-4">Regresar</a>
    </div>
</body>
</html>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
