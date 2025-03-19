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
    $id_cliente = isset($_POST['id_cliente']) ? $conn->real_escape_string($_POST['id_cliente']) : '';
    $precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : '';
    $concepto = isset($_POST['concepto']) ? $conn->real_escape_string($_POST['concepto']) : '';
    $duracion = isset($_POST['duracion']) ? $conn->real_escape_string($_POST['duracion']) : '';

    if (!empty($id_cliente) && !empty($precio) && !empty($concepto) && !empty($duracion)) {
        $sql = "UPDATE pago SET precio='$precio', concepto='$concepto', duracion='$duracion' WHERE id_cliente='$id_cliente'";

        if ($conn->query($sql) === TRUE) {
            echo "Pago actualizado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

$conn->close();
?>
