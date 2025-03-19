<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENTRO DE ESPECTÁCULOS Y DEPORTIVO IMPECSA</title>
    <link rel="shortcut icon" href="Imagenes/LogoIco.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<script type="text/javascript">
      addEvent(window,'load',cargar, false);
                 function addEvent(ele,eve,fun,cap){
                    if(window.attachEvent)
                      ele.addAttachEvent('on'+eve,fun);
                    else
                      ele.addEventListener(eve,fun,cap);
                 }
                 function xmlhttprequest(){
           return new XMLHttpRequest();
                 }
</script>
<body>

<header>
    <div class="container">
        <div id="branding">
            CENTRO DE ESPECTÁCULOS Y DEPORTIVO IMPECSA
        </div>
    </div>
</header>

<nav>
    <ul class="navbar navbar-expand-lg navbar-dark bg-dark">
        <li class="nav-item"><a class="nav-link" href="QuienesSomos.html">Quiénes Somos</a></li>
        <li class="nav-item"><a class="nav-link" href="Ubicacion.html">Ubicación</a></li>
        <li class="nav-item"><a class="nav-link" href="Productos.html">Productos</a></li>
        <li class="nav-item"><a class="nav-link" href="servicios.html">Servicios</a></li>
        <li class="nav-item"><a class="nav-link" href="contacto.html">Contáctanos</a></li>
        <li class="nav-item"><a class="nav-link" href="Formularios.html">Formularios</a></li>
        <li class="nav-item">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                <a class="nav-link" href="index.php?logout=true"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
            <?php else: ?>
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>

<div class="main-content">
    <!-- Sección de bienvenida -->
    <div class="welcome-section">
        <h1>Bienvenido al Centro de Espectáculos y Deportivo Impecsa</h1>
        <p>Nos especializamos en ofrecer servicios deportivos y espectáculos para toda la familia. Explora nuestras instalaciones y descubre lo que tenemos para ti.</p>
        <a href="contacto.html" class="btn-custom">Contáctanos</a>
    </div>

    <!-- Reincorporar las imágenes en una cuadrícula -->
    <div class="container container-custom">
        <section class="content">
            <h2>Galería</h2>
            <div class="image-grid">
                <img src="imagenes/Imagen1.png" class="img-fluid" alt="Imagen 1">
                <img src="imagenes/Impecsa2.png" class="img-fluid" alt="Imagen 2">
                <img src="imagenes/Impecsa3.png" class="img-fluid" alt="Imagen 3">
            </div>
            <h2>¿Quiénes Somos?</h2>
            <p>Nuestra empresa es un gimnasio que ofrece diversos servicios y productos, incluyendo deportes como el baloncesto y una variedad de productos disponibles en nuestro recinto. Nuestro centro de fitness está diseñado para promover la salud y el bienestar físico de nuestros miembros.</p>
        </section>
    </div>
</div>

<footer>
    <p>Impecsa &copy; 2024</p>
</footer>

<!-- Bootstrap JS y dependencias (jQuery, Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
// Manejar el cierre de sesión
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

</body>
</html>
