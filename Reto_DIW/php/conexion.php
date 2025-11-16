<?php
// Crea la conexión a la base de datos. No imprimir mensajes aquí para evitar
// "headers already sent" cuando se usa session_start() o header() en scripts
$conexion = mysqli_connect("localhost", "root", "", "bd_videojuegos");
if (!$conexion) {
    // Detener la ejecución si no se puede conectar y mostrar el error.
    die("No se ha podido conectar con la base de datos: " . mysqli_connect_error());
}
// Establecer codificación utf8
mysqli_set_charset($conexion, "utf8");

?>
