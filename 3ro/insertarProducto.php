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

$mensaje = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
    $precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : '';
    $descripcion = isset($_POST['descripcion']) ? $conn->real_escape_string($_POST['descripcion']) : '';

    if (!empty($id) && !empty($nombre) && !empty($precio) && !empty($descripcion)) {
        $sql = "INSERT INTO producto (id, nombre, precio, descripcion) 
                VALUES ('$id', '$nombre', '$precio', '$descripcion')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Producto registrado con éxito.";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #2c3e50; color: #ecf0f1;">
    <div class="container mt-4" style="background-color: #34495e; padding: 20px; border-radius: 10px;">
        <h1>Registro de Producto</h1>
        <?php if ($mensaje): ?>
            <div class="alert <?php echo ($conn->query($sql) === TRUE) ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <a href="formProducto.html" class="btn btn-primary mt-4">Regresar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
