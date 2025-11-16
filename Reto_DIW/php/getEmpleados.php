<?php
// Devuelve JSON con las tiendas (todas las columnas)
header('Content-Type: application/json; charset=utf-8');
include("conexion.php");

$query = "SELECT * FROM tiendas";
$result = mysqli_query($conexion, $query);

$tiendas = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tiendas[] = $row;
    }
}

echo json_encode($tiendas, JSON_UNESCAPED_UNICODE);

?>
