<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
session_start();
include 'conexion.php';

//validamos si el metodo de la peticion es POST y procede a iniciar sesion.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

//seleccionamos el usuario que coincida con el email y contraseña ingresados mediante una consulta a la BD.
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
    $result = mysqli_query($conn, $query);
//devuelve un array asociativo que corresponde a la fila obtenida o NULL si es que no hay más filas.
    $usuario = mysqli_fetch_assoc($result);

//validamos si el usuario existe, si es asi, se crea una sesion con el id y rol del usuario.
    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_rol'] = $usuario['rol'];

//redireccionamos al index.php
        header('Location: index.php');
        exit;
    } else {
        $error = '<script>alert ("Email o contraseña incorrectos")</script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>

<!-- validamos si existe algun error al iniciar sesion. -->
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
<!-- creamos el formulario para iniciar sesion. -->
        <form method="POST" action="">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasena" required>

            <button class="btn-login-2" type="submit">INICIAR SESION</button>
        </form>
    </div>
</body>

</html>
