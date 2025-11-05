<?php
include 'conexion.php';

if ($conexion->connect_errno) {
    die("No se pudo establecer conexión: " . $conexion->connect_error);
}
mysqli_set_charset($conexion, 'utf8mb4');

/* INVENTARIO PARCIAL: arranca desde JUEGOS y va “sumando” lo que haya */
$consulta = "SELECT * FROM juegos
";

$respuesta = $conexion->query($consulta);
if (!$respuesta) {
    echo "<p><strong>Error SQL:</strong> " . htmlspecialchars($conexion->error, ENT_QUOTES, 'UTF-8') . "</p>";
    $conexion->close();
    exit;
}

echo "<h2>Inventario (parcial desde JUEGOS con LEFT JOIN)</h2>";

if ($respuesta->num_rows > 0) {
    echo "<table border='1' cellpadding='6' cellspacing='0'>";
    echo "<tr>";
    while ($cabecera = $respuesta->fetch_field()) {
        echo "<th>" . htmlspecialchars($cabecera->name, ENT_QUOTES, 'UTF-8') . "</th>";
    }
    echo "</tr>";

    while ($fila = $respuesta->fetch_assoc()) {
        echo "<tr>";
        foreach ($fila as $valor) {
            echo "<td>" . htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8') . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros (ni siquiera arrancando desde juegos).";
}

echo '<p style="margin-top:12px"><a href="eleccion.html"><button id="boton">Regresar</button></a></p>';

$conexion->close();
