<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "mysql123";
$dbname = "centroimpecsa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$metodo_pago = $_POST['metodo_pago'];
$total = $_POST['total'];

// Preparar la consulta
$sql = "INSERT INTO pagos (nombre, correo, direccion, metodo_pago, total) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $correo, $direccion, $metodo_pago, $total);

// Ejecutar la consulta y mostrar mensaje
if ($stmt->execute()) {
    echo "<!DOCTYPE html>";
    echo "<html lang='es'>";
    echo "<head><meta charset='UTF-8'><title>Pago Confirmado</title><link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'></head>";
    echo "<body>";
    echo "<div class='container mt-5'>";
    echo "<h2>Pago Confirmado</h2>";
    echo "<p>Gracias por su compra, $nombre. Su pago de $total ha sido procesado con éxito.</p>";
    echo "<a href='productos.html' class='btn btn-secondary'>Volver a Productos</a>";
    echo "</div>";
    echo "</body></html>";
} else {
    echo "<!DOCTYPE html>";
    echo "<html lang='es'>";
    echo "<head><meta charset='UTF-8'><title>Error en el Pago</title><link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'></head>";
    echo "<body>";
    echo "<div class='container mt-5'>";
    echo "<h2>Error en el Pago</h2>";
    echo "<p>Hubo un problema al procesar su pago. Inténtelo nuevamente.</p>";
    echo "<a href='pagoProductos.html' class='btn btn-secondary'>Volver a Intentar</a>";
    echo "</div>";
    echo "</body></html>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
