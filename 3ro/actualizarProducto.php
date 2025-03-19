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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    // Actualizar datos del producto
    $sql = "UPDATE producto SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Datos del producto actualizados con éxito";
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
}

$conn->close();
?>
