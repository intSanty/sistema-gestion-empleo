<?php
//crea una sesión o reanuda la actual basada en un id de sesión pasado mediante una petición GET o POST.
session_start();
//libera todas las variables de sesión actualmente registradas.
session_unset();
//destruye toda la informacion asociada con la sesion actual.
session_destroy();
//redireccionar al index.php.
header('Location: index.php');
exit;
