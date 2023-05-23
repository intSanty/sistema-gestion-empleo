<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
session_start();
include 'conexion.php';
//validamos si no hay una sesion iniciada y si el rol del usuario es diferente a Empleador, si es asi, redireccionamos al login.php.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'Empleador') {
    header('Location: login.php');
    exit;
}
//validamos si el metodo de la peticion es POST y procede a crear la oferta de empleo.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $empresa = $_POST['empresa'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
//generamos la consulta para mandar los datos de la oferta de empleo a la DB.
    $query = "INSERT INTO ofertas_empleo (titulo, descripcion, empresa, fecha_publicacion) VALUES ('$titulo', '$descripcion', '$empresa', '$fecha_publicacion')";
//ejecutamos la consulta.
    mysqli_query($conn, $query);
//redireccionamos al index.php donde estaran almacenadas todas las ofertas añadidas.
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear Oferta de Empleo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Crear Oferta de Empleo</h1>
<!-- creamos el formulario para crear la oferta de empleo. -->
        <form method="POST" action="">
            <label>Título:</label>
            <input type="text" name="titulo" required>

            <label>Descripción:</label>
            <textarea name="descripcion" required></textarea>

            <label>Empresa:</label>
            <input type="text" name="empresa" required>

            <label>Fecha de Publicación:</label>
            <input type="date" name="fecha_publicacion" required>
            <br>
            <br>
            <br>
            <button class="crear" type="submit">CREAR</button>
            <a class="volver-2" href="index.php">VOLVER</a>
        </form>


    </div>
</body>

</html>
