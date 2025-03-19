<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Inscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50; /* Fondo oscuro */
            color: #ecf0f1; /* Color del texto blanco para contraste */
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #34495e; /* Fondo gris oscuro para el contenedor */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            margin: 20px auto;
            max-width: 600px;
            text-align: center;
        }
        .btn-primary {
            background-color: #1abc9c; /* Color del botón primario */
            border-color: #1abc9c;
        }
        .btn-primary:hover {
            background-color: #16a085;
            border-color: #16a085;
        }
        .btn-secondary {
            background-color: #95a5a6; /* Color del botón secundario */
            border-color: #95a5a6;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
            border-color: #7f8c8d;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "mysql123";
        $dbname = "centroimpecsa";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("<p class='text-danger'>Conexión fallida: " . $conn->connect_error . "</p>");
        }

// Si se envió el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';

    if (!empty($id)) {
        // Verificar si el ID existe antes de eliminar
        $sql_check = "SELECT * FROM inscripciones WHERE id='$id'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            // Eliminar inscripción
            $sql_delete = "DELETE FROM inscripciones WHERE id='$id'";
            if ($conn->query($sql_delete) === TRUE) {
                $mensaje = "Inscripción eliminada con éxito.";
            } else {
                $mensaje = "Error al eliminar: " . $conn->error;
            }
        } else {
            $mensaje = "No se encontró la inscripción con ID $id.";
        }
    } else {
        $mensaje = "ID no válido.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Inscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Eliminar Inscripción</h1>

        <?php if ($mensaje): ?>
        <div class="alert alert-info">
            <?php echo $mensaje; ?>
        </div>
        <?php endif; ?>

        <a href="buscarInscripcion.php" class="btn btn-primary mt-4">Regresar</a>
    </div>
</body>
</html>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
