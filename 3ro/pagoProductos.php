<?php
$servername = "localhost";
$username = "root";
$password = "mysql123";
$dbname = "centroimpecsa";

// Conectar con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$carrito = json_decode($_POST['carrito'], true);

foreach ($carrito as $producto) {
    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $cantidad = $producto['cantidad'];
    $total = $precio * $cantidad;

    $sql = "INSERT INTO compras (producto, precio, cantidad, total) VALUES ('$nombre', $precio, $cantidad, $total)";
    
    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error;
    }
}

$conn->close();

// Vaciar el carrito después de la compra
echo "<script>
    localStorage.removeItem('carrito');
    alert('Compra realizada con éxito');
    window.location.href = 'productos.html';
</script>";
?>
