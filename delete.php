<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
include("conexion.php");
session_start();
//obtenemos la id de la oferta de empleo que queremos eliminar.
$id=$_GET['id'];
//generamos la consulta para eliminar la oferta de empleo.
$sql = "DELETE FROM ofertas_empleo WHERE id='$id'";
//ejecutamos la consulta.
$query = mysqli_query($conn, $sql);
//si hay una consulta exitosa, redireccionamos al index.php.
if ($query) {
    Header("Location: index.php");
} else {
}
