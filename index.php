<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
session_start();
include 'conexion.php';

//ejecutamos la consulta para mostrar las ofertas de empleo
$query = "SELECT * FROM ofertas_empleo";
$result = mysqli_query($conn, $query);
//consulta todas las filas y devuelve el resultado en un array asociativo, numérico, o ambos.
$ofertas = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ofertas de Empleo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Gestion de Ofertas de Empleo</h1>
        <!-- si el usuario ha iniciado sesión, se muestra el botón de cerrar sesión (isset determina si una variable esta declarada y no es null)-->
        <?php if (isset($_SESSION['usuario_id'])) : ?>
            <table>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Empresa</th>
                    <th>Fecha de Publicación</th>
                    <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_rol'] === 'Candidato') : ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
                <!-- se recorre el array de ofertas y se muestran los datos de cada una de ellas -->
                <?php foreach ($ofertas as $oferta) : ?>
                    <tr>
                        <td><?php echo $oferta['titulo']; ?></td>
                        <td><?php echo $oferta['descripcion']; ?></td>
                        <td><?php echo $oferta['empresa']; ?></td>
                        <td><?php echo $oferta['fecha_publicacion']; ?></td>
                        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_rol'] === 'Empleador') : ?>
                            <th><a href="update.php?id=<?= $oferta['id'] ?>" class="table-edit">EDITAR</a></th>
                            <th><a href="delete.php?id=<?= $oferta['id'] ?>" class="table-delete">ELIMINAR</a></th>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_rol'] === 'Candidato') : ?>
                            <td><a class="aplicar" href="aplicar.php?id=<?php echo $oferta['id']; ?>">APLICAR</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="link-container">
                <!-- creamos un boton para que el usuario con rol de Empleador pueda crear una oferta de empleo -->
                <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_rol'] === 'Empleador') : ?>
                    <a class="crear-oferta" href="crear_oferta.php">CREAR OFERTA DE EMPLEO</a>
                <?php endif; ?>
                <!-- boton para cerrar sesion -->
                <a class="logout" href="logout.php">CERRAR SESION</a>
            </div>
        <?php else : ?>
            <div class="link-container">
                <!-- botones de iniciar sesion o registrarse -->
                <a class="btn-login" href="login.php">INICIAR SESION</a>
                <a class="btn-register" href="registro.php">REGISTRARSE</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
