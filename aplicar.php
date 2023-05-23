<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
session_start();
include 'conexion.php';
//si no existe la variable de sesion usuario_id o la variable de sesion usuario_rol es diferente a Candidato, redireccionar al login.php.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'Candidato') {
    header('Location: login.php');
    exit;
}
//si el metodo de la peticion es POST, obtenemos el id de la oferta de empleo y el id del candidato, para insertarlos en la tabla postulaciones.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_oferta = $_POST['id_oferta'];
    $id_candidato = $_SESSION['usuario_id'];
//generamos la consulta para insertar los datos en la tabla postulaciones.
    $query = "INSERT INTO postulaciones (id_oferta, id_candidato) VALUES ('$id_oferta', '$id_candidato')";
//ejecutamos la consulta.
    mysqli_query($conn, $query);
//redireccionamos al index.php.
    header('Location: index.php');
    exit;
}
//obtenemos el id de la oferta de empleo que queremos aplicar.
$id_oferta = $_GET['id'];
//generamos la consulta para obtener los datos de la oferta de empleo.
$query = "SELECT * FROM ofertas_empleo WHERE id = '$id_oferta'";
//ejecutamos la consulta.
$result = mysqli_query($conn, $query);
//obtenemos los datos de la oferta de empleo de forma asociativa.
$oferta = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aplicar a Oferta de Empleo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Aplicar a Oferta de Empleo</h1>
<!-- creamos el formulario para aplicar a la oferta de empleo. -->
        <form method="POST" action="">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo $oferta['titulo']; ?>" readonly>

            <label>Descripción:</label>
            <textarea name="descripcion" readonly><?php echo $oferta['descripcion']; ?></textarea>

            <label>Empresa:</label>
            <input type="text" name="empresa" value="<?php echo $oferta['empresa']; ?>" readonly>

            <label>Fecha de Publicación:</label>
            <input type="text" name="fecha_publicacion" value="<?php echo $oferta['fecha_publicacion']; ?>" readonly>

            <input type="hidden" name="id_oferta" value="<?php echo $oferta['id']; ?>">

            <button class="aplicar-2" type="submit">APLICAR</button>
            <a class="volver" href="index.php">VOLVER</a>
        </form>


    </div>
</body>

</html>
