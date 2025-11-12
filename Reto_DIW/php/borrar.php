<?php
include 'conexion.php';

$nom    = $_POST['nombre_juego'];



$existe = mysqli_query($conexion, "SELECT 1 FROM juegos WHERE nombre='$nom' LIMIT 1");
if (mysqli_num_rows($existe) > 0) {
    $sqlborrar="DELETE FROM juegos
                WHERE nombre = '$nom'";
    $ok = mysqli_query($conexion, $sqlborrar);
    if ($ok) {
    echo"El juego ha sido borrado de la base de datos.";
    echo '<a href="../html/eleccion.html"><button id="boton">Volver</button></a>';
    mysqli_close($conexion);
    exit;
} else {
    echo '
        <script>  
            alert("No se pudo borrar el juego.");
            window.location = "../html/eleccion.html";
        </script>
    ';
}
    mysqli_close($conexion);
    exit;
} 





mysqli_close($conexion);
exit;

?>
