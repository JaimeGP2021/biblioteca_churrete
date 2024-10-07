<?php

function agregar_error($par, $mensaje, &$errores)
{
    if (!isset($errores[$par])) {
        $errores[$par] = [];
    }
    $errores[$par][] = $mensaje;
}

function obtener_parametro($par, $mensaje, &$errores)
{
    if (!isset($_GET[$par])) {
        agregar_error($par, $mensaje, $errores);
        return null;
    }
    return trim($_GET[$par]);
}

function comprobar_no_vacio($cadena, $par, $mensaje, &$errores)
{
    if ($cadena == '') {
        agregar_error($par, $mensaje, $errores);
    }
}

function hay_errores($errores)
{
    return !empty($errores);
}

function no_hay_errores($errores, $par)
{
    return !isset($errores[$par]) || empty($errores[$par]);
}

function comprobar_isbn(&$errores)
{
    $isbn = obtener_parametro('isbn', "Falta el ISBN.", $errores);
    if (no_hay_errores($errores, 'isbn')) {
        comprobar_no_vacio($isbn, 'isbn', "El ISBN es obligatorio.", $errores);
    }

    return $isbn;
}

function comprobar_titulo(&$errores)
{
    $titulo = obtener_parametro('titulo', "Falta el título.", $errores);
    if (no_hay_errores($errores, 'titulo')) {
        comprobar_no_vacio($titulo, 'titulo', "El título es obligatorio.", $errores);
    }

    return $titulo;
}

function comprobar_id(&$errores)
{
    $id = obtener_parametro('id', "Falta el ID del usuario.", $errores);
    if (no_hay_errores($errores, 'id')) {
        comprobar_no_vacio($id, 'id', "El ID del usuarioes obligatorio.", $errores);
    }

    return $id;
}

function comprobar_nombre(&$errores)
{
    $nombre = obtener_parametro('nombre', "Falta el nombre del usuario.", $errores);
    if (no_hay_errores($errores, 'nombre')) {
        comprobar_no_vacio($nombre, 'nombre', "El nombre del usuario es obligatorio.", $errores);
    }

    return $nombre;
}

function mostrar_mensajes_error($errores)
{
    foreach ($errores as $mensajes) {
        foreach ($mensajes as $mensaje) { ?>
            <h3><?= $mensaje ?></h3><?php
        }
    }
}

function calcula_devolucion($today)
{
    return ($today->add(new DateInterval('P30D')))->format('d/m/y');
}

function mostrar_resultado($titulo, $isbn, $id, $nombre, $fecha)
{ ?>
<p>El ejemplar de <?= $titulo ?> con ISBN <?= $isbn ?> ha sido sacado por el usuario <?= $nombre ?> con ID <?= $id ?>.</p>
<p>Tiene hasta el día <?=$fecha?> para devolverlo.</p><?php
}
