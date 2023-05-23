<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
include("conexion.php");
session_start();
//obtenemos la id de la oferta de empleo que queremos editar.
$id = $_GET['id'];
//generamos la consulta para obtener la oferta de empleo.
$sql = "SELECT * FROM ofertas_empleo WHERE id='$id'";
//ejecutamos la consulta.
$query = mysqli_query($conn, $sql);
//obtenemos los datos de la oferta de empleo y se guardan los indices numericos del array resultante en la variable $oferta.
$oferta = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Editar Oferta de Empleo</title>
</head>

<body>
    <div class="container">
        <!-- creamos el formulario para editar la oferta de empleo y le asignamos los valores de la oferta de empleo que queremos editar. -->
        <!-- en action ponemos el archivo php donde esta la logica para editar la oferta de empleo. -->
        <form action="editar_oferta.php" method="POST">
            <h1>Editar Oferta de Empleo</h1>
            <input type="hidden" name="id" value="<?= $oferta['id'] ?>">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" value="<?= $oferta['titulo'] ?>">
            <label for="titulo">Descripcion:</label>
            <textarea type="text" name="descripcion"><?= $oferta['descripcion'] ?></textarea>
            <label for="titulo">Empresa:</label>
            <input type="text" name="empresa" value="<?= $oferta['empresa'] ?>">
            <label for="titulo">Fecha:</label>
            <input type="date" name="fecha_publicacion" value="<?= $oferta['fecha_publicacion'] ?>">
            <br>
            <br>
            <br>
            <input class="update" type="submit" value="ACTUALIZAR">
        </form>
    </div>
</body>

</html>
