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

$producto = null;
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : '';
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
    $precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : '';
    $descripcion = isset($_POST['descripcion']) ? $conn->real_escape_string($_POST['descripcion']) : '';

    if (isset($_POST['buscar']) && !empty($id)) {
        $sql = "SELECT * FROM producto WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
        } else {
            $mensaje = "No se encontraron resultados para el ID $id.";
        }
    } elseif (isset($_POST['actualizar']) && !empty($id)) {
        $sql = "UPDATE producto SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Datos del producto actualizados con éxito.";
            $producto = null; // Limpiar datos para evitar reenvío
        } else {
            $mensaje = "Error al actualizar los datos: " . $conn->error;
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
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Actualizar Datos del Producto</h1>

        <!-- Formulario para Buscar y Actualizar Producto -->
        <form action="" method="post" class="mb-4">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo isset($producto['id']) ? $producto['id'] : ''; ?>" placeholder="Ingrese ID del producto">
            </div>
            <button type="submit" class="btn btn-warning" name="buscar">Buscar Producto</button>

            <?php if ($producto): ?>
                <h2 class="mt-4">Actualizar Datos del Producto</h2>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>">
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $producto['descripcion']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
            <?php endif; ?>

            <!-- Botón para Regresar a formProducto -->
            <a href="formProducto.html" class="btn btn-secondary ">Regresar</a>
        </form>

        <?php if ($mensaje): ?>
        <div class="alert alert-info mt-4">
            <?php echo $mensaje; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
