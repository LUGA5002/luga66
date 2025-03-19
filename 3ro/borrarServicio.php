<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Servicio</title>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];

            $sql = "DELETE FROM servicio WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='text-success'>Servicio eliminado con éxito</p>";
            } else {
                echo "<p class='text-danger'>Error al eliminar el servicio: " . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>
        <a href="formServicio.html" class="btn btn-secondary mt-3">Regresar al Formulario de Servicios</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
