<?php
//Declaramos variables para la conexión
$host = 'localhost';
$db = 'empleos';
$user = 'root';
$pass = '';

//Conectamos a la base de datos
$conn = mysqli_connect($host, $user, $pass, $db);

//Verificamos la conexión
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
}
?>
