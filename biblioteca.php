<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamo</title>
</head>

<body>
    <?php
    require 'auxiliar.php';

    $errores = [];

    $today = new DateTimeImmutable();
    $isbn = comprobar_isbn($errores);
    $titulo = comprobar_titulo($errores);
    $id = comprobar_id($errores);
    $nombre = comprobar_nombre($errores);

    if (hay_errores($errores)) {
        mostrar_mensajes_error($errores);
    } else {
        $fecha = calcula_devolucion($today);
        mostrar_resultado($titulo, $isbn, $id, $nombre, $fecha);
    }

    ?>
    <a href="index.html"><button>Volver</button></a>
</body>

</html>
