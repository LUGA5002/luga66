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

$pago = null;
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = isset($_POST['id_cliente']) ? $conn->real_escape_string($_POST['id_cliente']) : '';

    if (!empty($id_cliente)) {
        $sql = "SELECT * FROM pago WHERE id_cliente='$id_cliente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $pago = $result->fetch_assoc();
        } else {
            $mensaje = "No se encontraron resultados para el ID Cliente $id_cliente.";
        }
    } else {
        $mensaje = "Por favor, ingrese un ID Cliente.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Pago</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: grey;">
    <div class="container mt-4">
        <h1>Buscar Pago</h1>

        <!-- Formulario para Buscar Pago -->
        <form action="buscarPago.php" method="post">
            <div class="form-group">
                <label for="id_cliente">ID Cliente:</label>
                <input type="text" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo isset($pago['id_cliente']) ? $pago['id_cliente'] : ''; ?>" placeholder="Ingrese ID Cliente">
            </div>
            <button type="submit" class="btn btn-warning">Buscar Pago</button>
            <a href="formPago.html" class="btn btn-secondary">Regresar</a>
        </form>

        <?php if ($mensaje): ?>
        <div class="alert alert-info mt-4">
            <?php echo $mensaje; ?>
        </div>
        <?php endif; ?>

        <?php if ($pago): ?>
        <div class="mt-4">
            <h2>Detalles de Pago</h2>
            <form action="actualizarPago.php" method="post">
                <div class="form-group">
                    <label for="id_cliente">ID Cliente:</label>
                    <input type="text" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $pago['id_cliente']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $pago['precio']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="concepto">Concepto:</label>
                    <input type="text" class="form-control" id="concepto" name="concepto" value="<?php echo $pago['concepto']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="duracion">Duración:</label>
                    <input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo $pago['duracion']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
