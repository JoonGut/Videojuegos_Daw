<?php
include 'conexion.php';

if ($conexion->connect_errno) {
    die("No se pudo establecer conexión: " . $conexion->connect_error);
}

$consulta = "SELECT * FROM juegos    ";
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
