<?php
include 'conexion.php';

//validamos si el metodo de la peticion es POST y procede a registrar el usuario.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

//se mandan los datos registrados a la respectiva base de datos asociada.
    $query = "INSERT INTO usuarios (nombre, email, contrasena, rol) VALUES ('$nombre', '$email', '$contrasena', '$rol')";
//se ejecuta la consulta.
    mysqli_query($conn, $query);
//redireccionamos al login.php
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Registro de Usuario</h1>
<!-- creamos el formulario para registrar un usuario. -->
        <form method="POST" action="">
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre" required>

            <label>Email:</label>
            <input type="email" name="email" placeholder="Ejemplo@gmail.com" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasena" placeholder="********" required>

            <label>Rol:</label>
            <select name="rol" required>
                <option value="Candidato">Candidato</option>
                <option value="Empleador">Empleador</option>
            </select>
            <br>
            <br>
            <br>
            <button class="btn-register-2" type="submit">REGISTRARSE</button>
            ¿ya tiene una cuenta?<a class="iniciar" href="login.php"> Inicie sesion aqui.</a>
        </form>
    </div>
</body>

</html>
