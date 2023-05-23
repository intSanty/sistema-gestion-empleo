<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
include("conexion.php");
session_start();
//inicializamos los datos que se van a modificar mediante el metodo POST.
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$desc = $_POST['descripcion'];
$empresa = $_POST['empresa'];
$fecha = $_POST['fecha_publicacion'];
//generamos la consulta para editar la oferta de empleo.
$sql = "UPDATE ofertas_empleo SET titulo='$titulo', descripcion='$desc', empresa='$empresa', fecha_publicacion='$fecha' WHERE id='$id'";
//ejecutamos la consulta.
$query = mysqli_query($conn, $sql);
//si hay una consulta exitosa, redireccionamos al index.php.
if ($query) {
    Header("Location: index.php");
} else {
}
