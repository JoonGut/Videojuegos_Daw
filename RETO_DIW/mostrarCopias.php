<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Página PHP</title>
    <link rel="stylesheet" href="estilos.css">
</head>
</html>
<?php
include 'conexion.php';

if ($conexion->connect_errno) {
    die("No se pudo establecer conexión: " . $conexion->connect_error);
}

$consulta = "SELECT
    c.id_copia,j.nombre AS nombre_juego, p.nombre AS plataforma, c.precio_nuevo, c.precio_seminuevo, c.precio_compra, c.stock, c.id_almacenes
FROM copias c
JOIN juegos j ON j.id_juego = c.id_juegos
LEFT JOIN plataformas p ON p.id_plataforma = c.id_plataformas
ORDER BY j.nombre, p.nombre;

";

$respuesta = $conexion->query($consulta);

if ($respuesta && $respuesta->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";

    while ($cabecera = $respuesta->fetch_field()) {
        echo "<th>" . $cabecera->name . "</th>";
    }

    echo "</tr>";

    while ($datos = $respuesta->fetch_assoc()) {
        echo "<tr>";
        foreach ($datos as $campo) {
            echo "<td>" . $campo . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    echo '<a href="eleccion.html"><button id="boton">Regresar</button></a>';
} else {
    echo "No se encontraron registros en la base de datos.";
}

$conexion->close();
?>
