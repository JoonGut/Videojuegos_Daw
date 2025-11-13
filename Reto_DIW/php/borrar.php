<?php
include 'conexion.php';

$nom = $_POST['nombre_juego'];

$existe = mysqli_query($conexion, "SELECT 1 FROM juegos WHERE nombre='$nom' LIMIT 1");

echo '<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Resultado</title>
<link rel="stylesheet" href="../css/estilos3.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="contenedor">';

if (mysqli_num_rows($existe) > 0) {

    $sqlborrar = "DELETE FROM juegos WHERE nombre = '$nom'";
    $ok = mysqli_query($conexion, $sqlborrar);

    if ($ok) {
        echo '
        <h1 class="titulo">Juego eliminado</h1>
        <p style="font-size:18px; margin-bottom:20px;">
            El juego <strong>'.htmlspecialchars($nom).'</strong> ha sido borrado correctamente.
        </p>
        <a href="../php/eleccion.php">
            <button class="boton-regresar">Volver</button>
        </a>';
    } else {
        echo '
        <h1 class="titulo">Error</h1>
        <p style="font-size:18px; margin-bottom:20px;">
            No se pudo borrar el juego.
        </p>
        <a href="../php/eleccion.php">
            <button class="boton-regresar">Volver</button>
        </a>';
    }

} else {

    echo '
    <h1 class="titulo">Juego no encontrado</h1>
    <p style="font-size:18px; margin-bottom:20px;">
        No existe ningún juego con el nombre <strong>'.htmlspecialchars($nom).'</strong>.
    </p>
    <a href="../php/eleccion.php">
        <button class="boton-regresar">Volver</button>
    </a>';

}

echo '</div></body></html>';

mysqli_close($conexion);
exit;
?>
